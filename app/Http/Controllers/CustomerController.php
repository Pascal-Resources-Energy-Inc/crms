<?php

namespace App\Http\Controllers;
<<<<<<< HEAD

use Illuminate\Http\Request;
use App\Client;
use App\Stove;
use App\User;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    public function getUser($id)
    {
        try {
            $scanned = trim($id);

            if (!$scanned) {
                return response()->json(['success' => false, 'message' => 'Invalid QR code data'], 400);
            }

            $stove = Stove::where('serial_number', 'like', "%{$scanned}%")->first();
            if (!$stove) {
                return response()->json(['success' => false, 'message' => 'No stove found'], 404);
            }

            $client = Client::find($stove->client_id);
            if (!$client) {
                return response()->json(['success' => false, 'message' => 'Customer not found'], 404);
            }

            $user = User::find($client->user_id);
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User account not found'], 404);
            }

            return response()->json([
                'success' => true,
                'customer' => [
                    'id' => $client->id,
                    'customer_id' => $client->id,
                    'name' => $user->name,
                    'full_name' => $user->name,
                    'email' => $user->email ?? $client->email_address ?? 'N/A',
                    'address' => $client->address ?? 'N/A',
                    'number' => $client->number ?? 'N/A',
                    'phone' => $client->number ?? 'N/A',
                    'serial_number' => $stove->serial_number,
                    'avatar' => $client->avatar ?? null,
                ]
            ]);

        } catch (\Throwable $e) {
            Log::error('QR Scanner Error: '.$e->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred while processing'], 500);
        }
=======
use App\Stove;
use App\User;
use App\TransactionDetail;
use Illuminate\Http\Request;
use App\Client;
use RealRashid\SweetAlert\Facades\Alert;
class CustomerController extends Controller
{
    //
    public function index(Request $request)
    {   
        $stoves = Stove::where('client_id',null)->get();
        $customers = Client::with(['transactions', 'serial'])->get();
        return view('customers',
            array(
                'stoves' => $stoves,
                'customers' => $customers
            )
        );
    }
    public function view(Request $request,$id)
    {
        $transactions = TransactionDetail::where('client_id',$id)->orderBy('id','desc')->get();
        $customer = Client::findOrfail($id);

        return view('customer',
            array(
                'customer' => $customer,
                'transactions' => $transactions,
                
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
        $user->role = 'Client';
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
        $customer->status = $request->status;
        $customer->save();

        $serial_number = Stove::findOrfail($request->serial_number);
        $serial_number->client_id = $customer->id;
        $serial_number->save();


        Alert::success('Successfully encoded')->persistent('Dismiss');
        return redirect('view-client/' . $customer->id);

    }
    public function changeAvatar(Request $request, $id)
    {
        $customer = Client::findOrfail($id);
        
        $imageData = $request->image_data;
        
        if (preg_match('/^data:image\/(\w+);base64,/', $imageData, $matches)) {
            $imageType = $matches[1];
            $imageData = substr($imageData, strpos($imageData, ',') + 1);
        } else {
            Alert::error('Invalid image format')->persistent('Dismiss');
            return back();
        }
        
        $imageData = base64_decode($imageData);
        
        if ($imageData === false) {
            Alert::error('Failed to decode image')->persistent('Dismiss');
            return back();
        }
        
        $directory = public_path('avatar-client');
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }
        
        $fileName = 'avatar_' . $customer->id . '_' . time() . '.png';
        $filePath = $directory . '/' . $fileName;
        
        if (file_put_contents($filePath, $imageData)) {
            if ($customer->avatar && 
                $customer->avatar !== url('design/assets/images/profile/user-1.png') && 
                file_exists(public_path(str_replace(url('/'), '', $customer->avatar)))) {
                unlink(public_path(str_replace(url('/'), '', $customer->avatar)));
            }
            
            $customer->avatar = 'avatar-client/' . $fileName;
            $customer->save();
            
            Alert::success('Successfully Uploaded')->persistent('Dismiss');
        } else {
            Alert::error('Failed to save image')->persistent('Dismiss');
        }
        
        return back();
    }
    public function uploadValidId(Request $request,$id)
    {
        // dd($request->all());
        $customer = Client::findOrfail($id);
        $customer->valid_id = $request->valid_id_type;
        $customer->valid_id_number = $request->id_number;

        $attachment = $request->file('id_file');
        $original_name = $attachment->getClientOriginalName();
        $name = time().'_'.$attachment->getClientOriginalName();
        $attachment->move(public_path().'/valid_ids/', $name);
        $file_name = '/valid_ids/'.$name;

        $customer->valid_file = $file_name;
        $customer->save();

        Alert::success('Successfully Uploaded')->persistent('Dismiss');
        return back();
    }
    public function contractSign(Request $request,$id)
    {
        // dd($request->all());

        $customer = Client::findOrfail($id);

        $attachment = $request->file('contract_signature');
        $original_name = $attachment->getClientOriginalName();
        $name = time().'_'.$attachment->getClientOriginalName();
        $attachment->move(public_path().'/signatures/', $name);
        $file_name = '/signatures/'.$name;
        $customer->signature = $file_name;

        $customer->save();

        Alert::success('Successfully Uploaded')->persistent('Dismiss');
       return redirect()->to('view-client/' . $customer->id);
    }

  public function getUser($id)
{
   $serials = Stove::where('serial_number', 'like', '%' . $id . '%')->first();
   if($serials)
   {


   $client = Client::findOrfail($serials->client_id);
    $user = User::find($client->user_id);

    if ($user) {
        return response()->json([
            'success' => true,
            'user' => [
                'id' => $client->id,
                'name' => $user->name
            ]
        ]);
    } else {
        return response()->json(['success' => false], 404);
    }
       }
       else

       {
         return response()->json(['success' => false], 404);
       }
}
    public function sign($id)
    {
        $customer = Client::findOrfail($id);

        return view('signature',
        array(
        'customer' => $customer
        ));
>>>>>>> cbcdc328ee536f65b48e8e78150a46183d1dd68e
    }
}
