<?php

namespace App\Http\Controllers;

use \App\Note;
use Illuminate\Support\Facades\Input;

class NotesController extends Controller
{
    public function index()
    {
        $notes = Note::orderBy('updated_at', 'desc')->get();

        return view('notes.index', ['pageTitle' => 'Notes'])->with(['notes' => $notes]);
    }

	public function all()
	{
		$notes = Note::all();

		return response()->json($notes);
	}

  	public function save()
  	{
        $data = Input::all();

        $note = Note::create( $data );

        if ($note) {
            return response()->json($note);
        } else {
            return response()->setStatusCode(500);
        }
  	}

    public function update( $id )
    {
        $note = Note::findOrFail( $id );

        $data = Input::all();

        if ($note->update( $data )) {
            return response()->json($note);
        } else {
            return response()->setStatusCode(500);
        }
    }

  	public function destroy($id)
  	{
        $note = Note::findOrFail($id);

        if ( $note->destroy()) {
            return response()->setStatusCode(204);
        } else {
            return response()->setStatusCode(500);
        }
  	}
}
