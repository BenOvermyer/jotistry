<?php

namespace App\Http\Controllers;

use App\TaskCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class TaskCategoriesAPIController extends Controller
{
    public function __construct()
    {
        $this->userId = Auth::guard( 'api' )->user()->id;
    }

    public function index()
    {
        $taskCategories = TaskCategory::where( 'author_id', $this->userId )->get();

        return $taskCategories;
    }

    public function save()
    {
        $data = Input::all();
        $data[ 'author_id' ] = $this->userId;

        $taskCategory = TaskCategory::create( $data );

        if ( $taskCategory ) {
            datadog()->inc( 'task_categories.new' );
            return $taskCategory;
        } else {
            return response( 500 );
        }
    }

    public function update( $id )
    {
        $taskCategory = TaskCategory::findOrFail( $id );

        $data = Input::all();

        if ( $taskCategory->update( $data ) ) {
            datadog()->inc( 'task_categories.updates' );
            return $taskCategory;
        } else {
            return response( 500 );
        }
    }

    public function destroy( $id )
    {
        $taskCategory = TaskCategory::findOrFail( $id );

        if ( $taskCategory->delete() ) {
            datadog()->inc( 'task_categories.deletes' );
            return response( 204 );
        } else {
            return response( 500 );
        }
    }
}
