<?php
  require_once('./functions.php');
  session_start();

  // ログインしていなかったら、ログイン画面にリダイレクトする
  redirectIfNotLogin(); // ※ この関数はfunctions.phpに定義してある
  $id = $_SESSION['user']['id'];
  $username = $_SESSION['user']['username'];
  $pdo = connectDB();
  $sql = "SELECT * FROM tansu";

  $statement = $pdo->prepare($sql);
  $statement->execute();
  //
  // var_dump($_POST);

  if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $maxPrice=$_POST["maxPrice"];
    var_dump($maxPrice);
    var_dump($id);
    $sql = "SELECT * FROM tansu WHERE user_id = :target_user_id and kion>:kion";

    $statement = $pdo->prepare($sql);
    $statement->execute([
      ':target_user_id' => $id,
      ':kion' => $maxPrice
    ]);
  }

  // $articles 連想配列に指定した記事が複数入っている状態↓
  $articles = $statement->fetchAll();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Start画面</title>
      <link rel="stylesheet" href="./my.css">
</head>
<body>
<div id="all">
  <div class="example">
      <img src= "picture/tansu.jpg" alt='no' width=100%  height=100%>
      <p >Hukutan</p>
      <a href="./login.php">Start</a>
  </div>
</div>
</body>
</html>
