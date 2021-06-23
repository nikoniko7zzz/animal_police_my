<?php
session_start();
include("functions.php");
check_session_id();

if (
  // !isset($_POST['image']) || $_POST['image'] == '' ||
  !isset($_POST['date']) || $_POST['date'] == '' ||
  !isset($_POST['title']) || $_POST['title'] == '' ||
  !isset($_POST['article']) || $_POST['article'] == '' ||
  !isset($_POST['id']) || $_POST['id'] == ''
) {
  echo json_encode(["error_msg" => "no input"]);
  exit();
}

// $image = $_POST["image"];
$date = $_POST["date"];
$title = $_POST["title"];
$article = $_POST["article"];
$id = $_POST["id"];

$pdo = connect_to_db();

$sql = "UPDATE activity_table SET date=:date, title=:title, article=:article, updated_at=sysdate() WHERE id=:id";

$stmt = $pdo->prepare($sql);
// $stmt->bindValue(':image', $image, PDO::PARAM_STR);
$stmt->bindValue(':date', $date, PDO::PARAM_STR);
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':article', $article, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  header("Location:activity_read_css.php");
  exit();
}
