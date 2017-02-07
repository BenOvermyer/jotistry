<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
{
    public function index()
    {
        return view( 'notes.index', [
            'pageTitle' => 'Notes',
            'apiToken' => Auth::user()->api_token
        ] );
    }
}
