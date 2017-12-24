
<html>
<form method="post" action="mission_2-15.php">


<title>
ヨーロッパ周遊ブログ
</title>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<p>
<h1>ヨーロッパ周遊ブログ</h1>

名前：<br>
<input type="text" name="名前"/><br>
<br>
ヨーロッパで好きな国を教えてください。
<br>
<textarea name="comment" rows="4" cols="50"></textarea><br>
<br>
パスワード:<br>
<input type="password" name="password"/><br>
(注)個人情報を含むパスワードや普段使っているパスワードは使わないでください！<br>
<br>
<input type="submit" value="送信" />

</p>
</form>


<?php

//名前とコメントを受け取り変数に格納
$name1 = $_POST['名前'];
$comment1 = $_POST['comment'];

//パスワードを受け取り変数に格納
$password = $_POST['password'];


//改行を削除する
$comment2 = str_replace("\r\n","",$comment1);

//if分を用いて、データの送信があった時だけと条件を付ける
if(!empty($password)){
//echo $password;

  //日付と時間を変数に格納
  $date = date("Y/m/d H:i:s");


//MySQLとの連携開始
//データベース変数に、MySQL、データベース名、ホスト名を格納。
$dsn = 'mysql:dbname=****;host=****;charset=utf8';

//データベースに接続するためのユーザー名とパスワードを変数に格納。
$user = '****';
$dbpassword = '****';

	try{
	//データベースに接続
	$pdo = new PDO($dsn, $user, $dbpassword);
		if(!$pdo){
		die('この時点でだめだよ');
		}

	//文字化け防止用
//	$stmt = $pdo -> query('SET NAMES utf8mb4');

	//prepareを使ってSQLを準備。nameとyとmとdにパラメータを与える
	//こうすることで、値が変わっても何度でもこのSQLをつかえるように
	$stmt = $pdo -> prepare("INSERT INTO europecountry (id, name, comment, datetime, password) VALUES(:id, :name, :comment, :datetime, :password)");

	//パラメータに値を入れておく。bindParam(実行時の変数を反映)を利用。
	$stmt->bindParam(':name', $name1, PDO::PARAM_STR); //PDO::PARAM_STRは文字列だよってこと
	$stmt->bindParam(':comment', $comment2, PDO::PARAM_STR); //PDO::PARAM_INTは数値だよってこと
	$stmt->bindParam('datetime', $datetime, PDO::PARAM_STR);
	$stmt->bindParam('password', $password, PDO::PARAM_STR);
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);


	//入力したい値を指定
	//$name = "SEIGO";
	//$comment = "Hello!!";
	$datetime = date("Y/m/d H:i:s");
	//$password = 1111;

	//$id = 5;

	//prepareで用意したものを実行する
	$stmt->execute();


		if(!$stmt){
		//die('preparing is not successful');
		var_dump($pdo->errorInfo());
		}

			$sql = 'SELECT * FROM europecountry order by id';
			$result = $pdo -> query($sql);

			//出力する
			foreach($result as $row){
			echo $row['id']. ':';
			echo $row['name']. ',';
			echo $row['comment']. ',';
			echo $row['datetime']. '<br>';
			}


if(!$result){
//die('preparing is not successful');
var_dump($pdo->errorInfo());
}



	//接続終了
	$pdo = null;
	}

		//接続に失敗した際のエラー処理
		catch (PDOException $e){
		print('エラーが発生しました。:'.$e->getMessage());
		die();
		}
}
?>

<?php
//削除フォームプログラム開始
?>

<html>
<form method="post" action="mission_2-15.php">

<title>
削除番号用フォーム
</title>
<p>
<br>
<h2>削除番号用フォーム</h2>
削除対象番号：<br>
<input type="text" name="削除番号"/><br>
パスワード：<br>
<input type="password" name="削除用暗号"/><br>
<br>
<input type="submit" value="この番号の投稿を削除する" />

</p>
</form>


<?php
$del_password = $_POST['削除用暗号'];
$delete_id = $_POST['削除番号'];


//if分を用いて、データの送信があった時だけと条件を付ける

if(!empty($del_password)){


$code = $del_password;



	//データベース変数に、MySQL、データベース名、ホスト名を格納。
	$dsn = 'mysql:dbname=****;host=****';

	//データベースに接続するためのユーザー名とパスワードを変数に格納。
	$user = '****';
	$dbpassword = '****';

	try{
	//データベースに接続
	$pdo = new PDO($dsn, $user, $dbpassword);

		if(!$pdo){
		die('この時点でだめだよ');
		}

	//文字化け防止用
	$stmt = $pdo -> query('SET NAMES utf8mb4');

	//prepareを使ってSQLを準備。DELETE FROMで指定の番号のデータの削除を指示。
	//こうすることで、値が変わっても何度でもこのSQLをつかえるように
	$stmt = $pdo -> prepare("DELETE FROM europecountry WHERE id = :delete_id AND password = :password");


	//パラメータに値を入れておく。bindValue(バインド時の変数を反映)を利用。
	$stmt->bindValue(':delete_id',$delete_id, PDO::PARAM_INT);
	$stmt->bindValue(':password',$del_password, PDO::PARAM_STR);

	$stmt->execute();

	echo "削除後の投稿がこちらです". "<br>". "<hr>";

	$sql = 'SELECT * FROM europecountry order by id';
	$result = $pdo -> query($sql);

	//出力する
	foreach($result as $row){
	echo $row['id']. ':';
	echo $row['name']. ',';
	echo $row['comment']. ',';
	echo $row['datetime']. '<br>';
	}

		if(!$stmt){
		//die('preparing is not successful');
		var_dump($pdo->errorInfo());
		}


	//接続終了
	$pdo = null;
	}

		//接続に失敗した際のエラー処理
		catch (PDOException $e){
		print('エラーが発生しました。:'.$e->getMessage());
		die();
		}

}




//編集用プログラム開始
?>

<html>

<form method="post" action="mission_2-15.php">

<title>
編集番号用フォーム
</title>
<p>
<h2>編集番号用フォーム</h2>
投稿を編集したいときに使ってください。<br>
編集対象番号：<br>
<input type="text" name="編集番号"/><br>
パスワード：<br>
<input type="password" name="編集用暗号"/><br>
<br>
<input type="submit" value="この番号の投稿を編集する" />
</p>
</form>


<?php
$password = $_POST['編集用暗号'];
$edit_id = $_POST['編集番号'];


//if分を用いて、データの送信があった時だけと条件を付ける
if(!empty($edit_id)){

$code = $password;


	//データベース変数に、MySQL、データベース名、ホスト名を格納。
	$dsn = 'mysql:dbname=****;host=****';

	//データベースに接続するためのユーザー名とパスワードを変数に格納。
	$user = '****';
	$dbpassword = '****';

		try{
		//データベースに接続
		$pdo = new PDO($dsn, $user, $dbpassword);
	
			if(!$pdo){
			die('この時点でだめだよ');
			}

		//文字化け防止用
		$stmt = $pdo -> query('SET NAMES utf8mb4');

		$sql = 'SELECT * FROM europecountry order by id';
		$result = $pdo -> query($sql);

			//出力する
			foreach($result as $row){
			$edittedname = $row['name'];
			$edittedcomment = $row['comment'];

				if($row['password']==$code and $row['id']==$edit_id){
				//フォームをechoで表示させる
				echo "<form method='post' action='mission_2-15.php'>";
				echo "名前<br><input type='text' name='新名前' value = '".$edittedname."'/><br>";
				echo "コメント<br><textarea name='新comment' rows='4' cols='50'>".$edittedcomment."</textarea><br>";
				echo "<input type='submit' name='編集送信' value='編集内容を送信' />";
				echo "<input type='hidden' name='編集' value= '".$edit_id."'/>";
				}

			}

//}}

		//接続終了
		$pdo = null;
		}

		//接続に失敗した際のエラー処理
		catch (PDOException $e){
		print('エラーが発生しました。:'.$e->getMessage());
		die();
		}


}
?>

<?php
//echo $_POST['新comment'];
//if($row['password'] == $code){


//POSTで送信されたデータを受け取る。
$newname = $_POST['新名前'];
$newcomment = $_POST['新comment'];
$hidden = $_POST['編集'];
$edit_id = $_POST['編集番号'];
$newcomment2 = str_replace("\r\n","",$newcomment);


//echo $hidden;

if(!empty($_POST['編集送信'])){


	if(!empty($newname)){
	echo "編集後の投稿がこちらです". "<br>". "<hr>";
	}
//	echo $newname;
//	echo $hidden;

	//データベース変数に、MySQL、データベース名、ホスト名を格納。
	$dsn = 'mysql:dbname=****;host=****';

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

		//prepareを使ってSQLを準備。UPDATEで編集を指示。
		//こうすることで、値が変わっても何度でもこのSQLをつかえるように
		$stmt = $pdo -> prepare("UPDATE europecountry SET name =:name, comment =:comment WHERE id = :edit_id");

		//パラメータに値を入れておく。bindParam(実行時の変数を反映)を利用。
		$stmt->bindParam(':name', $newname, PDO::PARAM_STR); //PDO::PARAM_STRは文字列だよってこと
		$stmt->bindParam(':comment', $newcomment2, PDO::PARAM_STR); //PDO::PARAM_INTは数値だよってこと
		//$stmt->bindParam(':datetime', $datetime, PDO::PARAM_STR);
		//$stmt->bindParam(':password', $password, PDO::PARAM_STR);

		$stmt->bindValue(':edit_id',$hidden, PDO::PARAM_INT);


		//prepareで用意したものを実行する
		$stmt->execute();

			if(!$stmt){
			//die('preparing is not successful');
			var_dump($pdo->errorInfo());
			}

	$sql = 'SELECT * FROM europecountry order by id';
	$result = $pdo -> query($sql);

	//出力する
	foreach($result as $row){
	echo $row['id']. ':';
	echo $row['name']. ',';
	echo $row['comment']. ',';
	echo $row['datetime']. '<br>';
	}

		//接続終了
		$pdo = null;
		//}
}
//}
//}
?>
