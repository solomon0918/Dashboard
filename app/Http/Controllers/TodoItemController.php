<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TodoList;
use App\TodoItem;

class TodoItemController extends Controller
{
    public function create($Todo_id)
    {
        $todo_list = TodoList::findOrFail($Todo_id);
        return view('items.create')->withTodoList($todo_list);
    }

    public function store()
    {
        //
    }

    public function edit()
    {
        //
    }

    public function destroy()
    {
        //
    }
}

