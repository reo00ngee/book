<?php

function createNote()
{
  echo 'メモを書いてください' . PHP_EOL;
  echo 'タイトル:';
  $title = trim(fgets(STDIN));

  echo '内容:';
  $content = trim(fgets(STDIN));
  echo '登録が完了しました' . PHP_EOL;
  return [
    'title' => $title,
    'content' => $content
  ];
}
$notes = [];
function show($notes){
      echo 'memoを表示します' . PHP_EOL;
  foreach($notes as $note){
    echo 'タイトル:' . $note['title'] .PHP_EOL;
    echo '内容:' .$note ['content' ].PHP_EOL;
    echo '----------------' . PHP_EOL . PHP_EOL;
  }
}


while (true) {
  echo 'メニューを選んでください' . PHP_EOL;
  echo 'メモ入力:1' . PHP_EOL;
  echo 'メモを出力:2' . PHP_EOL;
  echo '終了:9' . PHP_EOL;
  echo 'メニュー:';
  $num = trim(fgets(STDIN));

  if ($num === '1') {
    $notes[] = createNote();
  } elseif ($num === '2') {
    show($notes);
  } elseif ($num === '9') {
    break;
  }
}