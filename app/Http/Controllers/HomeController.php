<?php

namespace App\Http\Controllers;

use App\JournalEntry;
use App\Note;
use App\Task;
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
        $userId = Auth::user()->id;
        $noteCount = Note::where('author_id', $userId)->count();
        $journalEntryCount = JournalEntry::where('author_id', $userId)->count();
        $taskCount = Task::where('author_id', $userId)->where('is_completed', 0)->count();

        return view('home.dashboard', ['pageTitle' => 'Dashboard'])->with([
            'noteCount'    => $noteCount,
            'journalEntryCount' => $journalEntryCount,
            'taskCount' => $taskCount,
        ]);
    }
}
