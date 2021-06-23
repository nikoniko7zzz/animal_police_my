<?php
session_start();

include("functions.php");
check_session_id();

$id = $_GET["id"];

$pdo = connect_to_db();

$sql = 'SELECT * FROM activity_table WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  $record = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>活動報告</title>
</head>

<body>
  <form action="activity_update.php" method="POST">
    <fieldset>
      <legend>活動報告</legend>
      <a href="adomin_top.html">管理者入力画面top</a>
      <!-- <div>
        写真(image):<input type="file" name="upfile" accept="image/*" capture="camera">
      </div> -->
      <div>
        写真(image):<input type="file" name="upfile" img src='{$record["image"]}' height=150px width=100px>
      </div>
      <div>
        日付(date): <input type="text" name="date" value="<?= $record["date"] ?>">
      </div>
      <div>
        タイトル(title): <input type="text" name="title" value="<?= $record["title"] ?>">
      </div>
      <div>
        記事(article): <input type="text" name="article" value="<?= $record["article"] ?>">
      </div>
      <div>
        <button>submit</button>
      </div>
      <input type="hidden" name="id" value="<?= $record["id"] ?>">
    </fieldset>
  </form>

</body>

</html>