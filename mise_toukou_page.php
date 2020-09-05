<?php
  require_once('./functions.php');
  session_start();

  redirectIfNotLogin();
  $id = $_SESSION['user']['id'];
  $username = $_SESSION['user']['username'];
  $nichiji  = date('Y-m-d H:i:s');
  // POSTリクエストの場合
  if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $star = $_POST['star'];
    $image = $_POST['image'];

    $addr11 = $_POST['addr11'];

    //一字ファイルができているか（アップロードされているか）チェック
    if(is_uploaded_file($_FILES['up_file']['tmp_name'])){
        //一字ファイルを保存ファイルにコピーできたか
        if(move_uploaded_file($_FILES['up_file']['tmp_name'],"./picture/".$_FILES['up_file']['name'])){
            //正常
            // echo "uploaded";
        }else{
            //コピーに失敗（だいたい、ディレクトリがないか、パーミッションエラー）
            // echo "error while saving.";
        }
    }else{
        //そもそもファイルが来ていない。
        // echo "file not uploaded.";
    }

    echo $_FILES['up_file']['name'];
    $pdo = connectDB();
    $sql = "INSERT INTO shops (name,comment,addr11,image2) VALUES(:name,:comment,:addr11,:image2)";
    $statement = $pdo->prepare($sql);
    $result = $statement->execute([

      ':name' => $name,
      ':comment' => $comment,

      ':image2' => "./picture/".$_FILES['up_file']['name'],
      ':addr11' => $addr11,


    ]);

    header("Location: toukou_kanryou.php");
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>

  <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>

	<meta charset="UTF-8" />
	<title>新規服登録</title>
	<link rel="stylesheet" href="./my.css">
</head>
<body>
	<div id="all">
    <h2 id="h">店舗の宣伝</h2>
    <h3 id="boder">基本情報</h3>
        <form action="" method="post">
          <p>名前:<input type="text" name="name" size="50" maxlength="50" value=""></p>
          <p>紹介文：<textarea name="comment" rows="5" cols="40"></textarea></p>
          <p>画像：<input type="file" name="up_file"><br></p>


          <h3 id="boder">住所入力欄</h3>
          <p>▼郵便番号入力フィールド(7桁)<br>
            <input type="text" name="zip11" size="10" maxlength="8" onKeyUp="AjaxZip3.zip2addr(this,'','addr11','addr11');"></p>
          <p>▼住所入力フィールド(都道府県+以降の住所)<br>
            <input type="text" name="addr11" size="60"></p><br>


          <input type="submit" value="送信">
        </form>
	</div>

</body>
</html>
