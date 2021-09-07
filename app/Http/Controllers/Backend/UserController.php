<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Show All Users
    public function index(){
        $users = User::all();
        return view('backend_pages.users.index', compact('users'));
    }
    // Add New User
    public function create(){
        return view('backend_pages.users.create');
    }
    // Store New User
    public function store(Request $request){
        try {
            $request->validate([
                'name' => 'required|min:3|max:100|regex:/^[a-zA-Z ]+$/',
                'email' => 'required|email|unique:users',
                'phone' => 'required|numeric|regex:/(0)[0-9]{9}/',
                'address' => 'required',
                'password' => 'required|confirmed|min:6',
                'user_photo' => 'required|image|mimes:png,jpg,jpeg',
            ],[
                'password.confirmed' => 'Password does not matched!!'
            ]);
            if ($request->hasFile('user_photo')) {
                $image = $request->file('user_photo');
                $newImage = 'user_'.time().'.'.$image->getClientOriginalExtension();
                $image->move('Upload/Users', $newImage);

                $user_data = [
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
                    'address' => $request->input('address'),
                    'password' => Hash::make($request->input('password')),
                    'user_photo' => $newImage,
                    'role' => 'admin',
                ];
                // dd($user_data);
                User::create($user_data);
            }
            return redirect()->route('admin.user')->with('success', 'User Inserted Successfully!!');
        } catch (\Exception $exception) {
            $error = $exception->validator->getMessageBag();
            return redirect()->back()->withErrors($error)->withInput();
        }
    }
    // Show Specific User
    public function show($id){
        $user = User::find($id);
        return view('backend_pages.users.show', compact('user'));
    }
    // Show Specific User
    public function edit($id){
        $user = User::find($id);
        return view('backend_pages.users.edit', compact('user'));
    }
    // Update User
    public function update(Request $request, $id){
        try {
            $request->validate([
                'name' => 'required|min:3|max:100|regex:/^[a-zA-Z ]+$/',
                'email' => 'required|email',
                'phone' => 'required|regex:/(0)[0-9]{9}/',
                'address' => 'required',
            ]);
            $user = User::find($id);
            $user_data = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
            ];
            $user->update($user_data);

            if ($request->hasFile('user_photo')) {
                $destination = 'Upload/Users/'.$user->user_photo;
                if(File::exists($destination )){
                    File::delete($destination);
                }
                $image = $request->file('user_photo');
                $newImage = 'user_'.time().'.'.$image->getClientOriginalExtension();
                $image->move('Upload/Users', $newImage);
                $user->update(['user_photo' => $newImage]);
                // dd($user_data);
            }
            return redirect()->route('admin.user')->with('update', 'User Updated Successfully');
        } catch (\Exception $exception) {
            $error = $exception->validator->getMessageBag();
            return redirect()->back()->withErrors($error);
        }
    }
    // Delete User
    public function delete($id){
        $user = User::find($id);
        $image_destination = 'Upload/Users/'.$user->user_photo;
        if(File::exists($image_destination)){
            File::delete($image_destination);
        }
        $user->delete();
        return redirect()->back()->with('delete', 'User Deleted Successfully');
    }
    // Logging User Portion
    public function profile(){
        return view('auth.profile');
    }
    // Update User profile
    public function profileUpdate(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        $id = Auth::user()->id;
        $user = User::find($id);
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email')
        ];
        // dd($data);
        $user->update($data);
        return redirect()->back()->with('profileUpdate', 'User Profile Updated Successfully');
    }
    // Change Password
    public function password(){
        return view('auth.changePassword');
    }
    public function changePassword(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ],[
            'old_password.required' => 'Old password is required!!',
            'new_password.required' => 'New password is required!!',
            'confirm_password.required' => 'Confirm password is required!!',
        ]);
        $id = Auth::user()->id;
        $user = User::find($id);
        $db_pass = Auth::user()->password;
        $old_pass = $request->input('old_password');
        $new_pass = $request->input('new_password');
        $confirm_pass = $request->input('confirm_password');

        if(Hash::check($old_pass, $db_pass)){
            if ($new_pass === $confirm_pass) {
                $user->update([
                    'password' => Hash::make($request->input('new_password'))
                ]);
                Auth::logout();
                return redirect()->route('login')->with('success_password', 'Password Changed Successfully! Please login again');
            }else {
                return redirect()->back()->with('wrong_pass', 'New Password & Confirm password is not matched!!');
            }
        }else{
            return redirect()->back()->with('no_match', 'Password Mismatched');
        }
    }
}

