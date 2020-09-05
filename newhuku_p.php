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

    $pdo = connectDB();
    $sql = "INSERT INTO hukus_p (user_id, title,body,created_at,modified_at) VALUES(:user_id, :title,:body,:created_at,:modified_at)";
    $statement = $pdo->prepare($sql);
    $result = $statement->execute([
      ':user_id' => $id,
      ':title' => $title,
      ':body' => $body,
      ':created_at' => $nichiji,
      ':modified_at' => $nichiji,
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
	<div id="all">
      <h2 id="h"><?php echo $username; ?>のフクタンページ</h2>
    <h4 id="boder">新規記事登録</h4>
        <form action="" method="post">
          <p>タイトル:<input type="text" name="title" size="50" maxlength="50" value=""></p>
          <p>内容：<textarea name="body" rows="5" cols="40"></textarea></p>
          <input type="submit" value="送信" id="btn-square">
        </form>
	</div>

</body>
</html>
