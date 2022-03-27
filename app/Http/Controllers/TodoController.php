<?php

namespace App\Http\Controllers;


use App\Models\Todo;
use App\Models\TodoDetail;
use Illuminate\Http\Request;
use Response;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todo = Todo::get();
        return view('todo.list', compact('todo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //create post
        Todo::create([
            'name'     => $request->name
        ]);

        //redirect to index
        return redirect('/');
    }

    public function storedetail(Request $request)
    {
        //create post detail
        $todo = TodoDetail::create([
            'name'     => $request->name,
            'todo_id'     => $request->todo_id,
            'order_id' => 1
        ]);

        return $todo->id;
    }

    public function showDetail($id) {
        $todoDetail = TodoDetail::find($id);

        $view=view('todo.list-detail', compact('todoDetail'));
     
        $response = Response::make($view, 200);
        $response->header('Content-Type', 'text/plain');
        return $response;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        //
        Todo::destroy($todo->id);
        return redirect('/');
    }

    public function destroydetail($id)
    {
        //dd($id);
        TodoDetail::destroy($id);
        return redirect('/');
    }

    public function updatedetail(Request $request, TodoDetail $todo)
    {
        //create post detail

        $todoupdate = TodoDetail::where('id', $todo->id)
            ->update([
                'name' => $request->name,
        ]);

        return redirect('/');
        //return $todoupdate->id;
    }
}
