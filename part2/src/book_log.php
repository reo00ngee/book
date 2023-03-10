<?php


function connectSql()
{

  $link = mysqli_connect('db', 'book_log', 'pass', 'book_log');
  if (!$link) {
    echo PHP_EOL . 'Error: データベースに接続できませんでした' . PHP_EOL;
    echo 'Debugging error: ' . mysqli_connect_error() . PHP_EOL;
    exit;
  } else {
    echo PHP_EOL . 'データベースに接続できました' . PHP_EOL;
  }
  return $link;
}

$link = connectSql();

function validate($reviews)
{

  $errors = [];
  // 書籍名が正しく入力されているかチェック
  var_dump((int) $reviews['assessment']);
  if (!mb_strlen($reviews['title'])) {
    $errors['title'] = '書籍名を入力してください';
  } elseif (mb_strlen($reviews['title']) > 255) {
    $errors['title'] = '書籍名は255文字以内で入力してください';

  } elseif (mb_strlen($reviews['author']) > 255) {
    $errors['author'] = '著者名は255文字以内で入力してください';

  } elseif ($reviews['status'] !== 'not yet' && $reviews['status'] !== 'reading' && $reviews['status'] !== 'done') {
    $errors['status'] = '読書状況はnot yet,reading,doneのいずれかを記入してください';

  } elseif ($reviews['assessment'] === 0 || $reviews['assessment'] > 5) {
    $errors['assessment'] = '評価は1~5で入力してください';
  } elseif (!mb_strlen($reviews['assessment'])) {
    $errors['assessment'] = '評価は1~5で入力してください';

  } elseif (mb_strlen($reviews['impression']) > 2000) {
    $errors['impression'] = '感想は2000文字以内で入力してください';
  }


  return $errors;
}

function createReview($link)
{
  $reviews = [];
  echo PHP_EOL . '読書ログを登録してください' . PHP_EOL;
  echo '書籍名:';
  $reviews['title'] = trim(fgets(STDIN));

  echo '著者名:';
  $reviews['author'] = trim(fgets(STDIN));

  echo '読書状況（not yet,reading,done）:';
  $reviews['status'] = trim(fgets(STDIN));

  echo '評価（５点満点の整数）:';
  $reviews['assessment'] = trim(fgets(STDIN));


  echo '感想:';
  $reviews['impression'] = trim(fgets(STDIN));

  $validated = validate($reviews);
  if (count($validated) > 0) {
    foreach ($validated as $error) {
      echo $error . PHP_EOL;
    }
    return;
  }
  echo '登録が完了しました' . PHP_EOL . PHP_EOL;

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
  if ($result) {
    echo 'データを追加しました' . PHP_EOL;
  } else {
    echo 'データ登録に失敗しました' . PHP_EOL;
  }
}

function showData($link)
{
  echo '読書ログを表示します' . PHP_EOL;

  $select = "SELECT * FROM book_log";
  $results = mysqli_query($link, $select);

  while ($book_log = mysqli_fetch_assoc($results)) {
    echo 'ID:' . $book_log['id'] . PHP_EOL;
    echo '書籍名：' . $book_log['title'] . PHP_EOL;
    echo '著者名:' . $book_log['author'] . PHP_EOL;
    echo '読書状況:' . $book_log['status'] . PHP_EOL;
    echo '評価:' . $book_log['assessment'] . PHP_EOL;
    echo '感想:' . $book_log['impression'] . PHP_EOL;
    echo '-------------------' . PHP_EOL;
  }
  mysqli_free_result($results);
}
// ここから処理が始まる。ここより上は関数の定義。
while (true) {
  connectSql();
  echo '1. 読書ログを登録' . PHP_EOL;
  echo '2. 読書ログを表示' . PHP_EOL;
  echo '9. アプリケーションを終了' . PHP_EOL;
  echo '番号を選択してください(1,2,9):';
  $num = trim(fgets(STDIN));

  if ($num === '1') {
    // 読書ログを登録する
    createReview($link);
  } elseif ($num === '2') {
    // 読書ログを表示する
    showData($link);


  } elseif ($num === '9') {
    // アプリケーションを終了する
    mysqli_close($link);
    echo 'データベースとの接続を切断しました' . PHP_EOL;
    break;
  }
}