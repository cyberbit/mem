<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Note;
use Auth;

class NoteController extends Controller
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
     * Display all notes for the user.
     */
    public function index(Request $request) {
        return response()->json(['status' => 'success', 'result' => Auth::user()->notes]);
    }
    
    /**
     * Create new note.
     */
    public function create(Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);
        
        if (Auth::user()->notes()->create($request->all())) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'fail']);
        }
    }
}
