<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'notes';

    public static $rules = [
        'title' => 'required',
        'body' => 'required',
    ];

    protected $fillable = [
        'title',
        'body',
        'author_id',
    ];

    protected $appends = [
        'summary',
    ];

    public function author()
    {
        return $this->belongsTo( 'App\User' );
    }

    public function getBodyAttribute( $value )
    {
        return strip_tags( $value );
    }

    public function getSummaryAttribute()
    {
        $summary = strip_tags( $this->body );

        if ( strlen( $summary ) > 144 ) {
            $summary = substr( $summary, 0, 144 ) . '...';
        }

        return $summary;
    }
}
