<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    //

    public function index(Request $request)
    {
        return view('transactions');
    }
}
