<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskCategory extends Model
{
    protected $table = 'task_categories';

    public static $rules = [
        'title' => 'required',
    ];

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

    protected $fillable = [
        'title',
    ];
}
