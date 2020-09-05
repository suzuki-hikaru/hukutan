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
  <title><?php echo $username; ?>'s SimpleBlog</title>
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

     <h3>記事一覧</h3>
     <table border="2">
       <thead>
         <tr>
           <th>ID</th>
           <th>タイトル</th>
           <th>作成日</th>
           <th>修正日</th>
         </tr>
       </thead>
       <tbody>
         <?php foreach($articles as $article): ?>
           <tr>
             <td><?php echo h($article['id']);?></td>
             <td><a href="./article.php?id=<?php echo $article['id']; ?>"><?php echo h($article['title']); ?></a></td>
             <td><?php echo $article['created_at'];?></td>
             <td><?php echo $article['modified_at'];?></td>
           </tr>
         <?php endforeach; ?>
       </tbody>
     </table>
    </div>

</div>
</body>
</html>
