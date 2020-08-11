<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_1-21</title>
</head>
<body>
    <form action=""method"="post">
      <imput type="number"name="num"placeholder="数字を入力してください">
      <imput type="submit"name="submit">
    </foem>
    <?php
      $num=$_POST["num"];
      if($num%3==0&&$num%5==0){
          echo"FizzBuzz<be>";
      }elseif($num%3==0){
          echo"Fizz<be>";
      }elseif($num%5==0){
          echo"Buzz<br>";
      }else{
          echo$num."<br>";
      }
    ?>
</body>
</html>