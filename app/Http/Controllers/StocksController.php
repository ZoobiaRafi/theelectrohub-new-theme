<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\StocksStatus;
use App\Vendor;

class StocksController extends Controller
{

    public function login_check(){
        if(Auth::check()){
            $user = Auth()->user();
        }
        return $user;
    }

    public function stocks_statuses(Request $request){
        $view = 'stocks.status';
        $user = $this->login_check();
        if($request->has('query')){
            $stockstatus = StocksStatus::where('title' , 'LIKE' , '%' . $request->input('query') . '%')->orderBy('id','DESC')->paginate(10);
        }
        else{
            $stockstatus = StocksStatus::orderBy('id','DESC')->paginate(10);
        }
        return view($view,compact('user' , 'stockstatus'));
    }

    public function stocks_statuses_submit(Request $request){
        try{
            $topics = new StocksStatus();
            $topics->title = $request->title;
            $topics->status = $request->status;
            $topics->save();
            return response()->json([
                "status" => "success",
                "message" => "Status Added Successfully"
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while adding the status",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function stocks_statuses_update(Request $request){
        try{
            $topics = StocksStatus::find($request->id);
            $topics->title = $request->title;
            $topics->status = $request->status;
            $topics->save();
            return response()->json([
                "status" => "success",
                "message" => "Status updated Successfully"
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while updating the status",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function stocks_statuses_delete(Request $request){
        try {
            $topic = StocksStatus::find($request->id);
            $topic->delete();
            return response()->json([
                "status" => "success"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while deleting the status",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function stocks_statuses_status(Request $request){
        try{
            $topic = StocksStatus::find($request->id);
            if($topic->status == 1){
                $topic->status = 0;
                $topic->save();
            }
            else if($topic->status == 0){
                $topic->status = 1;
                $topic->save();
            }
            return response()->json([
                "status" => "success"
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while updating the status",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function vendors(Request $request , $refkey){
        $view = 'vendors.list';
        $user = $this->login_check();
        if($request->has('query')){
            $vendors = Vendor::where('vendor_name' , 'LIKE' , '%' . $request->input('query') . '%')->orderBy('id','DESC')->paginate(10);
        }
        else{
            $vendors = Vendor::orderBy('id','DESC')->paginate(10);
        }
        return view($view,compact('user' , 'vendors'));
    }

    public function add_vendors(){
        $view = 'vendors.add';
        $user = $this->login_check();
        return view($view,compact('user'));
    }

    public function add_vendors_submit(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ], [
            'name.required' => 'Please enter name',
            'email.required' => 'Please enter email',
            'phone.required' => 'Please enter phone',
        ]);

        try{
            $vendor = new Vendor();
            $vendor->vendor_name = $request->name;
            $vendor->email = $request->email;
            $vendor->phone = $request->phone;
            $vendor->address = $request->address;
            $vendor->website = $request->website;
            $vendor->contact_person_name = $request->contact_person_name;
            $vendor->contact_person_email = $request->contact_person_email;
            $vendor->contact_person_phone = $request->contact_person_phone;
            $vendor->business_nature = $request->business_nature;
            $vendor->status = $request->status;
            $vendor->save();
            $user = $this->login_check();
            return redirect()->route('vendors' , $user->ref_key)->with('success' , 'Vendor added successfully!');
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error' , $e->getMessage());
        }
    }

    public function edit_vendors($id){
        $view = 'vendors.edit';
        $user = $this->login_check();
        $vendors = Vendor::find($id);
        return view($view,compact('user' , 'vendors'));
    }

    public function edit_vendors_submit(Request $request , $id){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ], [
            'name.required' => 'Please enter name',
            'email.required' => 'Please enter email',
            'phone.required' => 'Please enter phone',
        ]);

        try{
            $vendor = Vendor::find($id);
            $vendor->vendor_name = $request->name;
            $vendor->email = $request->email;
            $vendor->phone = $request->phone;
            $vendor->address = $request->address;
            $vendor->website = $request->website;
            $vendor->contact_person_name = $request->contact_person_name;
            $vendor->contact_person_email = $request->contact_person_email;
            $vendor->contact_person_phone = $request->contact_person_phone;
            $vendor->business_nature = $request->business_nature;
            $vendor->status = $request->status;
            $vendor->save();
            $user = $this->login_check();
            return redirect()->route('vendors' , $user->ref_key)->with('success' , 'Vendor updated successfully!');
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error' , $e->getMessage());
        }
    }

    public function delete_vendors(Request $request){
        try {
            $topic = Vendor::find($request->id);
            $topic->delete();
            return response()->json([
                "status" => "success"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while deleting the vendor",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function edit_vendors_status(Request $request){
        try{
            if(isset($request->id)){
                $vendor = Vendor::find($request->id);
                if($vendor->status == 1){
                    $vendor->status = 0;
                    $vendor->save();
                }
                else{
                    $vendor->status = 1;
                    $vendor->save();
                }
                return response()->json([
                    "status" => "success",
                    "message" => "Status updated Successfully"
                ]);
            }
        }
        catch(\Exception $e){
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while updating the status",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function view_vendors(Request $request){
        $vendor = Vendor::find($request->id);
        if(isset($vendor->id)){
            $data = [];
            $data = [
                "website" => $vendor->website,
                "contact_person_name" => $vendor->contact_person_name,
                "contact_person_email" => $vendor->contact_person_email,
                "contact_person_phone" => $vendor->contact_person_phone,
                "business_nature" => $vendor->business_nature,
            ];

            return response()->json([
                "status" => "success",
                "data" => $data
            ]);
        }
        else{
            return response()->json([
                "status" => "error",
                "message" => "Error occured"
            ]);
        }

    }
}
