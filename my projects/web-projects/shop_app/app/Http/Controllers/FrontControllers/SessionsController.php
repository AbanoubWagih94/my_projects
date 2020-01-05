<?php

namespace App\Http\Controllers\FrontControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index(){
        return view('front.sessions.index');
    }

    public function store(Request $request){
        //Validate user
        $request->validate([
            'email' => 'required|email',
            'password'=>'required'
        ]);
        // Check if exist
        $userData = $request->only('email', 'password');
        if(!auth()->attempt($userData)){
            return back()->withErrors([
                'message' => 'Wrong email or password please try again'
            ]);
        }

        //Redirect
        return redirect('/user/profile');
    }

    public function logout(){
        auth()->logout();

        session()->flash('msg', 'You have been logged out');
        return redirect('/');
    }
}
