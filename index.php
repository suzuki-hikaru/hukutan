<?php
  require_once('./functions.php');

  // DB接続
  $pdo = connectDB(); // ※ この関数はfunctions.phpに定義してある
  // 全記事(5記事文)を降順に取得するSQL文
  $sql = 'SELECT * FROM articles_p ORDER BY id DESC LIMIT 5';
  // SQLを実行
  $statement = $pdo->query($sql);
  // プレースメントフォルダが無いので，実行の表記が簡単
  $statement->execute();
  // $articles 連想配列に指定した記事が複数入っている状態↓
  $articles = $statement->fetchAll();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <title>SimpleBlog</title>
  <link rel="stylesheet" href="./my.css">
</head>
<body>
<div id="all">
  <h2>フクタン記事</h2>
  <ul>
    <li><a href="./login.php">ログイン</a></li>
    <li><a href="./user_register.php">新規ユーザ登録</a></li>
   </ul>

</div>
</body>
</html>
