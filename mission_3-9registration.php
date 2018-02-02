<title>
本登録ページ
</title>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>


<center>ようこそ！</center>
<br>


<?php
$urltoken = isset($_GET[urltoken]) ? $_GET[urltoken] : NULL;
//echo $urltoken;

	if(!empty($urltoken)){


	//データベース変数に、MySQL、データベース名、ホスト名を格納。
	$dsn = 'mysql:dbname=****;host=****;charset=utf8';

	//データベースに接続するためのユーザー名とパスワードを変数に格納。
	$user = '****';
	$dbpassword = '****';

		//try{
		//データベースに接続
		$pdo = new PDO($dsn, $user, $dbpassword);

			if(!$pdo){
			die('この時点でだめだよ');
			}

		//文字化け防止用
		$stmt = $pdo -> query('SET NAMES utf8mb4');


	$sql = 'SELECT * FROM userdata3 order by id';
	$result = $pdo -> query($sql);

	$stmt = $pdo -> prepare("UPDATE userdata3 SET flag =:flag WHERE urltoken = :urltoken AND flag=0 AND datetime > now() - interval 24 hour");

		//パラメータに値を入れておく。bindParam(実行時の変数を反映)を利用。
		$stmt->bindParam(':flag', $flag, PDO::PARAM_STR); //PDO::PARAM_STRは文字列だよってこと
		$stmt->bindParam(':urltoken', $urltoken, PDO::PARAM_STR); //PDO::PARAM_INTは数値だよってこと


$flag = 1;
		//prepareで用意したものを実行する
		$stmt->execute();

			if(!$stmt){
			//die('preparing is not successful');
			var_dump($pdo->errorInfo());
			}else{
			echo"<center>本登録を行いました。<a href='mission_3-7login.php'>こちら</a>からログインしてください。</center>";
			}


		//接続終了
		$pdo = null;
		//}
}


?>