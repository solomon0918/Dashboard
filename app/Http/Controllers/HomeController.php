<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserRole;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->user()->authorizeRoles('Client')){
            return view('home');
        }else{
            return redirect('/login');
        }
    }

    public function dashboard(Request $request)
    {
        if($request->user()->authorizeRoles('Attorney')){
            return view('dashboard');
        }else{
            return redirect('/login');
        }

    }

    public function admin(Request $request){
        if($request->user()->authorizeRoles('Administrator')){
            return view('admin');
        }else{
            return redirect('/login');
        }
    }

}
