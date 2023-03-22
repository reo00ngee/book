<?php

$errors = [];
$reviews = [
  'title' => '',
  'author' => '',
  'status' =>'未読',
  'assessment' =>'',
  'impression' =>''
];
$title = '読書ログの登録';
$content = __DIR__ .'/views/new.php';

include __DIR__ .'/views/layout.php';