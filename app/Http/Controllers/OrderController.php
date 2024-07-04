<?php

namespace App\Http\Controllers;

use App\Category;
use App\Order;
use App\OrderProduct;
use App\Product;
use App\TempCart;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Exception\CardException;
use Stripe\StripeClient;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Jobs\OrderVerificationJob;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    protected $cartcontroller;
    private $stripe;

    
    public function __construct(CartController $cartcontroller){
        $this->cartcontroller = $cartcontroller;
        if (setting('stripe.status') == "1") {
            $this->stripe = new StripeClient(setting('stripe.livekey'));
        } else {
            $this->stripe = new StripeClient(setting('stripe.testkey'));
        }
    }

    
    public function menu_categories()
    {
        return $categories = Category::where('is_menu', '1')->get();
    }

    public function all_products_in_order($order)
    {
        return Product::orderBy('id', $order)->paginate(20);
    }

    
    public function getUserOrders($userid)
    {
        return $orders = Order::where('user_id', $userid)->get();
    }

    public function getTrackedOredr($order_no, $email){
        return $order = Order::where('order_no', $order_no)->where('email' , $email)->first();
    }

    public function checkOrder($order_no){
        return $order = Order::where('order_no', $order_no)->first();
    }

    public function trackOrderSubmit(Request $request)
    {
        // Validate the request data
        $request->validate([
            'orderid' => 'required|string',
            'email' => 'required|email',
        ]);

        // Process the form data
        $orderId = $request->orderid;
        $email = $request->email;

        $orderExsist = $this->checkOrder($orderId);
        if(empty($orderExsist)){
            return response()->json([
                "status" => "error",
                "message" => "Invalid OrderID.",
            ]); 
        }

        $thisOrder = $this->getTrackedOredr($orderId , $email);

        if(!empty($thisOrder)){
            // return $thisOrder;
            return response()->json([
                "status" => "success",
                "message" => "Finding your order. Please wait..",
                "redirect" => url('/find-order') . '/' . $thisOrder->ref_key
            ]);
            // return redirect()->route('find_order', ['refkey' => $thisOrder->ref_key]);

        }
        else{
           return response()->json([
            "status" => "error",
            "message" => "Invalid Email.",
        ]); 
        }
        
    }

    //Stripe Code Start

    public function createInvoice($id)
    {
        $OrderInfo = Order::find($id);

        $pdf = Pdf::loadView('emails.invoice.pdf-invoice', compact('id', 'OrderInfo'))
                    ->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);

        $pdfDir = public_path('/customers/pdfs');
        $pdfPath = $pdfDir . '/' . $OrderInfo->order_no . '.pdf';

        if (!file_exists($pdfDir)) {
            mkdir($pdfDir, 0755, true);
        }

        file_put_contents($pdfPath, $pdf->output());
        $OrderInfo->invoice_pdf = $pdfPath;
        $OrderInfo->save();

        return $OrderInfo;
    }

    public function paymentSuccess(Request $request)
    {
        $token = $this->createToken($request);
        if (!empty($token['error'])) {
            return response()->json([
                "status" => "warning",
                "message" => $token['error'],
            ]);
        }
        if (empty($token['id'])) {
            return response()->json([
                "status" => "warning",
                "message" => "Payment Failed",
            ]);
        }

        // return $request;
        if($request->createAnaccount == 1){
            $finduser = User::where('email' , $request->email)->first();
            if(isset($finduser->id)){
                return response()->json([
                    "status" => "warning",
                    "message" => "We found an account with this email. Please login to continue.",
                ]);
            }
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = isset($request->password) ? bcrypt($request->password) : bcrypt('123');
            $user->contact_no = $request->phone;
            $user->address = $request->address;
            $user->status = 1;
            $user->role_id = 2;
            $user->postcode = $request->postcode;
            $user->state = $request->state;
            $user->city = $request->city;
            $user->save();
        }

        $total = number_format(str_replace(',' , '' , $request->grandTotal) * 100, 0, '', '');
        if (isset($request->oid)) {
            $orderid = $request->oid;
            $order = Order::where('order_no', $orderid)->first();
        } else {
            $order = new Order();
            $orderid = date('ymd') . mt_rand(10000, 99999);
        }
        if (Auth::check()) {
            $order->user_id = Auth()->user()->id;
            $user = User::where('id', Auth()->user()->id)->first();
            $user->contact_no = $request->phone;
            $user->address = $request->address;
            $user->postcode = $request->postcode;
            $user->state = $request->state;
            $user->city = $request->city;
            $user->save();

        }

        if(!isset($order->id)){
            $order->order_no = $orderid;
            $order->name = $request->name;
            $order->email = $request->email;
            $order->address = $request->address;
            $order->contact_no = $request->phone;
            $order->postal_code = $request->postcode;
            $order->payment_gateway = "Stripe";
            $order->order_total = $request->grandTotal;
            $order->order_discount = preg_replace("/[^0-9\.]/", "", $request->discount);
            $order->state = $request->state;
            $order->city = $request->city;
            $order->shipping_total = $request->shippingFee;
            if(isset($request->ordernotes)){
                $order->order_notes = $request->ordernotes;
            }
            $order->save();
    
            $cartitem = $this->cartcontroller->getCartItems($request);
            foreach ($cartitem as $item) {
                $orderpro = new OrderProduct();
                $orderpro->order_no = $order->order_no;
                $orderpro->product_id = $item->product_id;
                $orderpro->price = $item->price;
                $orderpro->total = $item->price * $item->quantity;
                $orderpro->quantity = $item->quantity;
                $orderpro->save();
            }
        }

        $charge = $this->createCharge($token['id'], $total, $orderid);

        if (!empty($charge)) {
            if (isset($charge['status']) && $charge['status'] == 'succeeded') {
                $orderdetail = Order::find($order->id);
                if (isset($orderdetail)) {
                    $orderdetail->payment_transaction_id = $charge['id'];
                    $orderdetail->payment_response = $charge;
                    $orderdetail->status = 1;
                    $orderdetail->payment_status = 'paid';
                    $orderdetail->save();
                }
                //invoice Start
                $invoice = $this->createInvoice($order->id);
                //invoice End
                if (filter_var($order->email, FILTER_VALIDATE_EMAIL)) {
                    dispatch(new OrderVerificationJob($order->id,$order->email , 'customer' , $invoice->invoice_pdf));
                }
                $NotificationEmails = explode(",",setting('site.notificationmails'));
                foreach($NotificationEmails as $NE) {
                    dispatch(new OrderVerificationJob($order->id, $NE , 'admin' , $invoice->invoice_pdf));
                }

                if (Auth::check()) {
                    $tempcart = TempCart::where('user_id', Auth()->user()->id)->get();
                    foreach ($tempcart as $tm) {
                        $tm->status = 0;
                        $tm->save();
                    }
                } else {
                    $macAddr = $this->cartcontroller->cartAddress;
                    $tempcart = TempCart::where('mac_address', $macAddr)->get();
                    foreach ($tempcart as $tm) {
                        $tm->status = 0;
                        $tm->save();
                    }
                }
                return response()->json([
                    "status" => "success",
                    "message" => "Payment completed.",
                    "redirect" => url('/success') . '/' . $order->ref_key
                ]);
            } else {
                return response()->json([
                    "status" => "warning",
                    "message" => $charge['error'],
                    "oid" => $orderid
                ]);
            }
        } else {
            return response()->json([
                "status" => "warning",
                "message" => $charge['error'],
                "oid" => $orderid
            ]);
        }
    }

    private function createToken($cardData)
    {
        $expiry = explode('/', $cardData['expirydate']);
        $token = null;
        try {
            $token = $this->stripe->tokens->create([
                'card' => [
                    'number' => $cardData['cardnumber'],
                    'exp_month' => $expiry[0],
                    'exp_year' => $expiry['1'],
                    'cvc' => $cardData['cvv']
                ]
            ]);
        } catch (CardException $e) {
            $token['error'] = $e->getError()->message;
        } catch (Exception $e) {
            $token['error'] = $e->getMessage();
        }
        return $token;
    }

    private function createCharge($tokenId, $amount, $orderid)
    {
        $charge = null;
        try {
            $datetime = date('d-m-Y H:i:s');
            $charge = $this->stripe->charges->create([
                'amount' => $amount,
                'currency' => 'gbp',
                'source' => $tokenId,
                'description' => 'Payment against Order# ' . $orderid . ' on ' . $datetime,
            ]);
        } catch (Exception $e) {
            $charge['error'] = $e->getMessage();
        }
        return $charge;
    }
    //Stripe Code End

    public function create_intent(Request $request){
        // return $request;
        $amount = str_replace( ',' , '' , $request->amount);
        $currency = 'gbp';
    
        $paymentIntent = $this->stripe->paymentIntents->create([
            'amount' => $amount,
            'currency' => $currency,
        ]);
        $clientSecret = $paymentIntent->client_secret;
    
        return response()->json(['client_secret' => $clientSecret]);
    }
}
