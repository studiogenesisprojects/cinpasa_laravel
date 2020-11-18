<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class Block100Controller extends Controller
{
    public function index()
    {

        $customers = Customer::orderBy('order')->get();
        // dd($customers);
        return view('front.static.block_100', compact('customers'));
    }
}