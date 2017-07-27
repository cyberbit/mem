<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Note;
use Auth;

class ViewController extends Controller
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
     * Home view
     */
    public function home(Request $request) {
        return view('home');
    }
    
    /**
     * Login view
     */
    public function login(Request $request) {
        return view('login', [
            'login' => true,
            'error' => $request->input('error')
        ]);
    }
}
