<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        //get all todos
        $todolist = Todo::all();
        // return view('todos.index')->with('todolist', $todolist);
        return response()->json($todolist);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('todos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // $url = '/newapp/public/todos'; 
        // $this->validate($request, ['task'=>'required', 'complete'=>'required']);
        $todo = new Todo;
        $todo->task = $request->input('task');
        $todo->status = $request->input('status');
        $todo->save();
        // return header( "Location: $url" );
        return response()->json([
            "this uri is todos, http method is POST",
            "page is used to store a new todo task into database",
            'get all todo details from the request variable like $request->task'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $todo = Todo::find($id);
        return view('todos.show')->with('todo', $todo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $todo = Todo::find($id);
        if($todo->status == 'pending')
            $todo->status = 'complete';
        else
            $todo->status = 'pending';
        $todo.save();

        return response()->json([
            "this uri is todos/{todo}, http method is PUT",
            'everything inside {} means it is a parameter which will be retrieved by this function via $id variable',
            'get the todo task data which is edited by user and update the same record in database'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $todo = Todo::find($id);
        $todo->delete();
        // return delete;
        return response()->json([
            "this uri is todos/{todo}, http method is DELETE",
            'everything inside {} means it is a parameter which will be retrieved by this function via $id variable',
            'delete one specific todo '
        ]);
    }
}
