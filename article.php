
<?php
  require_once('./functions.php');
  session_start();

  // URLに含まれている記事のIDを取得
  $id = $_GET['id'];
  // DB接続
  $pdo = connectDB();
  // 以下4行、記事をDBから取得し、変数$articleに格納
  $sql = 'SELECT * FROM articles_p WHERE id = :id';
  $statement = $pdo->prepare($sql);
  $statement->execute([':id' => $_GET['id']]);
  $article = $statement->fetch();

  $user_id = $article['user_id'];
  $sql = 'SELECT * FROM users_p WHERE id = :user_id';
  $statement = $pdo->prepare($sql);
  $statement->execute([':user_id' => $user_id]);
  $result = $statement->fetch();
?>
<!DOCTYPE html>

<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>SimpleBlog記事</title>
    <link rel="stylesheet" href="./my.css">
</head>
<body>
<div>
  <div id="all">
    <h2>SimpleBlog 記事</h2>

    <?php
      $message = "戻る";
      // リファラ値がなければ<a>タグを挿入しない
    if (empty($_SERVER['HTTP_REFERER'])) {
      echo $message;
    }
    // リファラ値があれば<a>タグ内へ
    else {
      echo '<a href="' . $_SERVER['HTTP_REFERER'] . '">' . $message . "</a>";
    }
    ?>

    <h1>
        <?php echo h($article['title']); ?>
    </h1>
    <p>
        <?php echo h($result['username']); ?>
    </p>
    <pre><?php echo h($article['body']); ?></pre>

</div>
</body>
</html>
