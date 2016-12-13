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
        'author_id',
    ];

    public function author()
    {
        return $this->belongsTo( 'App\User' );
    }
}
