<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Http\Requests\TodoRequest;

class TodoController extends Controller
{
    public function index() {
        $todos = Todo::all();
        return view('index',['todos' => $todos]);
    }

    public function store(TodoRequest $request)
  {
    $new_todo = new Todo;
    $form = $request->all();
    unset($form['_token']);
    Todo::create($form) -> save();
    return redirect('/');
  }

    public function destroy(TodoRequest $request)
    {
      Todo::find($request->id)->delete();
      return redirect('/');
    }
}
