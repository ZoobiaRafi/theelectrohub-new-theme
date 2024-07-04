<?php

namespace App\Mail;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderVerificationEmail extends Mailable
{
    protected $id;
    protected $type;
    protected $file;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id , $type, $file)
    {   
        $this->id = $id;
        $this->type = $type;
        $this->file = $file;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $OrderInfo = Order::find($this->id);
        $type = $this->type;
        $attachment = file_get_contents($this->file);
        $filename = 'Invoice for ' . $OrderInfo->order_no .'.pdf';

        if($type == "admin"){
            $Subject = "New order recieved, order# " . $OrderInfo->order_no;
        }
        else{
            $Subject = "Thank you for your order. Your Order No is #" . $OrderInfo->order_no;
        }
        $view = 'orders.orderrecipt';
        
        return $this->subject($Subject)
                    ->from("donotreply@theelectrohub.co.uk",'The Electro Hub')
                    ->view($view,compact('OrderInfo' , 'type'))
                    ->attachData($attachment,$filename);
    }
}
