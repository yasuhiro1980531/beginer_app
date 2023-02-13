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

a {
  text-decoration:none;
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
  width:70%;
  border-radius:10px;
  font-size:16px;
}

.tagSelect{
  border:1px solid #D3D3D3;
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

.search{
  display:inline-block;
  margin-bottom:20px;
  border: 2px solid #cdf119;
  color: #cdf119;
  transition:0.4s;
}

.search:hover{
  color:#FFF;
  background-color:#cdf119;
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

.login_area {
  margin-bottom:20px;
}

.logout {
  color:red;
  font-weight:bold;
  border:2px solid red;
  translate:0.4s;
}

.logout:hover{
  color:white;
  background-color:red;
}

.login-name {
  margin-right:30px;
  display:inline-block;
  margin-top:10px;
}

.return {
  display:block;
  margin-top:20px;
  border: 2px solid #6d7170;
  color: #6d7170;
  background-color: #fff;
  font-weight:bold;
  translate:0.4s;
}

.return:hover{
  color:white;
  background-color:#6d7170;
}

</style>
<div class="container">
  <div class="listarea">
    <div class="todoheader flex__item">
      <h2>タスク検索</h2>
      <div class="login_area flex__item">
        @if (Auth::check())
        <p class="login-name">「{{$user->name}}」でログイン中</p>
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
          @if(!isset($todos))
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
      <a href="http://127.0.0.1:8000/home">
        <input class="btn return" type="submit" value="戻る">
      </a>
    </div>
  </div>
</div>
</body>
</html>