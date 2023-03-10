<?php

require_once __DIR__ . '/mysqli.php';

function dropTable($link){
  $dropTableSql = 'DROP TABLE IF EXISTS book_log;';
  $result = mysqli_query($link,$dropTableSql);
  if ($result) {
    echo 'テーブルを削除しました' . PHP_EOL;
  } else {
    echo 'テーブルの削除に失敗しました' . PHP_EOL;
  }
}


function createTable($link){
  $createTableSql = <<<EOT
  CREATE TABLE book_log(
    id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255),
    status VARCHAR(10) NOT NULL,
    assessment INTEGER NOT NULL,
    impression VARCHAR(2000)
  ) DEFAULT CHARACTER SET=utf8mb4;
EOT;  
  $result = mysqli_query($link,$createTableSql);
  if ($result) {
    echo 'テーブルを作成しました' . PHP_EOL;
  } else {
    echo 'テーブルの作成に失敗しました' . PHP_EOL;
  }


}

$link = dbConnect();
dropTable($link);
createTable($link);
mysqli_close($link);

