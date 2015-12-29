<?php

namespace App\Http\Controllers;

use App\Note;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index', ['pageTitle' => 'Home']);
    }

    public function dashboard()
    {
        $noteCount = Note::count();

        return view('home.dashboard', ['pageTitle' => 'Dashboard'])->with(['noteCount' => $noteCount]);
    }
}
