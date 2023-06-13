<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserBill;
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
        $first_unit_cost = 5;
		$second_unit_cost = 8;
		$third_unit_cost = 12;
		$fourth_unit_cost = 15;

		if($units <= 50) {
			$total_price = $units * $first_unit_cost;
		}
		else if($units > 50 && $units <= 100) {
			$temp = 50 * $first_unit_cost;
			$remaining_units = $units - 50;
			$total_price = $temp + ($remaining_units * $second_unit_cost);
		}
		else if($units > 100 && $units <= 250) {
			$temp = (50 * $first_unit_cost) + (50 * $second_unit_cost);
			$remaining_units = $units - 100;
			$total_price = $temp + ($remaining_units * $third_unit_cost);
		}
		else {
			$temp = (50 * $first_unit_cost) + (50 * $second_unit_cost) + (150 * $third_unit_cost);
			$remaining_units = $units - 250;
			$total_price = $temp + ($remaining_units * $fourth_unit_cost);
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
