<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserBill;
use App\Models\UnitSlab;
use Exception;

class CustomerController extends Controller
{
    public function index(){
        $users = User::all();
        return view('customerList',compact('users'));
    }
    public function addCustomer(){
        return view('addCustomer');
    }
    public function saveCustomer(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'mobile' => 'required|min:10|max:15',
            'address' => 'required',
            'city' => 'required'
        ]);
        try{
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->city = $request->city;
            $user->save();
            return redirect()->back()->withSuccess('Customer Add Successfull');
        }
        catch(Exception $e){
            return $e;
        }
    }
    public function editCustomer($id){
        $user = User::find($id);
        return view('editCustomer',compact('user'));
    }
    public function updateCustomer(Request $request,$id){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'mobile' => 'required|numeric',
            'address' => 'required',
            'city' => 'required'
        ]);
        try{
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->city = $request->city;
            $user->save();
            return redirect()->route('customerList')->withSuccess('Customer Update Successfull');
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }
    public function deleteCustomer(Request $request){
        try{
            $user = User::find($request->id);
            $user->delete();
            return redirect()->route('customerList')->withSuccess('Customer Delete Successfull');
        }catch(Exception $e){

        }
    }
    public function createBill(Request $request){
        $customers = User::all();
        return view('createBill',compact('customers'));
    }
    public function saveBill(Request $request){
        $request->validate([
            'customer' => 'required',
            'month' => 'required',
            'unit' => 'required|numeric',
        ]);
        try{
            
            $units = $request->unit;    
            $slabs = UnitSlab::all();
            $unit_diff_sum =0;
            $remaining_units = 0;
            $total_price = 0;
            $last_remaining_unit = 0;
            foreach($slabs as $slab){
                $diff = $slab->unit_to - $slab->unit_from + 1;
                $unit_diff_sum += $slab->unit_to - $slab->unit_from + 1;  
                //echo $unit_diff."  ";
                $remaining_units =  $units - $unit_diff_sum;
                if($remaining_units > 0){
                    $last_remaining_unit = $unit_diff_sum;
                    $total_price += $diff * $slab->price;
                // // echo $units * $slab->price ;
                 }else{
                    $remaining_units= $units - $last_remaining_unit;
                    $total_price += $remaining_units * $slab->price;
                 }
                
            }
            $bill = new UserBill;
            $bill->user_id = $request->customer;
            $bill->month = $request->month;
            $bill->unit = $request->unit;
            $bill->total_price = $total_price;
            $bill->save();
            return redirect()->back()->withSuccess('Bill Generate Successfully');
        }
        catch(Exception $e){
            return $e;
        }
    }
    public function usersBill(){
        $user_bills = UserBill::with('user')->paginate(10);;
        return view('userBill',compact('user_bills'));
    }
}
