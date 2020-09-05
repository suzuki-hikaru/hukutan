<?php
  require_once('./functions.php');
  session_start();

  // ログインしていなかったら、ログイン画面にリダイレクトする
  redirectIfNotLogin(); // ※ この関数はfunctions.phpに定義してある
  $id = $_SESSION['user']['id'];
  $username = $_SESSION['user']['username'];

  $pdo = connectDB();
  $sql = "SELECT * FROM articles_p WHERE user_id = :target_user_id";
  $statement = $pdo->prepare($sql);
    $statement->execute([
      ':target_user_id' => $id,
    ]);
  // $articles 連想配列に指定した記事が複数入っている状態↓
  $articles = $statement->fetchAll();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <title><?php echo $username; ?>の投稿</title>
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

  <h2 id="h"><?php echo $username; ?>の投稿ページ</h2>
  <ul>
    <li ><a href="./old_shops.php" id="btn-square">古着屋</a></li>
    <br>
    <li ><a href="./newshop.php" id="btn-square">新しい洋服屋さん</a></li>

   </ul>

</div>
</body>
</html>
