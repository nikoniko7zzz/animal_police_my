<?php
session_start();

include("functions.php");
check_session_id();

$id = $_GET["id"];

$pdo = connect_to_db();

$sql = 'SELECT * FROM Transfer_table WHERE id=:id';

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
  <title>譲渡会リスト（編集画面）</title>
</head>

<body>
  <form action="Transfer_update.php" method="POST">
    <fieldset>
      <legend>譲渡会リスト（編集画面）</legend>
      <a href="Transfer_read.php">一覧画面</a>
      <!-- <div>
        写真(image):<input type="file" name="upfile" accept="image/*" capture="camera">
      </div> -->
      <div>
        写真(image):<input type="file" name="upfile" img src='{$record["image"]}' height=150px width=100px>
      </div>
      <div>
        名前(dogName): <input type="text" name="dogName" value="<?= $record["dogName"] ?>">
      </div>
      <div>
        年齢(dogAge): <input type="text" name="dogAge" value="<?= $record["dogAge"] ?>">
      </div>
      <div>
        性別(sex): <input type="text" name="sex" value="<?= $record["sex"] ?>">
      </div>
      <div>
        犬種(dogBreed): <input type="text" name="dogBreed" value="<?= $record["dogBreed"] ?>">
      </div>
      <div>
        持病(sick): <input type="text" name="sick" value="<?= $record["sick"] ?>">
      </div>
      <div>
        性格(personality): <input type="text" name="personality" value="<?= $record["personality"] ?>">
      </div>
      <div>
        譲渡(transfer): <input type="text" name="transfer" value="<?= $record["transfer"] ?>">
      </div>
      <div>
        <button>submit</button>
      </div>
      <input type="hidden" name="id" value="<?= $record["id"] ?>">
    </fieldset>
  </form>

</body>

</html>