<?php
session_start();
include("functions.php");
check_session_id();

$pdo = connect_to_db();

$sql = "SELECT * FROM Transfer_table ORDER BY id DESC";

$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $output = "";
  foreach ($result as $record) {
    $output .= "<tr>";
    $output .= "<td><img src='{$record["image"]}' height=150px width=100px></td>";

    $output .= "<td>{$record["dogName"]}</td>";
    $output .= "<td>{$record["dogAge"]}</td>";
    $output .= "<td>{$record["sex"]}</td>";
    $output .= "<td>{$record["dogBreed"]}</td>";
    $output .= "<td>{$record["sick"]}</td>";
    $output .= "<td>{$record["personality"]}</td>";
    $output .= "<td>{$record["transfer"]}</td>";
    $output .= "<td><a href='Transfer_edit.php?id={$record["id"]}'>修正</a></td>";
    $output .= "<td><a href='Transfer_delete.php?id={$record["id"]}'>削除</a></td>";

    // $output .= "<p hidden class='transfer_output'>{$record["transfer"]}</p>";
    // $output .= "<div class=transfer_mark hidden>";
    $output .= "<img src='../img/1等.png' alt='譲渡経緯' id='transfer_mark' hight=80px width=80px>";
    // $output .= "</div>";


    $output .= "</tr>";
  }
  unset($value);
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>譲渡会</title>
</head>

<body>
  <fieldset>
    <legend>譲渡会（一覧画面）</legend>
    <a href="Transfer_input.php">入力画面</a>
    <a href="logout.php">logout</a>
    <table>
      <thead>
        <tr>
          <th>写真</th>
          <th>名前</th>
          <th>年齢</th>
          <th>性別</th>
          <th>犬種</th>
          <th>持病</th>
          <th>性格</th>
          <th>譲渡</th>
        </tr>
      </thead>
      <tbody>
        <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
        <?= $output ?>
      </tbody>
    </table>
  </fieldset>
</body>

</html>