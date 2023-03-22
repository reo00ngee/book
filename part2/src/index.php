<?php
require_once __DIR__ . '/mysqli.php';



function listReviews($link)
{
  $book_logs = [];
  $sql = 'SELECT title,author,status,assessment,impression FROM book_log;';
  $result = mysqli_query($link, $sql);
  while ($book_log = mysqli_fetch_assoc($result)) {
    $book_logs[] = $book_log;
  }
  mysqli_free_result($result);
  return $book_logs;
}

$link = dbConnect();
$book_logs = listReviews($link);

$title = '読書ログの一覧';
$content = __DIR__ . '/views/index.php';
include __DIR__ . '/views/layout.php';