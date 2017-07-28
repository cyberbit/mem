<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Note;
use App\User;
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
     * Return all notes for the user.
     */
    public function all(Request $request) {
        return response()->json(['status' => 'success', 'notes' => Auth::user()->notes()->with('user')->get()]);
    }
    
    /**
     * Return single note assigned to the user by ID.
     */
    public function one(Request $request, $id) {
        $note = Auth::user()->notes()->with('user')->find($id);
        
        if ($note) {
            return response()->json(['status' => 'success', 'note' => $note]);
        } else {
            return response()->json(['status' => 'fail']);
        }
    }
    
    /**
     * Display all notes for the user.
     */
    public function index(Request $request) {
        return view('notes', ['notes' => Auth::user()->notes()->with('user')->get()]);
    }
    
    /**
     * Display single note.
     */
    public function view(Request $request, $id) {
        $note = Auth::user()->notes->find($id);
        
        if ($note) {
            return view('note.view', ['note' => $note]);
        } else {
            return view("modal.alert", [
                'context' => "danger",
                'title' => "Error",
                'msg' => "Cannot access this note."
            ]);
        }
    }
    
    /**
     * Display create note form.
     */
    public function createView(Request $request) {
        return view('note.create');
    }
    
    /**
     * Display update note form.
     */
    public function updateView(Request $request, $id) {
        $note = Auth::user()->notes->find($id);
        
        if ($note) {
            return view('note.update', ['note' => $note]);
        } else {
            return view("modal.alert", [
                'context' => "danger",
                'title' => "Error",
                'msg' => "Cannot access this note."
            ]);
        }
    }
    
    /**
     * Display delete note confirmation.
     */
    public function deleteView(Request $request, $id) {
        $note = Auth::user()->notes->find($id);
        
        if ($note) {
            return view('note.delete', ['note' => $note]);
        } else {
            return view("modal.alert", [
                'context' => "danger",
                'title' => "Error",
                'msg' => "Cannot access this note."
            ]);
        }
    }
    
    /**
     * Create new note.
     */
    public function create(Request $request) {
        //return response()->json(['auth_notes' => Auth::user()->notes]);
        
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);
        
        $note = Auth::user()->notes()->create($request->all());
        
        if ($note) {
            if ($request->has('redirect')) {
                return redirect()->route('notes', ['api_token' => Auth::user()->api_token]);
            } else {
                return response()->json(['status' => 'success', 'note' => $note]);
            }
        } else {
            return response()->json(['status' => 'fail']);
        }
    }
    
    /**
     * Update existing note.
     */
    public function update(Request $request, $id) {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);
        
        $note = Auth::user()->notes->find($id);
        
        if ($note and $note->update($request->all())) {
            if ($request->has('redirect')) {
                return redirect()->route('notes', ['api_token' => Auth::user()->api_token]);
            } else {
                return response()->json(['status' => 'success', 'note' => $note]);
            }
        } else {
            return response()->json(['status' => 'fail']);
        }
    }
    
    /**
     * Delete note.
     */
    public function delete(Request $request, $id) {
        $note = Auth::user()->notes->find($id);
        
        if ($note and $note->delete()) {
            if ($request->has('redirect')) {
                return redirect()->route('notes', ['api_token' => Auth::user()->api_token]);
            } else {
                return response()->json(['status' => 'success']);
            }
        } else {
            return response()->json(['status' => 'fail']);
        }
    }
}
