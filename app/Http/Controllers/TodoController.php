<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\User;
use App\Models\Tag;
use App\Http\Requests\TodoRequest;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index() {
        $user = Auth::user();
        $todos = $user->todos;
        $tags = Tag::all();
        $param =['todos' => $todos,'user' =>$user, 'tags' => $tags];
        return view('index',$param);
    }

    public function store(TodoRequest $request){
    $new_todo = new Todo;
    $new_todo->user_id = Auth::id();
    $new_todo->tag_id = $request->tag_id;
    $new_todo->content = $request->content;
    unset($new_todo['_token']);
    Todo::create([
      'content' =>  $new_todo->content,
      'user_id' => $new_todo->user_id,
      'tag_id' => $new_todo->tag_id
    ]);
    return redirect('/home');
  }
    public function update(TodoRequest $request) {
      $form = $request->all();
      unset($form['_token']);
      Todo::where('id',$request->id)->update($form);
      return redirect('/home');
    }

    public function destroy(Request $request)
    {
      Todo::find($request->id)->delete();
      return redirect('/home');
    }
}
