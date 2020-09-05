<?php
  require_once('./functions.php');
  session_start();

  // ログインしていなかったら、ログイン画面にリダイレクトする
  redirectIfNotLogin(); // ※ この関数はfunctions.phpに定義してある
  $id = $_SESSION['user']['id'];
  $username = $_SESSION['user']['username'];

  $pdo = connectDB();
  $sql = "SELECT * FROM shops WHERE shopid = :target_shopid";
  $statement = $pdo->prepare($sql);
    $statement->execute([
      ':target_shopid' => $id,
    ]);
  // $articles 連想配列に指定した記事が複数入っている状態↓
  $articles = $statement->fetchAll();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <title><?php echo $username; ?>の古着屋ページ</title>
  <link rel="stylesheet" href="./my.css">
</head>
<body>
     <h3>古着屋</h3>
     <table border="2">
       <thead>
         <tr>
           <th>名前</th>
           <th>コメント</th>
           <th>評価</th>
         </tr>
       </thead>
       <tbody>
         <?php foreach($articles as $article): ?>
           <tr>
             <td><?php echo h($result['name']);?></td>

             <td><?php echo $result['comment']; ?></td>

             <td><?php echo  "<img src=" . $result['image'] .  " alt='no' width='200'>" ?></td>
             <!-- <td><?php echo  "<img src='image' alt='no'>" ?></td> -->


             <td><a href="./huku_kensaku_kekka_syousai.php?id=<?php echo $article['id']; ?>"><?php echo h($article['title']); ?></a></td>

           </tr>
         <?php endforeach; ?>
       </tbody>
     </table>
    </div>

</div>
</body>
</html>
