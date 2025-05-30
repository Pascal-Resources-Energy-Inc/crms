<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DealerController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('dealers');
    }
    public function show(Request $request)
    {
        return view('dashboard-dealer');
    }
    public function newDealer()
    {
        return view('new-dealer');
    }
}
