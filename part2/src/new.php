<?php
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>読書ログの登録</title>
</head>
<body>
  <h1>読書ログの登録</h1>
  <form action="create.php" method="POST">
    <div>
      <label for="title">書籍名</label>
      <input type="text" name="title" id="title" >
    </div>
    <div>
      <label for="author">著者名</label>
      <input type="text" name="author" id="author" >
    </div>
    <div>
      <label>読書状況</label>
      
      <input type="radio" name="status" id="status1" value="未読">
      <label for="status">未読</label>
      <input type="radio" name="status" id="status2" value="読んでいる">
      <label for="status">読んでいる</label>
      <input type="radio" name="status" id="status3" value="読了">
      <label for="status">読了</label>
    </div>
    <div>
      <label for="assessment">評価</label>
      <input type="number" name = "assessment" id="assessment" >
    </div>
    <div>
      <label for="impression">感想</label>
      <textarea type="text" id="impression" name="impression" cols="50" rows="10"></textarea>
    </div>
    <button type = "submit">送信</button>
  </form>
</body>
</html>

