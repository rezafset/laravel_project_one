<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function register()
    {
        if (auth()->user()) {
            if (auth()->user()->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('home');
            }
        } else {
            return view('auth.register');
        }
    }
    public function doRegister(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|min:3|max:100|regex:/^[a-zA-Z ]+$/',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric|regex:/(0)[0-9]{9}/',
            'address' => 'required',
            'password' => 'required|confirmed|min:6',
            'user_photo' => 'required|image|mimes:png,jpg,jpeg',
        ], [
            'password.confirmed' => 'Password does not matched!!'
        ]);
        if ($request->hasFile('user_photo')) {
            $image = $request->file('user_photo');
            $newImage = 'user_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move('Upload/Users', $newImage);

            $user_data = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'password' => Hash::make($request->input('password')),
                'user_photo' => $newImage,
                'role' => 'customer',
            ];
            User::create($user_data);
            return redirect()->back()->with('register_success', 'Registration Successful!! Login Please');
        }
    }
    public function customerProfile()
    {
        if (auth()->user()) {
            if (auth()->user()->role == 'customer') {
                return view('frontend.customer.profile');
            } else {
                return redirect()->back();
            }
        }
    }
    public function editCustomer()
    {
        return view('frontend.customer.editCustomer');
    }
    public function updateCustomer(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);
        $id = auth()->user()->id;
        $user = User::find($id);
        $update_customer = [
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
        ];
        $user->update($update_customer);
        if($request->hasFile('user_photo')){
            $destination = 'Upload/Users/'.$user->user_photo;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $image = $request->file('user_photo');
            $newImage = 'user_'.time().'.'.$image->getClientOriginalExtension();
            $image->move('Upload/Users', $newImage);
            $user->update(['user_photo' => $newImage]);
        }
        return redirect()->back()->with('update_cutomer','Customer Updated Successfully!!');
    }
    public function password(){
        return view('frontend.customer.customerPassword');
    }
    public function passwordChange(Request $request){
        $id = auth()->user()->id;
        $customer = User::find($id);
        $db_pass = auth()->user()->password;
        $old_pass = $request->input('old_password');
        $new_pass = $request->input('new_password');
        $confirm_pass = $request->input('confirm_password');

        if(Hash::check($old_pass, $db_pass)){
            if($new_pass === $confirm_pass){
                $customer->update([
                    'password' => Hash::make($request->input('new_password'))
                ]);
                Auth::logout();
                return redirect()->route('login')->with('password_message', 'Password Changed Successfully! Please login again');
            }else{
                return redirect()->back()->with('password_message', 'New Password & Confirm password is not matched!!');
            }
        }else{
            return redirect()->back()->with('password_message', 'Password Mismatched');
        }
    }

}
