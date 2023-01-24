<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<style>
html, body, div, span, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
abbr, address, cite, code,
del, dfn, em, img, ins, kbd, q, samp,
small, strong, sub, sup, var,
b, i,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, figcaption, figure,
footer, header, hgroup, menu, nav, section, summary,
time, mark, audio, video {
  margin:0;
  padding:0;
  border:0;
  outline:0;
  font-size:100%;
  vertical-align:baseline;
  background:transparent;
}

input {
  border:1px solid #D3D3D3;
  display:block;
}

input:focus {
  outline:none;
}

  .container {
    background-color:#2d197c;
    height:100vh;
    width:100vw;
    position:relative;
  }

  .flex__item {
    display:flex;
    justify-content:space-between;
  }

  .listarea {
    background-color:#fff;
    width:50vw;
    padding:30px;
    position:absolute;
    top:50%;
    left:50%;
    transform:translate(-50%,-50%)
  }

  .listarea h2 {
    font-size:30px;
  }

  .addarea {
    height:50px;
    margin-bottom:20px;
  }

  .enter{
    width:80%;
    border-radius:10px;
    font-size:16px;
  }
  table {
    width:100%;
    border-collapse:collapse;
  }

  tr {
    height:40px;
  }

  .th1{
    text-align:center;
    width: 150px;
  }

  .th2{
    text-align:center;
    width: 60px;
  }

  .th3 {
    text-align:center;
    width: 250px;
  }
  td {
    text-align:center;
  }

.content__log {
  display:block;
  margin:0 auto;
  align-items:center;
  width:90%;
  border-radius:5px;
  padding:10px;
  font-size:14px;
}

  .btn {
    background-color:#fff;
    padding:10px 20px;
    border-radius:10px;
  }

  .add {
    border:2px solid #dc70fa;
    color:#dc70fa;
    transition:0.4s;
    font-weight:bold;
  }

  .add:hover{
    color:#FFF;
    background-color:#dc70fa;
  }

  .update {
    display:block;
    margin:0 auto;
    border:2px solid #fa9770;
    color:#fa9770;
    transition:0.4s;
    font-weight:bold;
  }

  .update:hover{
    color:#FFF;
    background-color:#fa9770;
  }

  .delete {
    display:block;
    margin:0 auto;
    border:2px solid #71fadc;
    color:#71fadc;
    transition:0.4s;
    font-weight:bold;
  }

  .delete:hover{
    color:#FFF;
    background-color:#71fadc;
  }

</style>
<div class="container">
  <div class="listarea">
    <h2>Todo List</h2>
    <div class="todo">
        @error('content')
        <p>{{$message}}</p>
        @enderror
    <form action="/todos/create" method="post" class="addarea flex__item">
        @csrf
      <input class="enter" type="text" method="post" name="content">
      <input class="btn add"type="submit" value="追加">
      </form>
      <table>
        <tr>
          <th class="th1">作成日</th>
          <th class="th3">タスク名</th>
          <th class="th2">更新</th>
          <th class="th2">削除</th>
        </tr>
        @foreach ($todos as $todo)
        <tr>
        <td>{{$todo->created_at}}</td>
        <form action="{{route('todo.update',['id' =>$todo->id,'content'=>$todo->content])}}" method="post">
          @csrf
          <td><input type="text" name="content" value="{{$todo->content}}" class="content__log">
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
    </div>
  </div>
</div>
</body>
</html>