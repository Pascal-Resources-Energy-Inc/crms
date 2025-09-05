<?php

namespace App\Http\Controllers;
use RealRashid\SweetAlert\Facades\Alert;
use App\User;
use App\Dealer;
use App\TransactionDetail;
use Illuminate\Http\Request;

class DealerController extends Controller
{
    //
    public function index(Request $request)
    {
        $dealers = Dealer::get();
        return view('dealers',
            array(
                'dealers' => $dealers,
            )
        );
    }
    public function show(Request $request)
    {
        return view('dashboard-dealer');
    }
    public function newDealer(Request $request)
    {
        // dd($request->all());

         $user = new User;
        $user->name = $request->name;
        $user->email = $request->email_address;
        $user->role = 'Dealer';
        $user->password = bcrypt('12345678');
        $user->save();

        $customer = new Dealer;
        $customer->user_id = $user->id;
        $customer->name = $request->name;
        $customer->email_address = $request->email_address;
        $customer->number = $request->phone_number;
        $customer->facebook = $request->facebook;
        $customer->address = $request->address;
        $customer->store_name = $request->store_name;
        $customer->store_type = $request->store_type;
        $customer->status = "Active";
        $customer->save();
        

          Alert::success('Successfully encoded')->persistent('Dismiss');
        return redirect('view-dealer/' . $customer->id);
    }

    public function view(Request $request,$id)
    {
           $dealer = Dealer::findOrfail($id);
         $transactions = TransactionDetail::where('dealer_id',$dealer->user_id)->orderBy('id','desc')->get();
     

        return view('dealer',
            array(
                'dealer' => $dealer,
                'transactions' => $transactions,
                
            )
        );
    }
      public function changeAvatar(Request $request, $id)
        {
            $dealer = Dealer::findOrfail($id);
            
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
            
            $directory = public_path('avatar-dealer');
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }
            
            $fileName = 'avatar_dealer_' . $dealer->id . '_' . time() . '.png';
            $filePath = $directory . '/' . $fileName;
            
            if (file_put_contents($filePath, $imageData)) {
                if ($dealer->avatar && 
                    $dealer->avatar !== url('design/assets/images/profile/user-1.png') && 
                    file_exists(public_path(str_replace(url('/'), '', $dealer->avatar)))) {
                    unlink(public_path(str_replace(url('/'), '', $dealer->avatar)));
                }
                
                $dealer->avatar = 'avatar-dealer/' . $fileName;
                $dealer->save();
                
                Alert::success('Successfully Uploaded')->persistent('Dismiss');
            } else {
                Alert::error('Failed to save image')->persistent('Dismiss');
            }
            
            return back();
        }

    public function uploadValidId(Request $request,$id)
    {
        // dd($request->all());
        $customer = Dealer::findOrfail($id);
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

        $customer = Dealer::findOrfail($id);

        $attachment = $request->file('contract_signature');
        $original_name = $attachment->getClientOriginalName();
        $name = time().'_'.$attachment->getClientOriginalName();
        $attachment->move(public_path().'/signatures/', $name);
        $file_name = '/signatures/'.$name;
        $customer->signature = $file_name;

        $customer->save();

        Alert::success('Successfully Uploaded')->persistent('Dismiss');
        return redirect()->to('view-dealer/' . $customer->id);
    }

    public function sign($id)
    {
         $dealer = Dealer::findOrfail($id);

        return view('signature_dealer',
        array(
        'dealer' => $dealer
        ));
    }
}
