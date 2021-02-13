<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        //Validate from data
        $this->validate($request, 
            [
                'email' => 'required|string|email',
                'password' => 'required|string|min:8'

            ]
        );

        //Attempt to login as admin
        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){
            //If successfull then redirect tointended route or admin dashboard
            return redirect()->intended(route('admin.dashboard'));
        }

        //If unsuccessfull then redirect back to login pagewith email and remember fields
        return redirect()->back()->withinput($request->only('email', 'remember'));
    }
}
