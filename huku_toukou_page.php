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
    $cloth_name = $_POST['cloth_name'];
    $kakaku = $_POST['kakaku'];
    $tweet = $_POST['tweet'];


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

    $pdo = connectDB();
    $sql = "INSERT INTO hukus_p (user_id,title,body,created_at,modified_at,image,cloth_name,kakaku,tweet) VALUES(:user_id,:title,:body,:created_at,:modified_at,:image,:cloth_name,:kakaku,:tweet)";
    $statement = $pdo->prepare($sql);
    $result = $statement->execute([
      ':user_id' => $id,
      ':title' => $title,
      ':body' => $body,
      ':created_at' => $nichiji,
      ':modified_at' => $nichiji,
      ':image' => "./picture/".$_FILES['up_file']['name'],

      ':cloth_name' => $cloth_name,
      ':kakaku' => $kakaku,
      ':tweet' => $tweet,



    ]);
    // var_dump($result);

    header("Location: toukou_kanryou.php");


}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8" />
	<title>新規服登録</title>
	<link rel="stylesheet" href="./my.css">
</head>
<body>
	<div id="all">
    <h2 id = "h">新規服登録</h2>

        <form action="" method="post" enctype="multipart/form-data">

          <h3>タイトル:<input type="text" name="title" size="50" maxlength="50" value=""   border-bottom: solid 3px black;></h3>
          <p id="picture">内容：<textarea name="body" rows="5" cols="40"></textarea> 画像：<input type="file" name="up_file" ></p>
        　<p>名前:<input type="text" name="cloth_name" size="50" maxlength="50" value=""></p>
          <p>一言:<input type="text" name="tweet" size="50" maxlength="50" value=""></p>
          <p>価格:<input type="text" name="kakaku" size="50" maxlength="50" value=""></p>


          <input type="submit" id="btn-square"  value="送信とアップロード">
        </form>

	</div>

</body>
</html>
