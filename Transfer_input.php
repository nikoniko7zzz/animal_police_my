<?php
session_start();
include("functions.php");
check_session_id();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>譲渡会</title>
</head>

<body>
  <a href="adomin_top.html">管理者top画面へ</a>
  <a href="Transfer_read_css.php">一覧画面(ユーザー用)</a>
  <a href="Transfer_read.php">一覧画面(管理者用)</a>
  <a href="logout.php">logout</a>
  <!-- <form action="Transfer_create.php" method="POST"> -->
  <form method="post" action="Transfer_create.php" enctype="multipart/form-data">
    <div>
      <!-- 写真(photo):<input type="file" name="upfile" accept="image/*" capture="camera"> -->
      写真(image):<input type="file" name="upfile" accept="image/*" capture="camera">
    </div>
    <div>
      名前(dogName): <input type="text" name="dogName">
    </div>
    <div>
      年齢(dogAge): <input type="text" name="dogAge">
    </div>
    <div>
      性別(sex):
      <!-- <input type="text" name="sex"> -->
      <select type="text" name="sex">
        <option value="">選択</option>
        <option value="オス">オス</option>
        <option value="メス">メス</option>
      </select>
    </div>
    <!-- <div>
      写真(photo): <input type="text" name="photo">
    </div> -->
    <div>
      犬種(dogBreed): <input type="text" name="dogBreed">
    </div>
    <div>
      持病(sick): <input type="text" name="sick">
    </div>
    <div>
      性格(personality): <input type="text" name="personality">
    </div>
    <div>
      譲渡(transfer):
      <!-- <input type="text" name="transfer"> -->
      <select type="text" name="transfer">
        <option value="">選択</option>
        <option value="未譲渡">未譲渡</option>
        <option value="譲渡済">譲渡済</option>
      </select>
    </div>
    <div>
      <button>登録</button>
    </div>
  </form>

</body>

</html>