<?php
  require_once('./functions.php');
  session_start();

  // ログインしていなかったら、ログイン画面にリダイレクトする
  redirectIfNotLogin(); // ※ この関数はfunctions.phpに定義してある
  $id = $_SESSION['user']['id'];
  $username = $_SESSION['user']['username'];

  $pdo = connectDB();
  $sql = "SELECT * FROM mises WHERE user_id = :target_user_id";
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
     <h3>newshop</h3>
     <table border="2">
       <thead>
         <tr>
           <th>名前</th>
           <th>場所</th>
           <th>コメント</th>
           <th>紹介文</th>

         </tr>
       </thead>
       <tbody>
         <?php foreach($articles as $article): ?>
           <tr>
             <td><?php echo h($article['id']);?></td>
             <td><a href="./huku_kensaku_kekka_syousai.php?id=<?php echo $article['id']; ?>"><?php echo h($article['title']); ?></a></td>
             <td><?php echo $article['basyo'];?></td>
             <td><?php echo $article['hyouka'];?></td>
             <td><?php echo $article['komento'];?></td>
             <td><?php echo $article['syoukaibun'];?></td>
           </tr>
         <?php endforeach; ?>
       </tbody>
     </table>
    </div>

</div>
</body>
</html>
