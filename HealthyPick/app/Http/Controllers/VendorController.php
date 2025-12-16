<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function home(){
        return view('vendor.vendorHome');
    }

    public function product(){
        return view('vendor.vendorProduct');
    }

    public function transaction(){
        return view('vendor.vendorTransaction');
    }

    public function add(){
        return view('vendor.vendorAdd');
    }
}
