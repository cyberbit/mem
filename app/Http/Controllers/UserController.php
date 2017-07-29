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
     * Return current User object.
     */
    public function me(Request $request) {
        return response()->json(['status' => 'success', 'user' => Auth::user()->makeVisible(['created_at', 'updated_at'])]);
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
        
        // Find user by email
        $user = User::where('email', $request->input('email'))->first();
        
        // Authenticate user via password hash
        if ($user and Hash::check($request->input('password'), $user->password)) {
            // Generate API token and update User model
            $api_token = base64_encode(str_random(24));
            User::where('email', $request->input('email'))->update(['api_token' => "$api_token"]);
            
            if ($request->has('redirect')) {
                return redirect()->route('notes', ['api_token' => $api_token]);
            } else {
                return response()->json(['status' => 'success', 'api_token' => $api_token]);
            }
        } else {
            if ($request->has('redirect')) {
                return redirect()->route('login', ['error' => 1]);
            } else {
                return response()->json(['status' => 'fail'], 401);
            }
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
        
        // API request
        if ($request->is('api/*')) {
            return response()->json(['status' => 'success']);
        }
        
        // Non-API request
        else {
            // Redirect to homepage
            return redirect()->route('home');
        }
    }
}
