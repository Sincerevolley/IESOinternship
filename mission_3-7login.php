

<?php
//セッションの開始
session_start();

//セッション[test]にデータを保存する
$_SESSION['test'] = "セッションテストだよ";
if(isset($_SESSION['name'])){
//echo '<a href="mission_3-7chat.php">こちら</a>から掲示板ページへどうぞ';
$status = 'logged_in';
//出力
//echo "結果：" .$_SESSION['test'];
}
?>

<html>
<title>
ログインページ
</title>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<p>



<?php
if($status == 'logged_in'):
//echo '「ヨーロッパ旅行用掲示板」への再びの訪問ありがとうございます。';
//echo '<br>';
//echo '一度ログイン済みなので、<a href="mission_3-8chat.php">こちら</a>から掲示板ページへどうぞ';
header("Location: mission_3-8chat.php");
?>
<?php else:?>

<form method="post" action="mission_3-7login.php">


<title>
ログインページ
</title>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<p>
<h1><center>ログインフォーム</center></h1>
<center>
「ヨーロッパ旅行用掲示板」へようこそ。<br><br>
ユーザーネームとパスワードを入力してログインしてください。<br><br>
ユーザーネーム<br>
<input type="text" name="名前"/><br><br>
パスワード<br>
<input type="password" name="password"/><br>
<input type="submit" name="login" value="ログイン" />
</center>
</p>
</form>



<?php endif; ?>

<?php
if(!empty($_POST['login'])){

	if(empty($_POST['名前'])){
	echo "<center><FONT COLOR='RED'>ユーザーネームを入力してください</FONT></center>";
	}else if(empty($_POST['password'])){
	echo "<center><FONT COLOR='GREEN'>パスワードを入力してください</FONT></center>";
	}else{

$username = $_POST['名前'];
$password = $_POST['password'];
//echo $_POST['名前'];


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


			$sql = 'SELECT * FROM userdata3 order by id';
			$result = $pdo1 -> query($sql);
//			echo $username;
//			echo $password;
			//出力する
		foreach($result as $row){
/*			echo $row['name'];
			echo $row['password'];
			echo $username;
			echo $password;
*///
//	if($row['flag'] == '0'){
	

		if($row['name'] == $username and $row['password'] == $password and $row['flag']=='1'){
	
//			if($row['flag'] == '1'){
			session_start();
			$_SESSION['name'] = $username;
//			echo $_SESSION['name'];
			//die ('<a href="mission_3-8chat.php">こちら</a>から掲示板ページへどうぞ');
			header("Location: mission_3-8chat.php");
//			}else{
//			$error = '本登録をしてください';
//			}

		}else{
		$error = "ユーザーネームもしくはパスワードが違うか、本登録が完了していません。<br>もう一度入力してください。";
		}}

echo "<center><FONT COLOR='RED'>$error</FONT></center>";
			
}
}





?>

<?php
if($status != 'logged_in'){
echo "<center>アカウントをお持ちでない方は<a href='mission_3-9register.php'>こちら</a>から新規登録できます<br></center>";
}
?>

<br>
<br>
<br>

