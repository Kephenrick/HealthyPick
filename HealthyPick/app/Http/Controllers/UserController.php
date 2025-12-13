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
        return view('user.userPayment');
    }

    public function transaction(){
        return view('user.userTransaction');
    }

    public function about(){
        return view ('user.userAbout');
    }
}
