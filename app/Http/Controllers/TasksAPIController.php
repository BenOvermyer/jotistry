<?php

namespace App\Http\Controllers;

use App\Task;
use App\TaskCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class TasksAPIController extends Controller
{
    public function __construct()
    {
        $this->userId = Auth::guard( 'api' )->user()->id;
    }

    public function index()
    {
        $tasks = Task::where( 'is_completed', false )->where( 'task_category_id', 0 )->where( 'author_id', $this->userId )->get();
        $taskCategories = TaskCategory::where( 'author_id', $this->userId )->get();

        $data = [
            'tasks' => $tasks,
            'categories' => $taskCategories,
        ];

        return $data;
    }

    public function show( $id )
    {
        $task = Task::findOrFail( $id );

        if ( $task->author_id == $this->userId ) {
            return $task;
        }

        return response( 404 );
    }

    public function all()
    {
        $tasks = Task::where( 'author_id', $this->userId )->get();

        return $tasks;
    }

    public function byCategory( $id )
    {
        $tasks = Task::where( 'task_category_id', $id )->where( 'author_id', $this->userId )->where( 'is_completed', 0 )->get();

        return $tasks;
    }

    public function save()
    {
        $data = Input::all();

        $data[ 'author_id' ] = $this->userId;

        $task = Task::create( $data );

        if ( $task ) {
            datadog()->inc( 'tasks.new' );
            return $task;
        } else {
            return response( 500 );
        }
    }

    public function update( $id )
    {
        $task = Task::findOrFail( $id );

        $data = Input::all();

        if ( $task->update( $data ) ) {
            datadog()->inc( 'tasks.updates' );
            return $task;
        } else {
            return response( 500 );
        }
    }

    public function destroy( $id )
    {
        $task = Task::findOrFail( $id );

        if ( $task->delete() ) {
            datadog()->inc( 'tasks.deletes' );
            return response( 204 );
        } else {
            return response( 500 );
        }
    }
}
