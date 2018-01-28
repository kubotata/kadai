<?php

    //データベースへの接続
  $dsn = 'mysql:dbname= co_991_it_3919_c ;host=localhost';
  $user = 'co-991.it.3919.c';
  $password = 'Kmi8sQ';
  
  try{
  $pdo = new PDO($dsn,$user,$password);
  $pdo = nu11;
  }
  
  catch(PDOexception $e){
  print('エラーが発生しました:'.$e->getMessage());
  die();
  }

$symt = $pdo->query('SET NAMES utf8');//文字化け対策

//mission_2-8
//SQLコマンド「CREATE TABLE」で新規テーブルを作成する。
$sql = "CREATE TABLE tbtest"
."("
."id INT"
."name char(32)"
."comment TEXT"
.");";
$stmt = $pdo->query($sql);

//mission_2-9
$sql = 'SHOW TABLES';
$result = $pdo-> query($sql);
foreach($result as $row){
	echo $row[0];
	echo'<br>';
}
echo '<br>';
?>

//mission_2-10



<html>

<head>
<title> 掲示板作りvol.6b
</title>

</head>

<body>

<?php
  $filename = 'mission_2-6b.txt';  //テキストを変数に代入

  $name = $_POST['name'];  //送信内容を受け取る
  $free = $_POST['free'];
  $date = date("y/m/d h:i:s");  //時間
  $del = $_POST['del'];  //削除ボタンの番号
  $edit = $_POST['edit'];  //編集ボタンの番号
  
  if(file_exists($filename)){  //ファイルの存在を確認
  
     $cnt = count(file($filename));     //ファイルがあるとき、投稿番号 1行おきに+1
     $i = $cnt +1; 
     }else{     //ないとき$iに1を代入
     $i = 1;
  }


  if(isset($_POST['Sendbtn'])){  //送信ボタンが押されたとき追記
        $pass = $_POST['pass'];	//パスワードを取得
  	//テキストファイルに追記保存t
  	$fp = fopen($filename,"a");   
  	fwrite($fp, $i."<>".$name."<>" . $free."<>".$date."<>".$pass."<>"."\n");
  	fclose($fp);
  }
  	//削除ボタンが押されたとき
  	
  	
  if(isset($_POST['Delbtn'])){
	$del_pass = $_POST['del_pass'];	//削除フォームのパスワード取得
	//$pass = $_POST['pass'];	//投稿フォームのパスワードを取得*/
  			
  		$filedata = file($filename);	//テキストファイルから1行ずつ配列として読み込み、変数に代入
  		$fp = fopen($filename, 'w+');	//書き込みモード
  		
  		foreach($filedata as $line){	//配列の数だけループ
  			$data = explode('<>',$line);	//explodeで投稿番号を取得
  			/*
  			 [0] 投稿番号
  		 	 [1] 名前
  			 [2] コメント
  			 [3] 日時
  			 [4] パスワード
  		  		*/
  			//var_dump($data);
  			//echo "<br>";
  			
  		  	if(($data[0] == $del) and ($data[4] == $del_pass)){	//パスワードが一致した場合のみ
				//echo "check1|".$data[0]."|".$del."|<hr>"; //投稿番号と削除番号、削除パスワードと投稿パスワードが一致したら、削除
				//echo "check2|".$data[4]."|".$del_pass."|<hr>"; //
				
				fwrite($fp,$data[0]." "."削除しました\n");
			
			} else {
				fputs($fp,$line); //一致していないものは表示
		//		echo "check3|".$line."|<hr>";
				
			/*
 				//テキストファイルに保存されていた投稿番号と送信された番号を比較
				if($data[0]!=$del){	//イコールでないときだけ上書き保存
				echo "check3|".$data[0]."|".$del."|<hr>";
				
					fputs($fp,$line);
					echo "check4|".$line."|<hr>";
				}//if*/
			}//if
		}//foreach
		fclose($fp);
  }//if

	//編集ボタンが押された場合
	 if(isset($_POST['Editbtn'])) {	//テキストファイルから1行ずつ配列として読み込み、変数に代入
	 
	 	$edit_pass = $_POST['edit_pass'];	//編集フォームのパスワード取得
  		$edit=$_POST['edit'];
  		$filedata = file($filename);	//ファイルを1行ずつの配列にして変数に代入
  		$fp = fopen($filename, 'r');	//ファイルを開く
  		foreach($filedata as $line){	//配列の数だけループ
  		
  			$data = explode('<>',$line);	//explodeで投稿番号を取得
  			
  			if(($data[0] == $edit) and ($data[4] == $edit_pass)){	//投稿番号と編集番号、投稿パスワードと編集パスワードが一致したら
  			//	echo "check1|".$data[0]."|".$edit."|check2|".$data[4]."|".$edit_pass."|<hr>";
  			
  				$edit_num = $data[0]; //受信した内容を変数に代入 [0]投稿番号
				$user = $data[1]; //[1]名前
				$text = $data[2]; //[2]コメント
				//var_dump($edit_num."<>".$user."<>".$text);
				//echo "<br>";

  			
  			}//if
  			
			//テキストファイルに保存されていた投稿番号と送信された番号を比較
		/*	if($data[0] ==$edit){ //イコールの時の配列を取得
			
				$edit_num = $data[0]; //受信した内容を変数に代入 [0]投稿番号
				$user = $data[1]; //[1]名前
				$text = $data[2]; //[2]コメント
				//var_dump($edit_num."<>".$user."<>".$text);
				//echo "<br>";
			}//if文*/
        	}//foreach文
  		fclose($fp);	//ファイルを閉じる
  		
	}


	if(isset($_POST['Overwrite'])){	//上書きボタンを押したら
	
  		$edit_num =$_POST['edit_num'];
  		$user = $_POST['user'];
  		$text = $_POST['text'];
  		
  		
  		$filedata = file($filename);	//ファイルを1行ずつの配列にして変数に代入
  		$fp = fopen($filename,'w+');	//上書きモードでファイルを開く
  		foreach($filedata as $line){	//配列から一つずつ取り出す
  			$data = explode('<>',$line);	//変数に、区切りごと配列にして代入
			//echo "check_if1|".$data[0]."|".$edit_num."|".$edit."|<hr>";	//デバッグ領域
		
  			if($data[0] == $edit_num){	//$data[0](投稿番号)と$edit_num(編集番号)が同じなら
  				$hensyu =$edit_num[0]."<>".$user."<>".$text."<>".$date."<>".$data[4]."<>"."\n";	//変数に内容を代入
  				fputs($fp,$hensyu);	//編集した1行をファイルに追記
				//echo "check_if2|".$edit_num[0]."<>".$user."<>".$text."<>".$date."|<hr>";	//デバッグ領域
  			}else{	//一致しないとき
  					
  				fputs($fp,$line);	//元の1行をファイルに追記
				//echo "check_if3|".$line."|<hr>";	//デバッグ領域

  			}//else
  		}//foreach
 		fclose($fp);	//ファイルを閉じる
  	}//if


?>

  
  <h1> 掲示板作りvol.6b </h1>

      <!-入力フォーム ->
  <form action ="mission_2-6b.php" method ="POST">
  <p>氏名</p>
  <p><input name = "name" type = "text" ></p>
  <p>コメント</p>
  <p><textarea name ="free" cols="50" rows="5" ></textarea></p>
  パスワード:<input type="password" name="pass" >
  <input type = "submit" name="Sendbtn" value = "送信">
  <hr>
  
  <p>削除対象番号:
  <input type = "text" name= "del" size ="1"> 
  <p>パスワード:<input type="password" name="del_pass"></p>
  <input type = "submit" name="Delbtn" value = "削除"></p>
  <hr>
  
  <p>編集対象番号:
  <input type = "text" name= "edit" size = "1">
  <p>パスワード:<input type="password" name="edit_pass"></p>
  <input type = "submit" name="Editbtn" value = "編集"></p>
  </form>

  <form action = "mission_2-6b.php" method = "post">
  <input name = "edit_num" type = "hidden" value = "<?php echo $edit_num;?>" /><br>
  <input name = "user" type = "text" value = "<?php echo $user;?>" />
  <input name = "text" type = "text" value ="<?php echo $text;?>" />
  <button type = "submit" name ="Overwrite">上書き</button> 
  <hr>
  </form>


</body>
<?php



  
    //ファイルを配列にして、1行ずつ読み込む
  $lines = file($filename);

  //入力フォーム下に表示
  foreach($lines as $lines){
     //配列を分割
     $aa = explode('<>',$lines);
     
     echo $aa[0]." "; //投稿番号
     echo $aa[1]." "; //名前
     echo $aa[2]." "; //コメント
     echo $aa[3]." "."<br>"; //日時
     //echo $aa[4]." "."<br>"; //パスワード
}






?>

</html>
