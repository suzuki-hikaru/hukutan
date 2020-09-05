<?php
  require_once('./functions.php');
  session_start();

  // ログインしていなかったら、ログイン画面にリダイレクトする
  redirectIfNotLogin(); // ※ この関数はfunctions.phpに定義してある
  $id = $_SESSION['user']['id'];
  $username = $_SESSION['user']['username'];

  $pdo = connectDB();
  $sql = "SELECT * FROM hukus_p WHERE user_id = :target_user_id";
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
  <li><a href="./huku_toukou_page.php" id="black">Post</a></li>
  <li><a href="./hukutan_index.php" id="black">Search</a></li>
  <li><a href="./new_article.php" id="black">New article</a></li>
  <li><a href="./h.php" id="black">article</a></li>
</ul>
</div>


<div class="example">
    <img src= "picture/girl.jpg" alt='no' width=100%  height=100%>
</div>

<section class="contents">
  <h2>hukutanで簡単に洋服管理</h2>
  <!-- <img src= "picture/girl.jpg" alt='no' width=30%  height=180 >
  <img src= "picture/girl.jpg" alt='no' width=30%  height=180>
  <img src= "picture/girl.jpg" alt='no' width=30%  height=180> -->
</section>

  <h3 id="boder">おすすめ特集</h3>

    <table border="1">
      <thead>
        <tr>
          <th>写真</th>
          <th>タイトル</p>
          <th>洋服の名前</th>
          <th>着てみた感想</th>
          <th>価格(円)</th>
        </tr>
      </thead>
      <tbody>

        <?php foreach($articles as $article): ?>
          <tr>

            <td><?php echo  "<img src=" . $article['image'] .  " alt='no' width='80'  height='80';>" ?></td>
           <!-- <td><?php echo  "<img src='image' alt='no'>" ?></td> -->
            <td><a href="./huku_kensaku_kekka_syousai.php?id=<?php echo $article['id']; ?>">
              <?php echo h($article['title']); ?></a></td>
            <td><?php echo $article['cloth_name'];?></td>
            <td><?php echo $article['tweet']; ?></td>
            <td><?php echo $article['kakaku'];?></td>
            <!-- <td><?php echo $article['image']; ?></td> -->

          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>



   <h4 id="boder">ログアウト</h4>
   <ul>
    <li><a href="./logout.php">ログアウト</a></li>
   </ul>




</body>
</html>
