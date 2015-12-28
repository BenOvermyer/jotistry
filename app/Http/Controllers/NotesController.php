<?php

namespace App\Http\Controllers;

class NotesController extends Controller
{
    public function index()
    {
        return view('notes.index', ['pageTitle' => 'Notes']);
    }

  	public function save($note)
  	{

  	}

  	public function delete($note)
  	{

  	}
}
