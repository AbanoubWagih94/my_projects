<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function show($id){
        $orders = Order::where('user_id', $id)->get();
        return view('admin.users.details', compact('orders'));
    }

    public function changeStatus($id, $status){
        //Find user
        $user = User::find($id);

        //Change to new status
        $newStatus = ($status)? 0 : 1;

        $user->update([
            'status' => $newStatus
        ]);

        //Status msg
        $msg = ($newStatus)? 'User has been blocked': 'User has been again into active';

        session()->flash('msg', $msg);

        // Redirect the page
        return redirect('admin/users');
    }
}
