<html>
<form method="post" action="mission_3-9register.php">


<title>
会員登録ページ
</title>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<p>
<h1><center>会員登録フォーム</center></h1>
<center>
ユーザーネーム<br>
<input type="text" name="名前"/><br>
パスワード<br>
<input type="password" name="password1"/><br>
メールアドレス<br>
<input type="text" name="mailaddress"/><br><br>
<input type="submit" name="register" value="新規登録" />
</center>
</p>
</form>

<?php
if(!empty($_POST['register'])){



	//ユーザーネームが入力されていないときにエラーメッセージを表示
	if(empty($_POST['名前'])){
	$damedesu = 'ユーザーネームを入力してください';
	echo '<center><FONT COLOR="RED">ユーザーネームを入力してください</FONT></center>';
	//パスワードが入力されていないときにエラーメッセージを表示
	}elseif(empty($_POST['password1'])){
	$betsunodamedesu = 'パスワードを入力してください';
	echo '<center><FONT COLOR="RED">パスワードを入力してください</FONT></center>';
	}elseif(empty($_POST['mailaddress'])){
	echo '<center><FONT COLOR="RED">メールアドレスを入力してください</FONT></center>';
	}elseif(!preg_match('/^[a-zA-Z0-9_.+-]+[@][a-zA-Z0-9.-]+$/', $_POST['mailaddress']))
	die('<center><FONT COLOR="RED">メールアドレスの形式が正しくありません。</FONT></center>');
	}


if(!empty($_POST['名前']) and !empty($_POST['password1']) and !empty($_POST['mailaddress'])){

//名前とパスワードを受け取り変数に格納
$name = $_POST['名前'];
$password = $_POST['password1'];
$address = $_POST['mailaddress'];
//echo $name;
//MySQLとの連携開始
//データベース変数に、MySQL、データベース名、ホスト名を格納。
$dsn = 'mysql:dbname=****;host=****;charset=utf8';

//データベースに接続するためのユーザー名とパスワードを変数に格納。
$user = '****';
$dbpassword = '****';

	
	//データベースに接続
	$pdo = new PDO($dsn, $user, $dbpassword);
		if(!$pdo){
		die('この時点でだめだよ');
		}



$stmt0 = $pdo -> prepare("SELECT * FROM userdata3 WHERE name = :name1");
$stmt0 -> bindValue(':name1', $name, PDO::PARAM_STR);
$stmt0 -> execute();
$countname = $stmt0 -> fetchColumn();

$stmt1 = $pdo -> prepare("SELECT * FROM userdata3 WHERE address = :address");
$stmt1 -> bindValue(':address', $address, PDO::PARAM_STR);
$stmt1 -> execute();
$countaddress = $stmt1 -> fetchColumn();

//echo $count;

//function cheak($username,$count){
if($countname != 0){
die('<center><FONT COLOR="RED">そのユーザーネームは他の人が使用しています。</FONT></center>');
}
if($countaddress != 0){
die('<center><FONT COLOR="RED">そのメールアドレスは使用済みです。</FONT></center>');
}

if(!empty($_POST['register'])){

echo '<br>';
echo'<center>もう一度パスワードを入力してください</center>';
echo '<br>';
echo "<center><form method='post' action='mission_3-9register.php'></center>";
echo "<center><input type='password' name='password2'/></center>";
echo '<br>';
echo "<center><input type='submit'name='再登録' value='登録する' /></center>";
echo "<input type='hidden' name='username' value= '".$name."'/>";
echo "<input type='hidden' name='パスワード' value= '".$password."'/>";
echo "<input type='hidden' name='アドレス' value= '".$address."'/>";

$pdo = null;
}


}

if(isset($_POST['再登録'])){
$username = $_POST['username'];
$password1 = $_POST['パスワード'];
$password2 = $_POST['password2'];
$mailaddress = $_POST['アドレス'];
$datetime = date("Y/m/d H:i:s");
//echo $username;
//echo $password1;
//echo $password2;



if($password1 != $password2){
echo '<center>最初のパスワードと違います。もう一度登録しなおしてください。</center>';
}else{



$unique = uniqid();
$urltoken = hash('sha256', $unique);
$url = "http://co-394.99sv-coco.com/mission_3-9registration.php"."?urltoken=".$urltoken;

//MySQLとの連携開始
//データベース変数に、MySQL、データベース名、ホスト名を格納。
$dsn = 'mysql:dbname=****;host=****;charset=utf8';

//データベースに接続するためのユーザー名とパスワードを変数に格納。
$user = '****';
$dbpassword = '****';

	
	//データベースに接続
	$pdo1 = new PDO($dsn, $user, $dbpassword);
		if(!$pdo1){
		die('この時点でだめだよ');
		}

	
	//prepareを使ってSQLを準備。nameとyとmとdにパラメータを与える
	//こうすることで、値が変わっても何度でもこのSQLをつかえるように
	$stmt = $pdo1 -> prepare("INSERT INTO userdata3 (id, name, address, password, urltoken, datetime) VALUES(:id, :name, :address, :password, :urltoken, :datetime)");

	//パラメータに値を入れておく。bindParam(実行時の変数を反映)を利用。
	$stmt->bindParam(':name', $username, PDO::PARAM_STR); //PDO::PARAM_STRは文字列だよってこと
	$stmt->bindParam('password', $password1, PDO::PARAM_STR);
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->bindParam(':urltoken',$urltoken, PDO::PARAM_STR);
	$stmt->bindParam(':address',$mailaddress, PDO::PARAM_STR);
	$stmt->bindParam(':datetime',$datetime, PDO::PARAM_STR);


	//prepareで用意したものを実行する
	$stmt->execute();


		if(!$stmt){
		//die('preparing is not successful');
		var_dump($pdo->errorInfo());
		}

			$sql = 'SELECT * FROM userdata3 order by id';
			$result = $pdo1 -> query($sql);
			
			//出力する
			foreach($result as $row){
			//echo $row['random'];
			if($row['name'] == $username and $row['password'] == $password1){
			echo '<center>仮登録が完了しました。<br></center>';
			echo '<center>登録したアドレスにメールをお送りしましたので、そちらに記載されているURLから本登録を行ってください。</center>';
		/*	echo 'あなたの登録情報はこちらです。<br>';
			echo 'ID：';
			echo $row['random']. '<br>';
			echo 'ユーザーネーム：';
			echo $row['name']. '<br>';
			echo 'パスワード：あなたの設定したパスワード';
			echo '<br>';*/
			}}


if(!$result){
//die('preparing is not successful');
var_dump($pdo->errorInfo());
}



	//接続終了
	$pdo1 = null;
	

//登録されたメールアドレスを宛先アドレス変数に格納
$mailTo = $mailaddress;
//メールのタイトルを変数に格納
$subject = "【ヨーロッパ旅行用掲示板】本登録のお願い";
//メールの本文を変数に格納
$body = "24時間以内に下記のURLから本登録をお願いします。\n"."$url";
$header = "From: IESO@register.com\r\n";


//メールの言語を設定
mb_language('ja');
mb_internal_encoding('UTF-8');

//メールを送信
if(mb_send_mail($mailTo, $subject, $body, $header)){
//echo 'Well done!';
}

}

}
?>
