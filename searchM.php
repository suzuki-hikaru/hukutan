<?php

if(empty($_POST)){
header("Location.index.php");
  exit();
}else{
  if(!isset($_POST['musicname'])||$_POST['musicname']==""){
    $errors['name']="名前が入力されていません";
  }
  $musicname=$_POST['musicname'];
}


if(($errors)==null){
  require_once('./functions.php');

}
try{
$like_musicname="%".$musicname."%";
    $pdo = connectDB();
    $sql ="SELECT * FROM hukus_p WHERE cloth_name like $like_musicname";
    $statement = $pdo->query($sql);
    $statement->execute(
    );
    $musics = $statement->fetchAll();

    $dbh=null;
  }catch(PDOExepation $e){
    print('Error:'.$e->getMessage());
    $errors['error']="データベース接続に失敗しました。";
  }
}
    ?>
    <!DOCTYPE  html>
    <html>
    <head>
    <title>検索結果</title>
    <meta charset="utf-8">
