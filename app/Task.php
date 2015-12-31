<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    public static $rules = [
        'content' => 'required',
    ];

    public function taskCategory() {
        return $this->hasOne('App\TaskCategory');
    }

    protected $fillable = [
        'content',
        'is_completed',
        'task_category_id',
    ];
}
