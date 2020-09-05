<?php
  require_once('./functions.php');
  session_start();
// ここまでは GET POST に関わらず動作する

/*
 * 普通にアクセスした場合: GETリクエスト
 * 登録フォームからSubmitした場合: POSTリクエスト
 */
// POSTリクエストの場合
if ($_SERVER["REQUEST_METHOD"] === "POST") {

  // 送られた値を取得
  $sbase = $_POST['Sbase'];
  $sand = $_POST['Sand'];
  $sor = $_POST['Sor'];
  $snot = $_POST['Snot'];
  $sql = "SELECT * FROM users_p WHERE (username=$sbase) ";

  if (!empty($sand)){
    $sql .= "AND (username=$sand) "
  }
  if (!empty($sor)){
    $sql .= "OR (username=$sor) "
  }
  if (!empty($snot)){
    $sql .= "NOT (username=$snot) "
  }
  // DB に接続
  $pdo = connectDB();

  // ポストされた username を使って DB のエントリを呼び出す
  $sql = "SELECT * FROM users_p WHERE username = :username";
  $statement = $pdo->prepare($sql);
  $statement->execute([
    ':username' => $username,
  ]);
  // $user 連想配列にユーザの情報が入ってくる
  $users = $statement->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8" />
	<title>テスト</title>
	<link rel="stylesheet" href="./my.css">
</head>
<body>
	<div id="all">
  <!-- 他のページからGETでアクセスした場合は，以下のみが表示される． -->
    <h2>テスト</h2>

        <form action="" method="post">
            <div>
                <label for="username-input">BASE</label>
                <input type="text" name="Sbase"
            </div>
            <div>
                <label for="username-input">AND</label>
                <input type="text" name="Sand"
            </div>
            <div>
                <label for="username-input">OR</label>
                <input type="text" name="Sor"
            </div>
            <div>
                <label for="username-input">パスワード</label>
                <input type="text" name="Snot"
            </div>
            <input type="submit" value="検索">
        </form>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
echo $sql;
}
?>


</body>
</html>
