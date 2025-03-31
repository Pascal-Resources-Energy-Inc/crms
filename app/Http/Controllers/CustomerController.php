<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('customers');
    }
    public function view(Request $request)
    {
        return view('customer');
    }
    public function show(Request $request)
    {
        return view('customer-dashboard');
    }
}
