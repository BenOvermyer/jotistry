<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    public static $rules = [
        'email' => 'required|email|unique:users,email,{id}',
        'name' => 'required',
        'password' => 'required|confirmed',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'name', 'email', 'password', 'state', 'city' ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [ 'password', 'remember_token', 'api_token' ];

    public function notes()
    {
        return $this->hasMany( 'App\Note', 'author_id' );
    }

    public function tasks()
    {
        return $this->hasMany( 'App\Task', 'author_id' );
    }

    public function taskCategories()
    {
        return $this->hasMany( 'App\TaskCategory', 'author_id' );
    }

    public function journalEntries()
    {
        return $this->hasMany( 'App\JournalEntry', 'author_id' );
    }
}
