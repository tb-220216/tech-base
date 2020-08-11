<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_1-27</title>
</head>
<body>
    <form action="" method="post">
        <input type="number" name="num" placeholder="数字を入力してください">
        <input type="submit" name="submit">
    </form>
    
    <?php
        if($_POST["num"]!=NULL){
           $num = $_POST["num"] . PHP_EOL;
        }
        $filename="mission_1-27.txt";
        $fp = fopen($filename, "a");
        fwrite($fp,$num);
        fclose($fp);
        echo"書き込み成功!";
        
        if(file_exists($filename)){
            $nums = file($filename,FILE_IGNORE_NEW_LINES);
            foreach($nums as $num){
            if ($num % 3 == 0 && $num % 5 == 0) {
            echo "FizzBuzz<br>";
        } elseif ($num % 3 == 0) {
            echo "Fizz<br>";
        } elseif ($num % 5 == 0) {
            echo "Buzz<br>";
        } else {
            echo $num . "<br>";}
        }
        }
    ?>