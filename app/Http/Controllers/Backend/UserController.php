<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
                'user_photo' => 'required|image|mimes:png,jpg,jpeg',
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
            return redirect()->route('admin.user')->with('update', 'Product Updated Successfully');
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
}

