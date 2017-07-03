<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use Auth;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:api');
    }

    /**
     * Authenticate the user with an email and password.
     *
     * This method will generate and return an API token that
     * is associated with the user until the user is logged out.
     */
    public function authenticate(Request $request) {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        
        $user = User::where('email', $request->input('email'))->first();
        
        if (Hash::check($request->input('password'), $user->password)) {
            $api_token = base64_encode(str_random(24));
            
            User::where('email', $request->input('email'))->update(['api_token' => "$api_token"]);
            
            return response()->json(['status' => 'success', 'api_token' => $api_token]);
        } else {
            return response()->json(['status' => 'fail'], 401);
        }
    }
    
    /**
     * Logout of the user associated to the provided API token.
     */
    public function logout(Request $request) {
        // Revoke current user's API token
        $user = Auth::user();
        $user->api_token = null;
        $user->save();
        
        return response()->json(['status' => 'success']);
    }
}
