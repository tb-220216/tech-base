<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_5-1</title>
</head>
<body>

<?php
	// DB接続設定
	$dsn = 'データベース名';
	$user = 'ユーザー名';
	$password = 'パスワード';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
	
	//DBテーブルを作成
	$sql = "CREATE TABLE IF NOT EXISTS mission5"
	." ("
	. "id INT AUTO_INCREMENT PRIMARY KEY,"
	. "name char(32),"
	. "comment TEXT,"
	. "password char(8),"
	. "date DATETIME"
	.");";
	$stmt = $pdo->query($sql);
	
	//DBテーブルにデータレコードを記入する
	//新規投稿
	if($_POST["name"]!=NULL && $_POST["comment"]!=NULL && $_POST["password"]!=NULL){
    if($_POST["editnumber"]==NULL){
	$sql = $pdo -> prepare("INSERT INTO mission5 (name, comment, password, date) 
	VALUES (:name, :comment, :password, :date)");
	$sql -> bindParam(':name', $name, PDO::PARAM_STR);
	$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
	$sql -> bindParam(':password', $password, PDO::PARAM_STR);
	$sql -> bindParam(':date', $date, PDO::PARAM_STR);
	$name = $_POST["name"];
	$comment = $_POST["comment"]; 
	$date=date("Y/m/d H:i:s");
    $password=$_POST["password"];
	$sql -> execute();
}else{
    $id = $_POST["editnumber"]; //変更する投稿番号
    $name = $_POST["name"];
	$comment = $_POST["comment"]; 
	$date=date("Y/m/d H:i:s");
    $password=$_POST["password"];
	$sql = 'UPDATE mission5 SET name=:name,comment=:comment,password=:password,date=:date WHERE id=:id';
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':name', $name, PDO::PARAM_STR);
	$stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
	$stmt->bindParam(':password', $password, PDO::PARAM_STR);
	$stmt->bindParam(':date', $date, PDO::PARAM_STR);
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();
        }
	}

    //削除機能
    if($_POST["delete"]!==NULL && $_POST["delpass"]!==NULL){
    $id = $_POST["delete"];
    $sql = 'SELECT * FROM mission5';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
    foreach($results as $row){
    if($id==$row['id'] && $_POST["delpass"]==$row['password']){
	$sql = 'delete from mission5 where id=:id';
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();
        }
    }
}

    //編集機能
    if($_POST["edit"]!=NULL && $_POST["editpass"]!=NULL){
    $id = $_POST["edit"]; //変更する投稿番号
    $sql = 'SELECT * FROM mission5';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
    foreach($results as $row){
        if($_POST["edit"]==$row['id'] && $_POST["editpass"]==$row['password']){
            $editname=$row['name'];
            $editcomment=$row['comment'];
                }
            }
    echo "投稿番号".$id."を編集する。";
    }


//データレコードの抽出・表示
	$sql = 'SELECT * FROM mission5';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
		//$rowの中にはテーブルのカラム名が入る
		echo $row['id'].',';
		echo $row['name'].',';
		echo $row['comment'].',';
		echo $row['password'].',';
		echo $row['date'].'<br>';
	    echo "<hr>";
	}

	
?>
    
<form action=""method="post">
    【好きなバンドについて語り合おう】<br>
    ◎投稿フォーム <br>
        <input type="text" name="name" placeholder="名前" value="<?php echo $editname ?>">
        <input type="text" name="comment" placeholder="コメント" value="<?php echo $editcomment ?>">
        <input type="text" name="password" placeholder="パスワード">
        <input type="number" name="editnumber" placeholder="編集番号" value="<?php echo $_POST["edit"] ?>">      
        <input type="submit" name="submit">
    </form>
    <form action=""method="post">
    ◎削除フォーム<br>
        <input type="number" name="delete" placeholder="削除対象番号">
        <input type="text" name="delpass" placeholder="パスワード">
        <input type="submit" name="submit">
    </form>
    <form action=""method="post">
    ◎編集フォーム<br>
        <input type="number" name="edit" placeholder="編集対象番号">
        <input type="text" name="editpass" placeholder="パスワード">
        <input type="submit" name="submit">
 </form>
   

</body>
</html>