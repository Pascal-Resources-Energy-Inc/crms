<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            
            $user = Auth::user();
            
            // Validate if user's role matches the selected role
            if (!$this->validateSelectedRole($request, $user)) {
                Auth::logout();
                
                throw ValidationException::withMessages([
                    $this->username() => ['You are not authorized to login as the selected role. Please select the correct role that matches your account.'],
                ]);
            }
            
            if ($this->isUserInactive($user)) {

                Auth::logout();
                
                throw ValidationException::withMessages([
                    $this->username() => ['You are not part of this project. Please contact your administrator.'],
                ]);
            }

            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Validate if the user's actual role matches the selected role from frontend.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return bool
     */
    protected function validateSelectedRole($request, $user)
    {
        $selectedRole = $request->input('selected_role');
        
        if (!$selectedRole) {
            return true;
        }
        
        $selectedRole = strtolower($selectedRole);
        $userRole = strtolower($user->role);
        
        $roleMapping = [
            'admin' => 'admin',
            'users' => ['dealer', 'client'],
        ];
        
        if ($selectedRole === 'admin') {
            return $userRole === 'admin';
        }
        
        if ($selectedRole === 'users') {
            return in_array($userRole, ['dealer', 'client']);
        }
        
        return false;
    }

    /**
     * Check if user is inactive based on their role.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    protected function isUserInactive($user)
    {
        if ($user->role === 'Admin') {
            return false;
        }
        
        if ($user->role === 'Dealer') {
            $dealer = \App\Dealer::where('user_id', $user->id)->first();
            
            if (!$dealer) {
                return true;
            }
            
            if (isset($dealer->status) && strtolower($dealer->status) === 'inactive') {
                return true;
            }
            
            return false;
        }
        
        if ($user->role === 'Client') {
            $client = \App\Client::where('user_id', $user->id)->first();
            
            if (!$client) {
                return true; 
            }
            
            if (isset($client->status) && strtolower($client->status) === 'inactive') {
                return true;
            }
            
            $serial = null;
            
            if ($client->serial && isset($client->serial->serial_number)) {
                $serial = $client->serial->serial_number;
            } elseif (isset($client->serial_number)) {
                $serial = $client->serial_number;
            }
            
            if (empty($serial)) {
                return true;
            }
            
            return false;
        }
        
        return true;
    }
}