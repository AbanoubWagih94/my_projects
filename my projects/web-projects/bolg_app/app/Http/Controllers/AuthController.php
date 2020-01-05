<?php

namespace App\Http\Controllers;

use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index(){
        return view('auth.login');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6'
        ]);


            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);

            auth()->login($user);
            return redirect('/');
    }

    public function register(){
        return view('auth.registration');
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if($validator->fails()){
          return back()->withErrors($validator)->withInput();
        }

        $user = $request->only('email', 'password');

        if(!auth()->attempt($user)){
            return back()->withErrors([
                'msg' => 'Wrong email or password please try again'
            ]);
        }

        return redirect('/');

    }

    public function logout(){
        auth()->logout();
        session()->flash('msg', 'logged out');
        return redirect('/');
    }
}
