<?php
  require_once('./functions.php');
  session_start();

  redirectIfNotLogin();
  $id = $_SESSION['user']['id'];
  $username = $_SESSION['user']['username'];
  $nichiji  = date('Y-m-d H:i:s');
  // POSTリクエストの場合
  if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $title = $_POST['title'];
    $body = $_POST['body'];
    $hitokoto = $_POST['hitokoto'];



    $pdo = connectDB();
    $sql = "INSERT INTO articles_p (user_id, title,body,created_at,modified_at,hitokoto) VALUES(:user_id, :title,:body,:created_at,:modified_at,:hitokoto)";
    $statement = $pdo->prepare($sql);
    $result = $statement->execute([
      ':user_id' => $id,
      ':title' => $title,
      ':body' => $body,
      ':created_at' => $nichiji,
      ':modified_at' => $nichiji,
      ':hitokoto' => $hitokoto,

    ]);
    header("Location: mypage.php");
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8" />
	<title>新規記事登録</title>
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
    <h4 id="boder">新規記事登録</h4>
        <form action="" method="post">
          <p>タイトル:<input type="text" name="title" size="50" maxlength="50" value=""></p>
          <p>内容：<textarea name="body" rows="5" cols="40"></textarea></p>
          <p>ひとこと：<textarea name="hitokoto" rows="1" cols="40"></textarea></p>
          <input type="submit" value="送信">
        </form>
	</div>

</body>
</html>
