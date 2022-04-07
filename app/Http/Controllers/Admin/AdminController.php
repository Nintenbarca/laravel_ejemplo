<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){

    	if (!Auth::guest() && Auth::user()->hasRole('Admin')) {
    		return view('admin/dashboard');

    	}else{
    		return redirect('/');
    	}   	
    	
    }    
}
