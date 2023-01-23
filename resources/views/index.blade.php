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

  .back {
    background-color:#2d197c;
    height:100vh;
    width:100vw;
    position:relative;
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

  .enter{
    width:70%
    
  }
</style>
<div class="back">
  <div class="listarea">
    <h2>Todo List</h2>
    <div class="todo">
      <input class="enter" type="text" method="post" name="content">
      <input class="btn add"type="submit" value="追加" action="/todos/create" method="post">
      <div class="logarea">
      <table>
        <tr>
          <th>作成日</th>
          <th>タスク名</th>
          <th>更新</th>
          <th>削除</th>
        </tr>
        @foreach ($todos as $todo)
        <tr>
        <td>{{$todo->created_at}}</td>
        <td><input type="text" value="{{$todo->content}}">
          </td>
        <td><input class="btn update" type="submit" value="更新"></td>
        <td><input class="btn delete" type="submit" value="削除"></td>
        </tr>
        @endforeach
      </table>
      </div>
    </div>
  </div>
</div>
</body>
</html>