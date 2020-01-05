<?php

namespace App\Http\Controllers\FrontControllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index(){
        return view('front.registration.index');
    }

    public function store(Request $request){
        // Validate user
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|confirmed',
            'address'=>'required'
        ]);

        // Add user
        $user = User::create($request->all());

        // User login
        auth()->login($user);

        // Redirect
        return redirect('/user/profile');
    }
}
