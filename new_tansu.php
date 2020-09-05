<?php
  require_once('./functions.php');
  session_start();

  redirectIfNotLogin();
  $id = $_SESSION['user']['id'];
  $username = $_SESSION['user']['username'];
  $nichiji  = date('Y-m-d H:i:s');
  // POSTリクエストの場合
  if ($_SERVER["REQUEST_METHOD"] === "POST") {


    $cloth_name = $_POST['cloth_name'];
    $kion = $_POST['kion'];
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
    $sql = "INSERT INTO tansu (user_id,image,cloth_name,kion,tweet) VALUES(:user_id,:image,:cloth_name,:kion,:tweet)";
    $statement = $pdo->prepare($sql);
    $result = $statement->execute([
      ':user_id' => $id,


      ':image' => "./picture/".$_FILES['up_file']['name'],
      ':cloth_name' => $cloth_name,
      ':kion' => $kion,
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

    <h2 id = "h">新規タンス登録</h2>
    <h3 id="boder">タンスに入れる</h3>
        <form action="" method="post" enctype="multipart/form-data">
          <!-- <h3>タイトル:<input type="text" name="title" size="50" maxlength="50" value=""   border-bottom: solid 3px black;></h3> -->
          <p id="picture">
            <!-- 内容：<textarea name="body" rows="5" cols="40"></textarea>  -->
            画像：<input type="file" name="up_file" ></p>
        　<p>名前:<input type="text" name="cloth_name" size="50" maxlength="50" value=""></p>
          <p>一言:<input type="text" name="tweet" size="50" maxlength="50" value=""></p>
          <p>気温:<input type="text" name="kion" size="50" maxlength="50" value=""></p>


          <input type="submit" id="btn-square"  value="送信とアップロード">
        </form>

	</div>

</body>
</html>
