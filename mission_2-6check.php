
<html>

<form method="post" action="mission_2-6check.php">


<title>
���[���b�p���V�u���O
</title>
<p>
<h1>���[���b�p���V�u���O</h1>
���O�F<br>
<input type="text" name="���O"/><br>
<br>
���[���b�p�ɍs�������Ƃ�����ꍇ�́A�������߂̍���3�܂Łu���v�łȂ��ŋ����Ă��������B<br>
(��)�X�C�X���A�C�X�����h���m���E�F�[<br>
�s�������Ƃ��Ȃ��ꍇ�́A�s���Ă݂�������3�܂Łu�E�v�łȂ��ŋ����Ă��������B<br>
(��)�M���V���E�A�C�������h�E�|�[�����h<br>
<textarea name="comment" rows="4" cols="50"></textarea><br>
<br>
�p�X���[�h:<br>
<input type="text" name="password"/><br>
(��)�l�����܂ރp�X���[�h�╁�i�g���Ă���p�X���[�h�͎g��Ȃ��ł��������I<br>
<br>
<input type="submit" value="���M" />

</p>
</form>


<?php

//���O�ƃR�����g���󂯎��ϐ��Ɋi�[
$name1 = $_POST['���O'];
$comment1 = $_POST['comment'];

//�p�X���[�h���󂯎��ϐ��Ɋi�[
$password = $_POST['password'];


//���s���폜����
$comment2 = str_replace("\r\n","",$comment1);

//if����p���āA�f�[�^�̑��M���������������Ə�����t����
if(!empty($password)){
//echo $password;

  //���t�Ǝ��Ԃ�ϐ��Ɋi�[
  $date = date("Y/m/d H:i:s");


  //�e�L�X�g�t�@�C����ϐ��Ɋi�[
  $filename = 'kadai2-6check.txt';

  //�t�@�C����ǋL�������݃��[�h�ŊJ��
  $fp = fopen($filename, 'a');

  //file�֐��Ńt�@�C����z��Ɋi�[���ϐ��ɁB
  $hairetsu = file($filename);
  $lines = array($hairetsu);
  //�z��̐���count�Ő����A���̒l��ϐ��Ɋi�[
  $number = count($lines,COUNT_RECURSIVE);



  //�o�͂��������ׂĂ̕��������̕ϐ��ɂ܂Ƃ߂�B
  $data = $number ."<>" . $name1 . "<>" .$comment2 ."<>" .$date ."<>" .$password ."<>" ."\n";


  //�t�@�C���Ɏ󂯎�����f�[�^����������
  fwrite($fp,$data);


  //�t�@�C�������
  fclose($fp);

}
?>

<?php
//if����p���āA�f�[�^�̑��M���������������Ə�����t����
if(!empty($name1)){

  
  $filename1 = 'kadai2-6check.txt';

  //�t�@�C����z��Ɋi�[���ϐ���
  $chat = file($filename1);

  //���[�v�֐���p����/explode��<>����菜���A$hairetsu�̒��g�̂��ꂼ��̒l���擾�B

  foreach($chat as $value){



	$pieces = explode("<>", $value);
		if(!empty($pieces[1])){

	  	$finaldata = $pieces[0] ." " .$pieces[1] ." " .$pieces[2] ." " .$pieces[3];
  		echo $finaldata ."<br>";//$pieces�����ׂĕ\��
		}


  }

}
?>

<?php
//�폜�t�H�[���v���O�����J�n
?>

<html>
<form method="post" action="mission_2-6check.php">

<title>
�폜�ԍ��p�t�H�[��
</title>
<p>
<br>
<h2>�폜�ԍ��p�t�H�[��</h2>
���e���폜�������ꍇ�Ɏg���Ă��������B<br>
�폜�Ώ۔ԍ��F<br>
<input type="text" name="�폜�ԍ�"/><br>
�p�X���[�h�F<br>
<input type="text" name="�폜�p�Í�"/><br>
<br>
<input type="submit" value="���̔ԍ��̓��e���폜����" />

</p>
</form>


<?php
$password = $_POST['�폜�p�Í�'];
$delete = $_POST['�폜�ԍ�'];


//if����p���āA�f�[�^�̑��M���������������Ə�����t����
//���̂Ƃ��A�p�X���[�h���͂����߂�t�H�[����\������B
if(!empty($password)){
//echo $delete;
//echo $password;
//}

$code = $password;


//�e�L�X�g�t�@�C�����֐��Ɋi�[
$filename0 = 'kadai2-6check.txt';

//�t�@�C����z��Ɋi�[���ϐ���
$chat = file($filename0);


	$fp2 = fopen($filename0, 'w+');
//echo $code;
		/*���[�v�֐���p����/explode��<>����菜���A$chat�̒��g�̂��ꂼ��̒l���擾�B*/
		foreach($chat as $value){
		$pieces = explode("<>", $value);
		//echo $pieces[4];


				/*�e�L�X�g�t�@�C���ɂ��铊�e�ԍ���POST�ō폜�ԍ��t�H�[������
		  		�󂯎�����폜�ԍ����r���A�C�R�[���̂Ƃ����p�X���[�h����v����Ƃ��͍폜����*/
				if($pieces[0] == $delete and $pieces[4] == $code){
				fwrite($fp2, ' ' ."\n");

					//����ȊO�̏ꍇ�͌��̔z��̃f�[�^����������
				}	else{
					fputs($fp2, $value);
					}

		}

	fclose($fp2);

}

?>

<?php
//if����p���āA�f�[�^�̑��M���������������Ə�����t����
if(!empty($_POST['�폜�p�Í�'])){

  
  $filename1 = 'kadai2-6check.txt';

  //�t�@�C����z��Ɋi�[���ϐ���
  $chat = file($filename1);

  //���[�v�֐���p����/explode��<>����菜���A$hairetsu�̒��g�̂��ꂼ��̒l���擾�B

  foreach($chat as $value){



	$pieces = explode("<>", $value);
		if(!empty($pieces[1])){

	  	$finaldata = $pieces[0] ." " .$pieces[1] ." " .$pieces[2] ." " .$pieces[3];
  		echo $finaldata ."<br>";//$pieces�����ׂĕ\��
		}


  }

}
?>



<?php
//�ҏW�p�v���O�����J�n
?>

<html>

<form method="post" action="mission_2-6check.php">

<title>
�ҏW�ԍ��p�t�H�[��
</title>
<p>
<h2>�ҏW�ԍ��p�t�H�[��</h2>
���e��ҏW�������Ƃ��Ɏg���Ă��������B<br>
�ҏW�Ώ۔ԍ��F<br>
<input type="text" name="�ҏW�ԍ�"/><br>
�p�X���[�h�F<br>
<input type="text" name="�ҏW�p�Í�"/><br>
<br>
<input type="submit" value="���̔ԍ��̓��e��ҏW����" />
</p>
</form>


<?php
$password = $_POST['�ҏW�p�Í�'];
$edit = $_POST['�ҏW�ԍ�'];

//�e�L�X�g�t�@�C�����֐��Ɋi�[
$filename = 'kadai2-6check.txt';

//if����p���āA�f�[�^�̑��M���������������Ə�����t����
if(!empty($edit)){

$code = $password;

//�t�@�C����z��Ɋi�[���ϐ���
$chat = file($filename);

//�t�@�C����ǂݍ��݃��[�h�ŊJ���B
$fp2 = fopen($filename, 'r');

	/*���[�v�֐���p����/explode��<>����菜���A$chat�̒��g�̂��ꂼ��̒l���擾�B*/
	foreach($chat as $value){
	$pieces = explode("<>", $value);


		/*�e�L�X�g�t�@�C���ɂ��铊�e�ԍ���POST�ŕҏW�ԍ��t�H�[������
	  	�󂯎�����ҏW�ԍ����r���A�C�R�[���̎����̔z��̒l���擾����*/
		if($pieces[0] == $edit and $pieces[4] == $password){
		$edittedname = $pieces[1];
		$edittedcomment = $pieces[2];
		//�t�H�[����echo�ŕ\��������
		echo "<form method='post' action='mission_2-6check.php'>";
		echo "���O<br><input type='text' name='�V���O' value = '".$edittedname."'/><br>";
		echo "�R�����g<br><textarea name='�Vcomment' rows='4' cols='50'>".$edittedcomment."</textarea><br>";
		echo "<input type='submit'value='�ҏW���e�𑗐M' />";
		echo "<input type='hidden' name='�ҏW' value= '".$edit."'/>";
		}
	
	}
fclose($fp2);

}
if($pieces[4] == $password){

//POST�ő��M���ꂽ�f�[�^���󂯎��B
$newname = $_POST['�V���O'];
$newcomment = $_POST['�Vcomment'];
$hidden = $_POST['�ҏW'];
$edit2 = $_POST['�ҏW�ԍ�'];
$newcomment2 = str_replace("\r\n","",$newcomment);
//echo $hidden;

//hidden�ŗ^����ꂽ�l������Ƃ������ҏW���[�h�ɂ���B
	if(!empty($hidden)){
//	echo "�ҏW�p�f�[�^�����M����܂���";
//	echo $hidden;
	
	//�t�@�C����z��Ɋi�[���ϐ���
	$chat0 = file($filename);

	//�t�@�C���̓��e���폜���������݃��[�h�ŊJ���B
	$fp0 = fopen($filename, 'w+');

		/*���[�v�֐���p����/explode��<>����菜���A$chat�̒��g�̂��ꂼ��̒l���擾�B*/
		foreach($chat0 as $value0){
		$pieces0 = explode("<>", $value0);

			/*�e�L�X�g�t�@�C���ɂ��铊�e�ԍ���POST�ŕҏW�ԍ��t�H�[������
		  	�󂯎�����ҏW�ԍ����r���A�C�R�[���̎����Ƃ̓��e���e�ƍ����ւ���*/
			if($pieces0[0] == $hidden){
			//echo $hidden;
			array_splice($pieces0, 2, 1, "$newcomment2");
			//var_dump($pieces0);
			$editteddata = $pieces0[0] ."<>" .$pieces0[1] ."<>" .$pieces0[2] ."<>" .$pieces0[3] ."<>" .$pieces0[4] ."<>";
			fwrite($fp0, $editteddata ."\n");

				//�C�R�[���łȂ��A�����e�ԍ�������Ƃ��͂��Ƃ̓��e���ēx�������ށB
				}elseif(!empty($pieces0[1])){
				$data = $pieces0[0] ."<>" .$pieces0[1] ."<>" .$pieces0[2] ."<>" .$pieces0[3] ."<>" .$pieces0[4] ."<>";
				fwrite($fp0, $data ."\n");
				
				//���e�ԍ����폜����Ă��鎞��
				}else{
				fwrite($fp0, "\n");
				}

		}
	fclose($fp0);
	}


}

?>

<?php
//if����p���āA�f�[�^�̑��M���������������Ə�����t����
if(!empty($_POST['�V���O'])){

  
  $filename1 = 'kadai2-6check.txt';

  //�t�@�C����z��Ɋi�[���ϐ���
  $chat = file($filename1);

  //���[�v�֐���p����/explode��<>����菜���A$hairetsu�̒��g�̂��ꂼ��̒l���擾�B

  foreach($chat as $value){



	$pieces = explode("<>", $value);
		if(!empty($pieces[1])){

	  	$finaldata = $pieces[0] ." " .$pieces[1] ." " .$pieces[2] ." " .$pieces[3];
  		echo $finaldata ."<br>";//$pieces�����ׂĕ\��
		}


  }

}
?>
