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
        $param =
        [
          'todos' => $todos,
          'user' =>$user,
          'tags' => $tags
        ];
        return view('index',$param);
    }

    public function store(TodoRequest $request)
    {
    Todo::create([
      'content' =>  $request->content,
      'user_id' => Auth::id(),
      'tag_id' => $request->tag_id
    ]);
    return redirect('/home');
  }
    public function update(TodoRequest $request) 
    {
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

    public function find(){
      $user = Auth::user();
      $todos = [];
      $tags = Tag::all();
      $param =
      [
        'todos' => $todos,
        'user' =>$user,
        'tags' => $tags
      ];
      return view('search',$param);
    }

    public function search(Request $request){
      $user = Auth::user();
      $tags = Tag::all();
      $keyword = $request->input('keyword');
      $tag_id = $request->input('tag_id');
      $query = Todo::query();
      if(!empty($keyword)){
        $query->where('content','LIKE',"%{$keyword}%");
      }elseif(empty($keyword)){
        $query->where('tag_id',$tag_id);
      };
      $todos = $query->get();
      $param =
      [
        'todos' => $todos,
        'user' =>$user,
        'tags' => $tags,
      ];
      return view('search',$param);
    }
}
