<?php

namespace App\Http\Controllers;

use App\Note;
use GrahamCampbell\GitHub\Facades\GitHub;
use Cache;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index', ['pageTitle' => 'Home']);
    }

    public function dashboard()
    {
        $noteCount = Note::count();

        $issues = Cache::remember( 'github-issues', 20, function() {
            return GitHub::me()->issues();
        });

        return view('home.dashboard', ['pageTitle' => 'Dashboard'])->with(['noteCount' => $noteCount, 'issues' => $issues]);
    }
}
