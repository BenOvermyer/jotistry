<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class NotesAPIController extends Controller
{
    public function __construct()
    {
        $this->userId = Auth::guard( 'api' )->user()->id;
    }

    public function index()
    {
        $notes = Note::where( 'author_id', $this->userId )->orderBy( 'updated_at', 'desc' )->get();

        return $notes;
    }

    public function show( $id )
    {
        $note = Note::findOrFail( $id );

        if ( $note->author_id == $this->userId ) {
            return $note;
        }

        return response( 404 );
    }

    public function save()
    {
        $data = Input::all();
        $data[ 'author_id' ] = $this->userId;

        $note = Note::create( $data );

        if ( $note ) {
            datadog()->inc( 'notes.new' );
            return $note;
        } else {
            return response( 500 );
        }
    }

    public function update( $id )
    {
        $note = Note::findOrFail( $id );

        if ( $note->author_id == $this->userId ) {
            $data = Input::all();

            if ( $note->update( $data ) ) {
                datadog()->inc( 'notes.updates' );
                return $note;
            } else {
                return response( 500 );
            }
        }

        return response( 403 );
    }

    public function destroy( $id )
    {
        $note = Note::findOrFail( $id );

        if ( $note->author_id == $this->userId ) {

            if ( $note->delete() ) {
                datadog()->inc( 'notes.deletes' );
                return response( 204 );
            } else {
                return response( 500 );
            }
        }

        return response( 403 );
    }
}
