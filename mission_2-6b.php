<?php

    //�f�[�^�x�[�X�ւ̐ڑ�
  $dsn = 'mysql:dbname= co_991_it_3919_c ;host=localhost';
  $user = 'co-991.it.3919.c';
  $password = 'Kmi8sQ';
  
  try{
  $pdo = new PDO($dsn,$user,$password);
  $pdo = nu11;
  }
  
  catch(PDOexception $e){
  print('�G���[���������܂���:'.$e->getMessage());
  die();
  }


?>

<html>

<head>
<title> �f�����vol.6b
</title>

</head>

<body>

<?php
  $filename = 'mission_2-6b.txt';  //�e�L�X�g��ϐ��ɑ��

  $name = $_POST['name'];  //���M���e���󂯎��
  $free = $_POST['free'];
  $date = date("y/m/d h:i:s");  //����
  $del = $_POST['del'];  //�폜�{�^���̔ԍ�
  $edit = $_POST['edit'];  //�ҏW�{�^���̔ԍ�
  
  if(file_exists($filename)){  //�t�@�C���̑��݂��m�F
  
     $cnt = count(file($filename));     //�t�@�C��������Ƃ��A���e�ԍ� 1�s������+1
     $i = $cnt +1; 
     }else{     //�Ȃ��Ƃ�$i��1����
     $i = 1;
  }


  if(isset($_POST['Sendbtn'])){  //���M�{�^���������ꂽ�Ƃ��ǋL
        $pass = $_POST['pass'];	//�p�X���[�h���擾
  	//�e�L�X�g�t�@�C���ɒǋL�ۑ�t
  	$fp = fopen($filename,"a");   
  	fwrite($fp, $i."<>".$name."<>" . $free."<>".$date."<>".$pass."<>"."\n");
  	fclose($fp);
  }
  	//�폜�{�^���������ꂽ�Ƃ�
  	
  	
  if(isset($_POST['Delbtn'])){
	$del_pass = $_POST['del_pass'];	//�폜�t�H�[���̃p�X���[�h�擾
	//$pass = $_POST['pass'];	//���e�t�H�[���̃p�X���[�h���擾*/
  			
  		$filedata = file($filename);	//�e�L�X�g�t�@�C������1�s���z��Ƃ��ēǂݍ��݁A�ϐ��ɑ��
  		$fp = fopen($filename, 'w+');	//�������݃��[�h
  		
  		foreach($filedata as $line){	//�z��̐��������[�v
  			$data = explode('<>',$line);	//explode�œ��e�ԍ����擾
  			/*
  			 [0] ���e�ԍ�
  		 	 [1] ���O
  			 [2] �R�����g
  			 [3] ����
  			 [4] �p�X���[�h
  		  		*/
  			//var_dump($data);
  			//echo "<br>";
  			
  		  	if(($data[0] == $del) and ($data[4] == $del_pass)){	//�p�X���[�h����v�����ꍇ�̂�
				//echo "check1|".$data[0]."|".$del."|<hr>"; //���e�ԍ��ƍ폜�ԍ��A�폜�p�X���[�h�Ɠ��e�p�X���[�h����v������A�폜
				//echo "check2|".$data[4]."|".$del_pass."|<hr>"; //
				
				fwrite($fp,$data[0]." "."�폜���܂���\n");
			
			} else {
				fputs($fp,$line); //��v���Ă��Ȃ����͕̂\��
		//		echo "check3|".$line."|<hr>";
				
			/*
 				//�e�L�X�g�t�@�C���ɕۑ�����Ă������e�ԍ��Ƒ��M���ꂽ�ԍ����r
				if($data[0]!=$del){	//�C�R�[���łȂ��Ƃ������㏑���ۑ�
				echo "check3|".$data[0]."|".$del."|<hr>";
				
					fputs($fp,$line);
					echo "check4|".$line."|<hr>";
				}//if*/
			}//if
		}//foreach
		fclose($fp);
  }//if

	//�ҏW�{�^���������ꂽ�ꍇ
	 if(isset($_POST['Editbtn'])) {	//�e�L�X�g�t�@�C������1�s���z��Ƃ��ēǂݍ��݁A�ϐ��ɑ��
	 
	 	$edit_pass = $_POST['edit_pass'];	//�ҏW�t�H�[���̃p�X���[�h�擾
  		$edit=$_POST['edit'];
  		$filedata = file($filename);	//�t�@�C����1�s���̔z��ɂ��ĕϐ��ɑ��
  		$fp = fopen($filename, 'r');	//�t�@�C�����J��
  		foreach($filedata as $line){	//�z��̐��������[�v
  		
  			$data = explode('<>',$line);	//explode�œ��e�ԍ����擾
  			
  			if(($data[0] == $edit) and ($data[4] == $edit_pass)){	//���e�ԍ��ƕҏW�ԍ��A���e�p�X���[�h�ƕҏW�p�X���[�h����v������
  			//	echo "check1|".$data[0]."|".$edit."|check2|".$data[4]."|".$edit_pass."|<hr>";
  			
  				$edit_num = $data[0]; //��M�������e��ϐ��ɑ�� [0]���e�ԍ�
				$user = $data[1]; //[1]���O
				$text = $data[2]; //[2]�R�����g
				//var_dump($edit_num."<>".$user."<>".$text);
				//echo "<br>";

  			
  			}//if
  			
			//�e�L�X�g�t�@�C���ɕۑ�����Ă������e�ԍ��Ƒ��M���ꂽ�ԍ����r
		/*	if($data[0] ==$edit){ //�C�R�[���̎��̔z����擾
			
				$edit_num = $data[0]; //��M�������e��ϐ��ɑ�� [0]���e�ԍ�
				$user = $data[1]; //[1]���O
				$text = $data[2]; //[2]�R�����g
				//var_dump($edit_num."<>".$user."<>".$text);
				//echo "<br>";
			}//if��*/
        	}//foreach��
  		fclose($fp);	//�t�@�C�������
  		
	}


	if(isset($_POST['Overwrite'])){	//�㏑���{�^������������
	
  		$edit_num =$_POST['edit_num'];
  		$user = $_POST['user'];
  		$text = $_POST['text'];
  		
  		
  		$filedata = file($filename);	//�t�@�C����1�s���̔z��ɂ��ĕϐ��ɑ��
  		$fp = fopen($filename,'w+');	//�㏑�����[�h�Ńt�@�C�����J��
  		foreach($filedata as $line){	//�z�񂩂������o��
  			$data = explode('<>',$line);	//�ϐ��ɁA��؂育�Ɣz��ɂ��đ��
			//echo "check_if1|".$data[0]."|".$edit_num."|".$edit."|<hr>";	//�f�o�b�O�̈�
		
  			if($data[0] == $edit_num){	//$data[0](���e�ԍ�)��$edit_num(�ҏW�ԍ�)�������Ȃ�
  				$hensyu =$edit_num[0]."<>".$user."<>".$text."<>".$date."<>".$data[4]."<>"."\n";	//�ϐ��ɓ��e����
  				fputs($fp,$hensyu);	//�ҏW����1�s���t�@�C���ɒǋL
				//echo "check_if2|".$edit_num[0]."<>".$user."<>".$text."<>".$date."|<hr>";	//�f�o�b�O�̈�
  			}else{	//��v���Ȃ��Ƃ�
  					
  				fputs($fp,$line);	//����1�s���t�@�C���ɒǋL
				//echo "check_if3|".$line."|<hr>";	//�f�o�b�O�̈�

  			}//else
  		}//foreach
 		fclose($fp);	//�t�@�C�������
  	}//if


?>

  
  <h1> �f�����vol.6b </h1>

      <!-���̓t�H�[�� ->
  <form action ="mission_2-6b.php" method ="POST">
  <p>����</p>
  <p><input name = "name" type = "text" ></p>
  <p>�R�����g</p>
  <p><textarea name ="free" cols="50" rows="5" ></textarea></p>
  �p�X���[�h:<input type="password" name="pass" >
  <input type = "submit" name="Sendbtn" value = "���M">
  <hr>
  
  <p>�폜�Ώ۔ԍ�:
  <input type = "text" name= "del" size ="1"> 
  <p>�p�X���[�h:<input type="password" name="del_pass"></p>
  <input type = "submit" name="Delbtn" value = "�폜"></p>
  <hr>
  
  <p>�ҏW�Ώ۔ԍ�:
  <input type = "text" name= "edit" size = "1">
  <p>�p�X���[�h:<input type="password" name="edit_pass"></p>
  <input type = "submit" name="Editbtn" value = "�ҏW"></p>
  </form>

  <form action = "mission_2-6b.php" method = "post">
  <input name = "edit_num" type = "hidden" value = "<?php echo $edit_num;?>" /><br>
  <input name = "user" type = "text" value = "<?php echo $user;?>" />
  <input name = "text" type = "text" value ="<?php echo $text;?>" />
  <button type = "submit" name ="Overwrite">�㏑��</button> 
  <hr>
  </form>


</body>
<?php



  
    //�t�@�C����z��ɂ��āA1�s���ǂݍ���
  $lines = file($filename);

  //���̓t�H�[�����ɕ\��
  foreach($lines as $lines){
     //�z��𕪊�
     $aa = explode('<>',$lines);
     
     echo $aa[0]." "; //���e�ԍ�
     echo $aa[1]." "; //���O
     echo $aa[2]." "; //�R�����g
     echo $aa[3]." "."<br>"; //����
     //echo $aa[4]." "."<br>"; //�p�X���[�h
}






?>

</html>