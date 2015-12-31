<?php

namespace App\Http\Controllers;

use App\TaskCategory;
use Illuminate\Support\Facades\Input;

class TaskCategoryController extends Controller
{
    public function all()
    {
        $taskCategories = TaskCategory::all();

        return response()->json($taskCategories);
    }

    public function save()
    {
        $data = Input::all();

        $taskCategory = TaskCategory::create($data);

        if ($taskCategory) {
            return response()->json($taskCategory);
        } else {
            return response(500);
        }
    }

    public function update($id)
    {
        $taskCategory = TaskCategory::findOrFail($id);

        $data = Input::all();

        if ($taskCategory->update($data)) {
            return response()->json($taskCategory);
        } else {
            return response(500);
        }
    }

    public function destroy($id)
    {
        $taskCategory = TaskCategory::findOrFail($id);

        if ($taskCategory->delete()) {
            return response(204);
        } else {
            return response(500);
        }
    }
}
