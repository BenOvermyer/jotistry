<?php

namespace App\Http\Controllers;

use App\JournalEntry;
use App\Note;
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
        $journalEntryCount = JournalEntry::count();

        $issues = githubapi()->issues();
        $pullRequests = githubapi()->pullRequests();

        return view('home.dashboard', ['pageTitle' => 'Dashboard'])->with([
            'noteCount'    => $noteCount,
            'journalEntryCount' => $journalEntryCount,
            'issues'       => $issues,
            'pullRequests' => $pullRequests,
        ]);
    }
}
