<?php
  require_once('./functions.php');
  session_start();

  // ログインしていなかったら、ログイン画面にリダイレクトする
  redirectIfNotLogin(); // ※ この関数はfunctions.phpに定義してある
  $id = $_SESSION['user']['id'];
  $username = $_SESSION['user']['username'];

  $pdo = connectDB();
  $sql = "SELECT * FROM shops";
  $statement = $pdo->prepare($sql);
    $statement->execute([

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
<div id="all">
  <h2 id = "h"><?php echo $username; ?>のフクタンページ</h2>

   <div>
     <h3 >話題のお店</h3>
     <h4>絞り込み</h4>
     <form action="" method="post">
       <p>住所:<input type="text" name="addr11" size="50" maxlength="50" value=""></p>

       <input type="submit" value="送信">
     </form>
     <br>
     <table border="2">
       <thead>
         <tr>
           <th>お店の名前</th>
           <th>コメント</th>
           <th>住所</th>
           <!-- <th>(image)</th>
           <th>写真</th> -->

         </tr>
       </thead>
       <tbody>
         <?php foreach($articles as $article): ?>
           <tr>

             <td><?php echo $article['name']; ?></td>
             <td><?php echo $article['comment'];?></td>
             <td><?php echo $article['addr11'];?></td>
             <!-- <td><?php echo $article['image2'];?></td>

             <td><?php echo  "<img src=" . $article['image2'] .  " alt='no' width='200'>" ?></td>

             <td><?php echo  "<img src='image' alt='no'>" ?></td> --> -->
           </tr>
         <?php endforeach; ?>
       </tbody>
     </table>
    </div>

</div>
</body>
</html>
