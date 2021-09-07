<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }
    public function login(Request $request){

        try {
            $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);
            $crads = $request->except('_token');
            if (Auth::attempt($crads)) {
                return redirect()->route('admin.dashboard')->with('success_msg_admin', 'Admin Logging Successfully!!');
            }else {
                return redirect()->back()->with('error', 'Invalid name or password!!');
            }
        } catch (\Exception $exception) {
            $error = $exception->validator->getMessageBag();
            return redirect()->back()->withErrors($error);
        }
    }
    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }
}
