<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cartalyst\Sentinel\Users\UserInterface;
use Sentinel;

class AuthenticationController extends Controller
{
    public function checkUser(){
        if (Sentinel::guest())
        {
            return redirect()->route('login');
        }
    }

    public function login() {
        return view('authentication.login');
    }
    
    public function attemptLogin(Request $request) {
        
        $this->validate($request, [
            'email' => 'required|Between:3,64|email',
            'password' => 'required',
        ]);
        $credentials = [
            'email'    => $request->email,
            'password' => $request->password,
        ];
        $user = Sentinel::authenticate($credentials);
        if(!Sentinel::authenticate($credentials)) {
            return redirect()->back()->withInput()->with('error', 'Invalid Login details');
        }else{
                Sentinel::login($user);
            try {
                if (Sentinel::getUser()->roles->first()->slug == 'superadmin') {
                    Sentinel::loginAndRemember($user);                   
                    return redirect()->route('superadmin_dash');
                }else if (Sentinel::getUser()->roles()->first()->slug == 'admin') {                    
                    Sentinel::loginAndRemember($user);
                    return redirect()->route('admin_dash');
                }else if (Sentinel::getUser()->roles()->first()->slug == 'agent') {
                    Sentinel::loginAndRemember($user);
                    return redirect()->route('agent_dash');
                }
            } catch (BadMethodCallException $e) {
                return back()->withInput()->with('error', 'Your Session has expired. Please login again!');
            }
        }
    }
    
    public function register(Request $request) {
        if (Sentinel::guest())
        {
            return redirect()->route('login');
        }else{
            // return view('authentication.register');
            return view('user.create');
        }
        
    }
    
    public function forgotPassword() {
        return view('authentication.passwordreset');
    }
    
    public function dashboard() {
        if (Sentinel::guest())
        {
            return redirect()->route('login');
        }else{
            return view('dashboard.index');
        }
    }
    
    public function logout() {
        Sentinel::logout(null, true);
        return redirect()->route('home');
    }
}

