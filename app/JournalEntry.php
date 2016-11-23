<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JournalEntry extends Model
{
    protected $table = 'journalentries';

    public static $rules = [
        'body'  => 'required',
    ];

    protected $fillable = [
        'body',
    ];
}
