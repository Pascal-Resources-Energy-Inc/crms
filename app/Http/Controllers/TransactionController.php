<?php

namespace App\Http\Controllers;
use App\TransactionDetail;
use App\Item;
use App\Client;
use Illuminate\Http\Request;

use RealRashid\SweetAlert\Facades\Alert;
class TransactionController extends Controller
{
    //

    public function index(Request $request)
    {
        $customers = Client::get();
        $items = Item::get();
         $transactions = [];
        if(auth()->user()->role == "Admin")
        {
            $transactions = TransactionDetail::get();
        }
        elseif(auth()->user()->role == "Dealer")
        {
            $transactions = TransactionDetail::where('dealer_id',auth()->user()->id)->get();
        }
        return view('transactions',
            array(
                'transactions' => $transactions,
                'items' => $items,
                'customers' => $customers,
            )
        );
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $item = Item::findOrfail($request->item_id);


        $transaction = new TransactionDetail;
        $transaction->item = $item->item;
        $transaction->points_dealer = $item->dealer_points * $request->qty;
        $transaction->points_client = $item->customer_points * $request->qty;
        $transaction->item_description = $item->item_description;
        $transaction->qty = $request->qty;
        $transaction->price = $item->price;
        $transaction->client_id = $request->customer_id;
        $transaction->dealer_id = auth()->user()->id;
        $transaction->save();


         Alert::success('Successfully Save')->persistent('Dismiss');
        return back();
    }
}
