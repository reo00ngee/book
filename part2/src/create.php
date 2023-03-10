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

include 'views/new.php';