<!-- <link rel="stylesheet" href="test.css"> -->

<?php
session_start();
include("functions.php");
check_session_id();

$pdo = connect_to_db();

$sql = "SELECT * FROM activity_table ORDER BY id DESC";

$sql = 'SELECT * FROM activity_table LEFT OUTER JOIN (SELECT activity_id, COUNT(id) AS cnt FROM activity_like_table GROUP BY activity_id) AS result_table ON activity_table.id = result_table.activity_id ORDER BY id DESC';


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

    // 折り畳み展開ポインタ ここから
    $output .= "<details>";
    $output .= "<summary>";
    $output .= "<div class='openclose'>";
    $output .= "<p class='date' style='display:inline;' >{$record['date']}</p>";
    $output .= "<p class='title' style='display:inline;' >  {$record['title']}</p>";
    $output .= "<p class='good' style='display:inline;' >👍{$record['cnt']}</p>";
    $output .= "</div>";
    $output .= "<p style='display:inline;'><a href='activity_edit.php?id={$record["id"]}'>修正</a></p>";
    $output .= "<p style='display:inline;'><a href='activity_delete.php?id={$record["id"]}'>削除</a></p>";

    $output .= "</summary>";

    // 折り畳まれ部分 ここから
    $output .= "<p><img src='{$record["image"]}' height=150px width=100px></p>";
    $output .= "<p>{$record["article"]}</p>";
    $output .= "<p><a href='activity_like_create.php?activity_id={$record["id"]}'>いいね</a></p>";
    $output .= "</details>";
    // 折り畳まれ部分 ここまで

  }
  unset($value);
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>活動報告</title>

  <style>
    .openclose {
      display: flex;
      /* margin-bottom: 15px; */
      /* border: 1px solid gray; */
      /* width: 600px; */
    }

    summary {
      width: 600px;
      position: relative;
      display: block;
      /* 矢印を消す */
      padding: 10px 10px 10px 30px;
      /* アイコンの余白を開ける */
      cursor: pointer;
      /* カーソルをポインターに */
      font-weight: bold;
      background-color: #e2f0f7;
      transition: 0.2s;
      margin-bottom: 15px;
    }

    summary:hover {
      background-color: #ccebfb;
    }

    summary::-webkit-details-marker {
      display: none;
      /* 矢印を消す */
    }

    /* 疑似要素でアイコンを表示 */
    summary:before,
    summary:after {
      content: "";
      margin: auto 0 auto 10px;
      position: absolute;
      top: 0;
      bottom: 0;
      left: 0;
    }

    summary:before {
      width: 16px;
      height: 16px;
      border-radius: 4px;
      background-color: #1da1ff;
    }

    summary:after {
      left: 6px;
      width: 5px;
      height: 5px;
      border: 4px solid transparent;
      border-left: 5px solid #fff;
      box-sizing: border-box;
      transition: .1s;
    }

    /* オープン時のスタイル */
    details[open] summary {
      background-color: #ccebfb;
    }

    details[open] summary:after {
      transform: rotate(90deg);
      /* アイコンを回転 */
      left: 4px;
      /* 位置を調整 */
      top: 5px;
      /* 位置を調整 */
    }

    /* アニメーション */
    details[open] .details-content {
      animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
      0% {
        opacity: 0;
        transform: translateY(-10px);
      }

      100% {
        opacity: 1;
        transform: none;
      }
    }

    /* summary {
      width: 600px;
      display: block;
      cursor: pointer;
      transition: 0.2s;
    }

    summary:hover {
      cursor: pointer;
      background-color: #EFEFEF;
    } */



    .date {
      width: 120px;
      margin-left: 10px;
    }

    .title {
      width: 400px;
    }

    .good {
      margin-right: 10px;
      text-align: right;
    }

    /* オープン時にアニメーションを設定
    details[open] .details-content {
      animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
      0% {
        opacity: 0;
        /* 透明 */
    transform: translateY(-10px);
    /* 上から表示 */
    }

    100% {
      opacity: 1;
      transform: none;
    }
    }

    */
  </style>
</head>

<body>
  <header>
    <h1>活動報告</h1>
    <a href="activity_input.php">入力画面へ（いずれ消す）</a>
    <a href="./index.html">index.htmlへ</a>
  </header>
  <div class=activity_container>
    <?= $output ?>
  </div>

  <!-- <script>
    //  折り畳み表示
    //  'openHere'というクラスに属するオブジェクトをインライン要素or非表示に変更する。
    function openClose() {
      var obj = document.getElementsByClassName('{$record["date"]}');
      for (var i = 0; i < obj.length; i++) {
        //非表示ならインライン要素に変更。表示状態なら非表示に変更。
        if (obj[i].style.display == "inline-block") {
          obj[i].style.display = "none";
        } else {
          obj[i].style.display = "inline-block";
        }
      }
    }
  </script> -->

</body>

</html>