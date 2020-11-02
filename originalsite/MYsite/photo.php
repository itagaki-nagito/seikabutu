<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>photo</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
        <h4>渚のサイト</h4>
        <h5><a href="originalsite.php">トップページに戻る</a></h5>

<div id="A"><h1>写真とかのあれこれ</h1></div>
<article>ここはまだ社会人になりきれていない青年のサイトです。良かったら見ていってね</article>
</header>
<ul><div id="ul">カテゴリー</div>
    <li><a href="daily.php"class="pochitto_btn_blue">日常のつぶやき</il>
    <li><a href="hobies.php"class="pochitto_btn_blue">趣味</a></li>
    <li><a href="photo.php"class="pochitto_btn_blue">映えそうな写真</a></li>
    <li><a href="tubuyaki.php"class="pochitto_btn_blue">愚痴</a></li>
</ul>
<div id="prof">サイト作者　渚
    <br>２００１年生まれの十九歳、
    現在はアルバイトをしつつIT関連の勉強をしている最中
</div>
<div class="note">
<p>ここにテキストを挿入</p>
</div>
<h4>コメント</h4>
<h6>良かったらコメントもどうぞ！</h6>

<!--ここで投稿内容を送信する-->
<div id="message"><form action="" method="post">
    メッセージ:<input type="text" name="message">
    <br>
    ユーザー名:<input type="text" name="user_name">
    <input type="submit" name="send_message" value="投稿">
</form>
</div>

<?php

// ファイルの指定
$dataFile = 'datafile-photo.dat';

//エスケープする関数
function h($s){
return htmlspecialchars($s,ENT_QUOTES,'UTF-8');
}

//name="send_message"のPOST送信があった時
if(isset($_POST["send_message"])){
    //送信されたname="message"とname="user_name"の値を取得する
    $message = trim($_POST['message']);
    $user = trim($_POST['user_name']);

    //messageが空じゃなかったら
    if(!empty($message)){

        //userが空の場合、名無しにする
        if(empty($user)){
          $user = "名無し";
        }
        //日付を取得する
        $postDate = date('Y-m-d H:i:s');
        //ファイルに書き込むメッセージを作成する
        $newData  = $message." / ".$user." / ".$postDate."\n";
        //ファイルを開く
        $fp = fopen($dataFile,'a');
        //ファイルに書き込む
        fwrite($fp,$newData);
        //ファイルを閉じる
        fclose($fp);
    }
}
//一行ずつデータを取り出して配列に入れる
$post_list = file($dataFile,FILE_IGNORE_NEW_LINES);
//逆順に並べ替える
$post_list = array_reverse($post_list);
?>




<h2>投稿一覧</h2>
<ul>
<!--post_listがある場合-->
<?php if (!empty($post_list)){ ?>
    <!--post_listの中身をひとつづつ取り出し表示する-->
    <?php foreach ($post_list as $post){ ?>
    <li><?php echo h($post); ?></li>
    <?php } ?>
<?php }else { ?>
    <li>まだ投稿はありません。</li>
<?php } ?>
</ul>
</body>
</html>
    
