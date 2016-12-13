<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'notes';

    public static $rules = [
        'title' => 'required',
        'body'  => 'required',
    ];

    protected $fillable = [
        'title',
        'body',
        'author_id',
    ];

    public function author()
    {
        return $this->belongsTo( 'App\User' );
    }
}
