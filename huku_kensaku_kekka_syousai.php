<?php
  require_once('./functions.php');
  session_start();

  redirectIfNotLogin(); // ※ この関数はfunctions.phpに定義してある
  $id = $_SESSION['user']['id'];
  $username = $_SESSION['user']['username'];

  // URLに含まれている記事のIDを取得
  $id = $_GET['id'];
  // DB接続
  $pdo = connectDB();
  // 以下4行、記事をDBから取得し、変数$articleに格納
  $sql = 'SELECT * FROM hukus_p WHERE id = :id';
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
    <title>フクタン記事</title>
    <link rel="stylesheet" href="./my.css">
</head>
<body>
  <div class="navigation">
  <ul>
    <h2 id="logo"><?php echo $username; ?>'s Hukutan</a></h2>
    <li><a href="./mypage.php" id="black">Top</a></li>
    <li><a href="./new_tansu.php" id="black">pick up</a></li>
    <li><a href="./shop.php" id="black">shop</a></li>
    <li><a href="./mytansu.php" id="black">my wardrobe</a></li>
    <li><a href="./kensaku_kekka.php" id="black">friend wardrobe</a></li>
    <li><a href="./kensaku.php" id="black">Post</a></li>
    <li><a href="./hukutan_index.php" id="black">Search</a></li>
    <li><a href="./new_article.php" id="black">New article</a></li>
    <li><a href="./h.php" id="black">article</a></li>
  </ul>
  </div>

      <h2 id="h"><?php echo $username; ?>のフクタンページ</h2>

    <h4 id="boder">ユーザー名</h4>
    <p>
        <!-- <?php echo h($result['username']); ?> -->
        <a href="./friendtansu.php" id="btn-circle-stitch"> tanakaのタンス</a>
    </p>

    <h4 id="boder">説明</h4>
    <pre><?php echo h($article['body']); ?></pre>

    <?php echo  "<img src=" . $article['image'] .  " alt='no' >"  ?>


    <h4 id="boder">価格</h4>
    <p><?php echo h($article['kakaku']); ?></p>

    <h4 id="boder">戻る</h4>

    <li><a href="./kensaku_kekka.php">投稿一覧</a></li>
    <li><a href="./mypage.php">ホームページ</a></li>







</div>
</body>
</html>
