<!-- <link rel="stylesheet" href="test.css"> -->

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
    $output .= "<div class=box_big>";
    $output .= "<div class=box>";
    $output .= "<div class=photo>";
    $output .= "<img src='{$record["image"]}' height=150px width=100px>";
    $output .= "<img src='../img/1等.png' alt='譲渡経緯' id='transfer_mark' height=60px width=60px>";
    $output .= "</div>";
    $output .= "<p class='transfer_output'>{$record["transfer"]}</p>"; //ずっと非表示
    $output .= "<div class=vertical>";
    $output .= "<p>名前:{$record["dogName"]}</p>";
    $output .= "<p>年齢:{$record["dogAge"]}  性別:{$record["sex"]}</p>";
    $output .= "<p>犬種:</p>";
    $output .= "<p>{$record["dogBreed"]}</p>";
    $output .= "<p>持病</p>";
    $output .= "<p>{$record["sick"]}</p>";
    $output .= "<p>性格</p>";
    $output .= "<p>{$record["personality"]}</p>";
    $output .= "</div>";
    $output .= "</div>";
    $output .= "</div>";
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

  <style>
    .box_big {
      background-color: #FFD700;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 210px;
      width: 280px;
      padding: 10px;
      margin: 10px;
    }

    .box {
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .photo {
      height: 200px;
      width: 130px;
      background-color: gray;
      margin-right: 10px;
      position: relative;
    }

    .vertical {
      height: 200px;
      width: 130px;
    }

    .vertical p {
      margin: 0;
    }

    #transfer_mark {
      position: absolute;
      left: 0;
      top: 0;
    }
  </style>





</head>

<body>
  <header>
    <h1>譲渡会</h1>
    <a href="Transfer_input.php">入力画面</a>
    <a href="logout.php">logout</a>
  </header>
  <div class=Transfer_container>
    <?= $output ?>
  </div>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>

    // if ($('.transfer_output').val() = "譲渡済") {

    // if ($('.transfer_output').val() = "譲渡済") {
    //   console.log("出力すみ")
      $('.transfer_mark').hidden();
    //   // $('.transfer_mark').show();

    // }

    // $("#fairy").attr("src", fairy_img).addClass('open');
    // じゃんけんの結果をテキストで表示
    // $("#flowing_box_bottom").text(my_select[my][com_Num]);
    // 押したボタンvsコンピュータの出した手の結果を言葉でかえす
    // $("#flowing_box_2").text(my_select[my][com_Num]);
  </script>


</body>

</html>