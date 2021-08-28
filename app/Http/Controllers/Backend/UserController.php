<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('backend_pages.users.index', compact('users'));
    }
    public function create(){
        return view('backend_pages.users.create');
    }
    public function store(Request $request){
        try {
            $request->validate([
                'name' => 'required|min:3|max:100|regex:/^[a-zA-Z ]+$/',
                'email' => 'required|email|unique:users',
                'phone' => 'required|numeric|regex:/(01)[0-9]{9}/',
                'address' => 'required',
                'password' => 'required|confirmed|min:6',
                'user_photo' => 'required|image|mimes:png,jpg,jpeg',
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
}

