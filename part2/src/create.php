<?php

require_once __DIR__ . '/mysqli.php';

function createReview($link, $reviews)
{
  $register = <<<EOT
  INSERT INTO book_log(
    title,author,status,assessment,impression
    )VALUES(
      "{$reviews['title']}",
      "{$reviews['author']}",
      "{$reviews['status']}",
      "{$reviews['assessment']}",
      "{$reviews['impression']}"
      )
EOT;
  $result = mysqli_query($link, $register);
  if (!$result) {
    error_log('Error: fail to create reviews');
    error_log('Debugging error' . mysqli_error($link));
  }
}

function validate($reviews){
  $errors = [];

  if (!mb_strlen($reviews['title'])) {
    $errors['title'] = '書籍名を入力してください';
  } elseif (mb_strlen($reviews['title']) > 255) {
    $errors['title'] = '書籍名は255文字以内で入力してください';

  } elseif (mb_strlen($reviews['author']) > 255) {
    $errors['author'] = '著者名は255文字以内で入力してください';

  } elseif ($reviews['status'] !== '未読' && $reviews['status'] !== '読んでいる' && $reviews['status'] !== '読了') {
    $errors['status'] = '読書状況は未読,読んでいる,読了のいずれかを記入してください';

  } elseif ($reviews['assessment'] === 0 || $reviews['assessment'] > 5) {
    $errors['assessment'] = '評価は1~5で入力してください';
  } elseif (!mb_strlen($reviews['assessment'])) {
    $errors['assessment'] = '評価は1~5で入力してください';

  } elseif (mb_strlen($reviews['impression']) > 2000) {
    $errors['impression'] = '感想は2000文字以内で入力してください';
  }
  return $errors;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $reviews = [
    'title' => $_POST['title'],
    'author' => $_POST['author'],
    'status' => $_POST['status'],
    'assessment' => $_POST['assessment'],
    'impression' => $_POST['impression']
  ];

  $errors = validate($reviews);
  if (!count($errors)) {
    $link = dbConnect();
    createReview($link, $reviews);
    mysqli_close($link);

    header("Location: index.php");
  }
}

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
    <?php if(count($errors)) : ?>
      <ul>
        <?php foreach($errors as $error) : ?>
          <li><?php echo $error; ?></li>
          <?php endforeach; ?>
      </ul>
    <?php endif; ?>  
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