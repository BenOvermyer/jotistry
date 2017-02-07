<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    public function index()
    {
        return view( 'tasks.index', [
            'pageTitle' => 'Tasks',
            'apiToken' => Auth::user()->api_token
        ] );
    }
}
