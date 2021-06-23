<?php
// まずはこれ
// var_dump($_GET);
// exit();


// 関数ファイルの読み込み
include('../functions.php');
// GETデータ取得
$activity_id = $_GET['activity_id'];
// DB接続
$pdo = connect_to_db();



$sql = 'INSERT INTO activity_like_table(id, activity_id, created_at) VALUES(NULL, :activity_id, sysdate())';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':activity_id', $activity_id, PDO::PARAM_INT);
$status = $stmt->execute();
if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  header("Location:activity_read_css.php");
  exit();
}
