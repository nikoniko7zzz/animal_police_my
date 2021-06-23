<?php
session_start();
include("functions.php");
check_session_id();

if (
  // !isset($_POST['image']) || $_POST['image'] == '' ||
  !isset($_POST['dogName']) || $_POST['dogName'] == '' ||
  !isset($_POST['dogAge']) || $_POST['dogAge'] == '' ||
  !isset($_POST['sex']) || $_POST['sex'] == '' ||
  !isset($_POST['dogBreed']) || $_POST['dogBreed'] == '' ||
  !isset($_POST['sick']) || $_POST['sick'] == '' ||
  !isset($_POST['personality']) || $_POST['personality'] == '' ||
  !isset($_POST['transfer']) || $_POST['transfer'] == '' ||
  !isset($_POST['id']) || $_POST['id'] == ''
) {
  echo json_encode(["error_msg" => "no input"]);
  exit();
}

// $image = $_POST["image"];
$dogName = $_POST["dogName"];
$dogAge = $_POST["dogAge"];
$sex = $_POST["sex"];
$dogBreed = $_POST["dogBreed"];
$sick = $_POST["sick"];
$personality = $_POST["personality"];
$transfer = $_POST["transfer"];
$id = $_POST["id"];

$pdo = connect_to_db();

$sql = "UPDATE Transfer_table SET dogName=:dogName, dogAge=:dogAge, sex=:sex, dogBreed=:dogBreed, sick=:sick, personality=:personality, transfer=:transfer, updated_at=sysdate() WHERE id=:id";

$stmt = $pdo->prepare($sql);
// $stmt->bindValue(':image', $image, PDO::PARAM_STR);
$stmt->bindValue(':dogName', $dogName, PDO::PARAM_STR);
$stmt->bindValue(':dogAge', $dogAge, PDO::PARAM_STR);
$stmt->bindValue(':sex', $sex, PDO::PARAM_STR);
$stmt->bindValue(':dogBreed', $dogBreed, PDO::PARAM_STR);
$stmt->bindValue(':sick', $sick, PDO::PARAM_STR);
$stmt->bindValue(':personality', $personality, PDO::PARAM_STR);
$stmt->bindValue(':transfer', $transfer, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  header("Location:Transfer_read.php");
  exit();
}
