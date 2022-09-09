<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function logout(Request $request)
    {
       /* Auth::logout();
        $notification=array(
            'message' => 'succsessfully Logout',
            'alert-type' =>'success'
        );
        return redirect()->route('login')->with($notification);*/
        Auth::guard('user')->logout();

        $request->session()->invalidate();

        //$request->session()->flush();
        //$request->session()->regenerate();

        return redirect('/login/')->with("info","You have successfully logged out from user Panel");
    }
}
