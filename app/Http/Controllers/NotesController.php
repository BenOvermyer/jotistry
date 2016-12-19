<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class NotesController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        $notes = Note::where('author_id', $userId)->orderBy('updated_at', 'desc')->get();

        return view('notes.index', ['pageTitle' => 'Notes'])->with(['notes' => $notes]);
    }

    public function all()
    {
        $userId = Auth::user()->id;
        $notes = Note::where('author_id', $userId)->get();

        return response()->json($notes);
    }

    public function save()
    {
        $data = Input::all();
        $data['author_id'] = Auth::user()->id;

        $note = Note::create($data);

        if ($note) {
            datadog()->inc('notes.new');
            return response()->json($note);
        } else {
            return response(500);
        }
    }

    public function update($id)
    {
        $note = Note::findOrFail($id);

        $data = Input::all();

        if ($note->update($data)) {
            datadog()->inc('notes.updates');
            return response()->json($note);
        } else {
            return response(500);
        }
    }

    public function destroy($id)
    {
        $note = Note::findOrFail($id);

        if ($note->delete()) {
            datadog()->inc('notes.deletes');
            return response(204);
        } else {
            return response(500);
        }
    }
}
