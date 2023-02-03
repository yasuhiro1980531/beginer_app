<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\User;
use App\Http\Requests\TodoRequest;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index() {
        $user = Auth::user();
        $todos = Todo::all();
        $param =['todos' => $todos, 'user' =>$user];
        return view('index',$param);
    }

    public function store(TodoRequest $request){
    $new_todo = new Todo;
    $form = $request->all();
    unset($form['_token']);
    Todo::create($form) -> save();
    return redirect('/');
  }
    public function update(TodoRequest $request) {
      $form = $request->all();
      unset($form['_token']);
      Todo::where('id',$request->id)->update($form);
      return redirect('/');
    }

    public function destroy(Request $request)
    {
      Todo::find($request->id)->delete();
      return redirect('/');
    }
}
