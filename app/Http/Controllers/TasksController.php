<?php

namespace App\Http\Controllers;

use App\Task;
use App\TaskCategory;
use Illuminate\Support\Facades\Input;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::where('is_completed', false)->get();
        $taskCategories = TaskCategory::all();

        return view('tasks.index', ['pageTitle' => 'Tasks'])->with(['tasks' => $tasks, 'taskCategories' => $taskCategories]);
    }

    public function all()
    {
        $tasks = Task::all();

        return response()->json($tasks);
    }

    public function byCategory( $id ) {
        $tasks = Task::where('task_category_id', $id)->where('is_completed', 0)->get();

        return response()->json($tasks);
    }

    public function save()
    {
        $data = Input::all();

        $task = Task::create($data);

        if ($task) {
            return response()->json($task);
        } else {
            return response(500);
        }
    }

    public function update($id)
    {
        $task = Task::findOrFail($id);

        $data = Input::all();

        if ($task->update($data)) {
            return response()->json($task);
        } else {
            return response(500);
        }
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        if ($task->delete()) {
            return response(204);
        } else {
            return response(500);
        }
    }
}
