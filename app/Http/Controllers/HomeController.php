<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;

class HomeController extends Controller
{
    public function superadmin() {
    	if (Sentinel::guest())
        {
            return redirect()->route('login');
        }else{
        	return view('dashboard.superadmin_index');
        }
    }
    
    public function admin() {
    	if (Sentinel::guest())
        {
            return redirect()->route('login');
        }else{
        	return view('dashboard.admin_index');
        }
    }
    
    public function agent() {
    	if (Sentinel::guest())
        {
            return redirect()->route('login');
        }else{
        	return view('dashboard.agent_index');
        }
    }
}
