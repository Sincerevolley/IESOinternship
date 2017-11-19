
<html>
<form method="post" action="mission_2-6check.php">
<title>
ヨーロッパ周遊ブログ
</title>
<p>
<h1>ヨーロッパ周遊ブログ</h1>
名前：<br>
<input type="text" name="名前"/><br>
<br>
ヨーロッパに行ったことがある場合は、おすすめの国を3つまで「＆」でつないで教えてください。<br>
(例)スイス＆アイスランド＆ノルウェー<br>
行ったことがない場合は、行ってみたい国を3つまで「・」でつないで教えてください。<br>
(例)ギリシャ・アイルランド・ポーランド<br>
<textarea name="comment" rows="4" cols="50"></textarea><br>
<br>
パスワード:<br>
<input type="text" name="password"/><br>
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

  //テキストファイルを変数に格納
  $filename = 'kadai2-6check.txt';

  //ファイルを追記書き込みモードで開く
  $fp = fopen($filename, 'a');

  //file関数でファイルを配列に格納し変数に。
  $hairetsu = file($filename);
  $lines = array($hairetsu);
  //配列の数をcountで数え、その値を変数に格納
  $number = count($lines,COUNT_RECURSIVE);

  //出力したいすべての文字列を一つの変数にまとめる。
  $data = $number ."<>" . $name1 . "<>" .$comment2 ."<>" .$date ."<>" .$password ."<>" ."\n";

  //ファイルに受け取ったデータを書き込む
  fwrite($fp,$data);

  //ファイルを閉じる
  fclose($fp);
}
?>

<?php
//if分を用いて、データの送信があった時だけと条件を付ける
if(!empty($name1)){

  $filename1 = 'kadai2-6check.txt';

  //ファイルを配列に格納し変数に
  $chat = file($filename1);

  //ループ関数を用いて/explodeで<>を取り除き、$hairetsuの中身のそれぞれの値を取得。

  foreach($chat as $value){

	$pieces = explode("<>", $value);
		if(!empty($pieces[1])){

	  	$finaldata = $pieces[0] ." " .$pieces[1] ." " .$pieces[2] ." " .$pieces[3];
  		echo $finaldata ."<br>";//$piecesをすべて表示
		}
  }
}
?>

<?php
//削除フォームプログラム開始
?>

<html>
<form method="post" action="mission_2-6check.php">
<title>
削除番号用フォーム
</title>
<p>
<br>
<h2>削除番号用フォーム</h2>
投稿を削除したい場合に使ってください。<br>
削除対象番号：<br>
<input type="text" name="削除番号"/><br>
パスワード：<br>
<input type="text" name="削除用暗号"/><br>
<br>
<input type="submit" value="この番号の投稿を削除する" />
</p>
</form>

<?php
$password = $_POST['削除用暗号'];
$delete = $_POST['削除番号'];

//if分を用いて、データの送信があった時だけと条件を付ける
//そのとき、パスワード入力を求めるフォームを表示する。
if(!empty($password)){
//echo $delete;
//echo $password;
//}

$code = $password;

//テキストファイルを関数に格納
$filename0 = 'kadai2-6check.txt';

//ファイルを配列に格納し変数に
$chat = file($filename0);

	$fp2 = fopen($filename0, 'w+');
//echo $code;
		/*ループ関数を用いて/explodeで<>を取り除き、$chatの中身のそれぞれの値を取得。*/
		foreach($chat as $value){
		$pieces = explode("<>", $value);
		//echo $pieces[4];

				/*テキストファイルにある投稿番号とPOSTで削除番号フォームから
		  		受け取った削除番号を比較し、イコールのときかつパスワードが一致するときは削除する*/
				if($pieces[0] == $delete and $pieces[4] == $code){
				fwrite($fp2, ' ' ."\n");

					//それ以外の場合は元の配列のデータを書き込む
				}	else{
					fputs($fp2, $value);
					}
		}
	
	fclose($fp2);
}
?>

<?php
//if分を用いて、データの送信があった時だけと条件を付ける
if(!empty($_POST['削除用暗号'])){

  $filename1 = 'kadai2-6check.txt';

  //ファイルを配列に格納し変数に
  $chat = file($filename1);

  //ループ関数を用いて/explodeで<>を取り除き、$hairetsuの中身のそれぞれの値を取得。

  foreach($chat as $value){

	$pieces = explode("<>", $value);
		if(!empty($pieces[1])){

	  	$finaldata = $pieces[0] ." " .$pieces[1] ." " .$pieces[2] ." " .$pieces[3];
  		echo $finaldata ."<br>";//$piecesをすべて表示
		}
  }
}
?>

<?php
//編集用プログラム開始
?>

<html>
<form method="post" action="mission_2-6check.php">
<title>
編集番号用フォーム
</title>
<p>
<h2>編集番号用フォーム</h2>
投稿を編集したいときに使ってください。<br>
編集対象番号：<br>
<input type="text" name="編集番号"/><br>
パスワード：<br>
<input type="text" name="編集用暗号"/><br>
<br>
<input type="submit" value="この番号の投稿を編集する" />
</p>
</form>

<?php
$password = $_POST['編集用暗号'];
$edit = $_POST['編集番号'];

//テキストファイルを関数に格納
$filename = 'kadai2-6check.txt';

//if分を用いて、データの送信があった時だけと条件を付ける
if(!empty($edit)){

$code = $password;

//ファイルを配列に格納し変数に
$chat = file($filename);

//ファイルを読み込みモードで開く。
$fp2 = fopen($filename, 'r');

	/*ループ関数を用いて/explodeで<>を取り除き、$chatの中身のそれぞれの値を取得。*/
	foreach($chat as $value){
	$pieces = explode("<>", $value);

		/*テキストファイルにある投稿番号とPOSTで編集番号フォームから
	  	受け取った編集番号を比較し、イコールの時その配列の値を取得する*/
		if($pieces[0] == $edit and $pieces[4] == $password){
		$edittedname = $pieces[1];
		$edittedcomment = $pieces[2];
		//フォームをechoで表示させる
		echo "<form method='post' action='mission_2-6check.php'>";
		echo "名前<br><input type='text' name='新名前' value = '".$edittedname."'/><br>";
		echo "コメント<br><textarea name='新comment' rows='4' cols='50'>".$edittedcomment."</textarea><br>";
		echo "<input type='submit'value='編集内容を送信' />";
		echo "<input type='hidden' name='編集' value= '".$edit."'/>";
		}
	}
fclose($fp2);
}

if($pieces[4] == $password){

//POSTで送信されたデータを受け取る。
$newname = $_POST['新名前'];
$newcomment = $_POST['新comment'];
$hidden = $_POST['編集'];
$edit2 = $_POST['編集番号'];
$newcomment2 = str_replace("\r\n","",$newcomment);
//echo $hidden;

//hiddenで与えられた値があるときだけ編集モードにする。
	if(!empty($hidden)){
//	echo "編集用データが送信されました";
//	echo $hidden;
	
	//ファイルを配列に格納し変数に
	$chat0 = file($filename);

	//ファイルの内容を削除し書き込みモードで開く。
	$fp0 = fopen($filename, 'w+');

		/*ループ関数を用いて/explodeで<>を取り除き、$chatの中身のそれぞれの値を取得。*/
		foreach($chat0 as $value0){
		$pieces0 = explode("<>", $value0);

			/*テキストファイルにある投稿番号とPOSTで編集番号フォームから
		  	受け取った編集番号を比較し、イコールの時もとの投稿内容と差し替える*/
			if($pieces0[0] == $hidden){
			//echo $hidden;
			array_splice($pieces0, 2, 1, "$newcomment2");
			//var_dump($pieces0);
			$editteddata = $pieces0[0] ."<>" .$pieces0[1] ."<>" .$pieces0[2] ."<>" .$pieces0[3] ."<>" .$pieces0[4] ."<>";
			fwrite($fp0, $editteddata ."\n");

				//イコールでなく、かつ投稿番号があるときはもとの内容を再度書き込む。
				}elseif(!empty($pieces0[1])){
				$data = $pieces0[0] ."<>" .$pieces0[1] ."<>" .$pieces0[2] ."<>" .$pieces0[3] ."<>" .$pieces0[4] ."<>";
				fwrite($fp0, $data ."\n");
				
				//投稿番号が削除されている時は
				}else{
				fwrite($fp0, "\n");
				}
		}
	fclose($fp0);
	}
}
?>

<?php
//if分を用いて、データの送信があった時だけと条件を付ける
if(!empty($_POST['新名前'])){
  
  $filename1 = 'kadai2-6check.txt';

  //ファイルを配列に格納し変数に
  $chat = file($filename1);

  //ループ関数を用いて/explodeで<>を取り除き、$hairetsuの中身のそれぞれの値を取得。

  foreach($chat as $value){

	$pieces = explode("<>", $value);
		if(!empty($pieces[1])){

	  	$finaldata = $pieces[0] ." " .$pieces[1] ." " .$pieces[2] ." " .$pieces[3];
  		echo $finaldata ."<br>";//$piecesをすべて表示
		}
  }
}
?>
