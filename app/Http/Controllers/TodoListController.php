<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TodoList;
use App\TodoItem;
use Validator;
use Input;

class TodoListController extends Controller
{
    /*
     * Display a listing of the resource.
     * 
     * @return Response
     */
    public function index()
    {
        $todo_lists = TodoList::all();
        return view('todos.index')->with('todo_lists', $todo_lists);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return Response
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @return Response
     */
    public function store(Request $request)
    {
        // define rules
        $rules = array (
            'name' => array('required','unique:todo_lists')
        );

        // pass input validator
        $validator = Validator::make($request->all(), $rules);

        // test if input is fails
        if ($validator->fails() ) {
            return redirect()->route('todos.create')->withErrors($validator)->withInput();
        }

        $name = $request->input('name');
        $list = new TodoList();
        $list->name = $name;
        $list->save();
        return redirect()->route('todos.index')->withMessage('Successfully Added List');
        
    }

    /**
     * Display the specified resource.
     * 
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $list = TodoList::findOrFail($id);
        $items = $list->listItems()->get();
        return view('todos.show')
            ->withList($list)
            ->withItems($items);
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $list = TodoList::findOrFail($id);
        return view('todos.edit')->withList($list);
    }

    /**
     * Update the specified resource i storage.
     * 
     * @param int $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        
        // define rules
        $rules = array (
           'name' => array('required','unique:todo_lists')
        );

        // pass input validator
        $validator = Validator::make($request->all(), $rules);

        // test if input is fails
        if ($validator->fails() ) {
            return redirect()->route('todos.edit', $id)->withErrors($validator)->withInput();
        }

        $name = $request->input('name');
        $list = TodoList::findOrFail($id);
        $list->name = $name;
        $list->update();
        return redirect()->route('todos.index')->withMessage('Successfully list was updated');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $todo_lists = TodoList::findOrFail($id)->delete();

        return redirect()->route('todos.index')->withMessage('Successfully Deleted');
    }

    
}
