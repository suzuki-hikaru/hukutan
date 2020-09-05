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
  
    <h3 id="boder">タンス内検索</h3>
  <form action="" method="post">

  <!-- <p>検索:<input type="text" name="maxPrice" size="50" maxlength="50" value=""></p> -->
　<p>気温検索:<input type="text" name="maxPrice" size="50" maxlength="50" value=""></p>
  <p>画像検索：<input type="file" name="image"></p>
  <input type="submit" value="検索" id="btn-square">
  </form>
<br>
   <div>
     <h3 id="boder">タンスの中身</h3>
     <table border="2">
       <thead>
         <tr>

           <th>洋服の名前</th>
           <th>ひとこと</th>
           <th>気温</th>
                      <th>写真</th>

         </tr>
       </thead>
       <tbody>
         <?php foreach($articles as $article): ?>
           <tr>


             <td><?php echo $article['cloth_name'];?></td>
             <td><?php echo $article['tweet']; ?></td>
             <td><?php echo $article['kion'];?></td>
                          <td><?php echo  "<img src=" . $article['image'] .  " alt='no' width='200'>" ?></td>
            <!-- <td><?php echo  "<img src='image' alt='no'>" ?></td> -->
           </tr>
         <?php endforeach; ?>
       </tbody>
     </table>
    </div>

</div>
</body>
</html>
