<?php

namespace App\Http\Controllers;

use App\JournalEntry;
use App\Note;
use Illuminate\Support\Facades\Auth;
use Cache;

class HomeController extends Controller
{
    public function index()
    {
        return redirect()->route( 'dashboard' );
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
