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
  <title>活動報告</title>
</head>

<body>
  <a href="adomin_top.html">管理者top画面へ</a>
  <a href="activity_read_css.php">活動報告一覧画面(ユーザー用)</a>
  <!-- <a href="Transfer_read.php">一覧画面(管理者用)</a> -->
  <a href="logout.php">logout</a>
  <h1>活動報告</h1>
  <form method="post" action="activity_create.php" enctype="multipart/form-data">
    <div>
      <!-- 写真(photo):<input type="file" name="upfile" accept="image/*" capture="camera"> -->
      写真(image):<input type="file" name="upfile" accept="image/*" capture="camera">
    </div>
    <div>
      日付(date): <input type="date" name="date">
    </div>
    <div>
      タイトル(title): <input type="text" name="title">
    </div>
    <div>
      記事(article): <input type="text" name="article">
    </div>
    <div>
      <button>登録</button>
    </div>
  </form>

</body>

</html>