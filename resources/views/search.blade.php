@extends('layouts.app')
@section('content')
<div class="container">
  <div class="listarea">
    <div class="todoheader flex__item">
      <h2>タスク検索</h2>
      <div class="login_area flex__item">
        @if (Auth::check())
        <p class="login-name">「{{ $user->name }}」でログイン中</p>
        <form action="/logout" method="post">
          @csrf
          <input type="submit" value="ログアウト" class="btn logout">
        </form>
        @else
        <p>ログインしてください。（<a href="/login">ログイン</a>｜
        <a href="/register">登録</a>）</p>
        @endif
      </div>
    </div>
    <div class="todo">
    <form action="{{route('todo.search')}}" method="get" class="addarea flex__item">
        @csrf      
      <input class="enter" type="search" name="keyword">
      <select class="btn tagSelect" name="tag_id">
        <option value="" selected></option>
        @foreach($tags as $tag)
        <option value ="{{ $tag->id }}" 
        @foreach($todos as $todo)
        @if($todo->tag_id == $tag->id) selected @endif
        @endforeach>{{$tag->name}}</option>
        @endforeach
      </select>
      <input class="btn add"type="submit" value="検索">
      </form>
      <table>
        <tr>
          <th class="th1">作成日</th>
          <th class="th3">タスク名</th>
          <th class="th2">タグ</th>
          <th class="th2">更新</th>
          <th class="th2">削除</th>
        </tr>
          @if(isset($txt))
          <p>{{$txt}}</p>
          @endif
        @foreach ($todos as $todo)
        <tr>
        <td>{{$todo->created_at}}</td>
        <form action="{{route('todo.update',['id' =>$todo->id,'content'=>$todo->content])}}" method="post">
          @csrf
          <td><input type="text" name="content" value="{{$todo->content}}" class="content__log">
          </td>
          <td>
            <select class="btn tagSelect" name="tag_id">
              @foreach ($tags as $tag)
              <option value ="{{$tag->id}}" @if($todo->tag_id == $tag->id)selected @endif>{{$tag->name}}</option>
              @endforeach
            </select>
          </td>
          <td><input class="btn update" type="submit" value="更新"></td>
        </form>
        <form action="{{route('todo.destroy', ['id'=>$todo->id])}}" method="post">
          @csrf
          <td><input class="btn delete" type="submit" value="削除"></td>
        </form>
        </tr>
        @endforeach
      </table>
      <button class='btn btn_return'><a href="{{route('home')}}">戻る</a></button>
    </div>
  </div>
</div>
@endsection