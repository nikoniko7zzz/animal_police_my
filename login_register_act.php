<?php
include('functions.php');

$username = $_POST["username"];
$password = $_POST["password"];

$pdo = connect_to_db();

$sql = 'SELECT COUNT(*) FROM users_table WHERE username=:username';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
}

if ($stmt->fetchColumn() > 0) {
  echo "<p>すでに登録されているユーザです．</p>";
  echo '<a href="login.php">ログイン画面へ</a>';
  exit();
}

$sql = 'INSERT INTO users_table(id, username, password, is_admin, is_deleted, created_at, updated_at) VALUES(NULL, :username, :password, 0, 0, sysdate(), sysdate())';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  header("Location:login_register_ok.html");
  exit();
}
