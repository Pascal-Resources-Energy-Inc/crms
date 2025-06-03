<?php

namespace App\Http\Controllers;
use App\Stove;
use App\User;
use Illuminate\Http\Request;
use App\Client;
use RealRashid\SweetAlert\Facades\Alert;
class CustomerController extends Controller
{
    //
    public function index(Request $request)
    {
        $stoves = Stove::where('client_id',null)->get();
        $customers = Client::get();
        return view('customers',
            array(
                'stoves' => $stoves,
                'customers' => $customers
            )
        );
    }
    public function view(Request $request,$id)
    {
        $customer = Client::findOrfail($id);

        return view('customer',
            array(
                'customer' => $customer,
            )
        );
    }
    public function show(Request $request)
    {
        return view('customer-dashboard');
    }
    public function newCustomer(Request $request)
    {
        $stoves = Stove::where('client_id',null)->get();
        return view('new-customer',
            array(
                'stoves' => $stoves
            )
        );
    }

    public function saveCustomer(Request $request)
    {
            // Alert::success('Successfully posted payment! Your server is in the process of being created. Please wait.')->persistent('Dismiss');
        // dd($request->all());

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email_address;
        $user->password = bcrypt('12345678');
        $user->save();

        $customer = new Client;
        $customer->user_id = $user->id;
        $customer->name = $request->name;
        $customer->email_address = $request->email_address;
        $customer->number = $request->phone_number;
        $customer->facebook = $request->facebook;
        $customer->address = $request->address;
        $customer->serial_number = $request->serial_number;
        $customer->save();

        $serial_number = Stove::findOrfail($request->serial_number);
        $serial_number->client_id = $customer->id;
        $serial_number->save();


        Alert::success('Successfully encoded')->persistent('Dismiss');
        return redirect('view-client/' . $customer->id);

    }
}
