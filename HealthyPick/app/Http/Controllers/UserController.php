<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function home(){
        return view('user.userHome');
    }

    public function product(){
        return view('user.userProduct');
    }

    public function vendor(){
        return view('user.userVendor');
    }

    public function payment(){
        // Normally you'd fetch the user's pending transaction (amount, id) here
        $order = [
            'id' => 'ORD-'.time(),
            'amount' => 125000, // example amount in your currency
        ];

        return view('user.userPayment', compact('order'));
    }

    public function submitPayment(\Illuminate\Http\Request $request){
        $request->validate([
            'method' => 'required|string',
        ]);

        // Here you would integrate with payment gateway or record payment
        // For now we simulate success

        return redirect()->route('user.userTransaction')->with('success', __('messages.payment_success'));
    }

    public function transaction(){
        return view('user.userTransaction');
    }

    public function about(){
        return view ('user.userAbout');
    }
}
