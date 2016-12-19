<?php

namespace App\Http\Controllers;

use App\JournalEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Input;

class JournalEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::user()->id;
        $journalEntries = JournalEntry::where('author_id', $userId)->orderBy('updated_at', 'desc')->get();

        return view('journal.index', ['pageTitle' => 'Journal'])->with(['entries' => $journalEntries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('journal.create', ['pageTitle' => 'Journal']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Input::all();
        $data['author_id'] = Auth::user()->id;

        $journalEntry = JournalEntry::create($data);

        if ($journalEntry) {
            datadog()->inc('journal_entries.new');
            return redirect()->route('journalentries.index');
        } else {
            return response(500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $journalEntry = JournalEntry::findOrFail($id);

        return view('journal.show', ['pageTitle' => 'Journal'])->with(['journalentry' => $journalEntry]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $journalEntry = JournalEntry::findOrFail($id);

        return view('journal.edit', ['pageTitle' => 'Journal'])->with(['journalentry' => $journalEntry]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $journalEntry = JournalEntry::findOrFail($id);

        $data = Input::all();

        if ($journalEntry->update($data)) {
            datadog()->inc('journal_entries.updates');
            return redirect()->route('journalentries.index');
        } else {
            return response(500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $journalEntry = JournalEntry::findOrFail($id);

        if ($journalEntry->delete()) {
            datadog()->inc('journal_entries.deletes');
            return redirect()->route('journalentries.index');
        } else {
            return response(500);
        }
    }
}
