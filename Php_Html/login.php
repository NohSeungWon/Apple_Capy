<?php
// echo $_SESSION['id'];
// echo $_POST['id'];
 if(isset($_POST['id']))
   {
     session_start();
     $id = $_POST['id'];
     $pw = $_POST['pw'];
     include 'dbconnect.php';
     $sql = " select * from userinfo where id ='{$_POST['id']}' and pw='{$_POST['pw']}'";
     $result = mysqli_query($conn, $sql);
     $row = mysqli_fetch_array($result);

     if($id==$row['id'] && $pw==$row['pw'])
      { // id와 pw가 맞다면 login
       $_SESSION['id']=$row['id'];
       $_SESSION['pw']=$row['pw'];
       if (isset($_POST['auto'])) {
         setcookie('user_id',$_SESSION['id'],time()+60,"/");
       }
       // setcookie('user_id',$_SESSION['id'],time()+60,"/");
       echo "<script>window.alert('로그인 성공.');</script>"; // 잘못된 아이디 또는 비빌번호 입니다
       echo "<script>location.href='apple.php';</script>";
      }
  else
    { // id 또는 pw가 다르다면 login 폼으로
       echo "<script>window.alert('아이디 혹은 패스워드가 일치하지 않습니다.');</script>"; // 잘못된 아이디 또는 비빌번호 입니다
       echo "<script>location.href='login.php';</script>";
    }
  }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/login.css">
    <title>iPhone</title>
  </head>
  <body>
    <header>
      <ul class="top-navi">
        <li class="home"><a href="apple.php"><img src="/img/apple.png"></li>
        <li><a href="#">Mac</li>
        <li><a href="#">iPad</li>
        <li><a href="iPhone.php">iPhone</li>
        <li><a href="#">Watch</li>
        <li><a href="board.php">게시판</li>
        <li><a href="support.php">고객지원</li>
        <li class="roll">
          <a href=""><img src="/img/basket.png">
            <ul>
              <li><a href="#">장바구니</li>
              <li><a href="user_add.php">회원가입</li>
              <li><a href="login.php">로그인</li>
            </ul>
        </li>
      </ul>
    </header>
    <div class="products">
      <ul>
        <li><a href="#"= > </a></li>
      </ul>
    </div>
      <p class="back"></p>
      <h1>로그인 하십시오</h1>

      <div class="login_section">
        <div class="input">
          <p>Apple Store 로그인</p>
          <form class="login" method="post">
            <input class="login_id" type="text" name="id" value="" placeholder="Id">
            <input class="login_pw" type="password" name="pw" value="" placeholder="Pw">
            <li><input type="checkbox" name="auto" value="123"> 자동로그인(1주일) </li>
            <button type="submit" name="button">로그인</button>
          </form>
        </div>
        <div class="come_in">
            <p>다음과 같은 Apple 서비스를 위해 Apple ID를 사용할 수 있습니다.</p>
            <ul>
              <li>App Store</li>
              <li>iTunes</li>
              <li>Gamsung</li>
              <li>no breakdown</li>
            </ul>
            <a href="user_add.php">ID가 없으신가요? 지금 생성</a>
        </div>
      </div>
  </body>
</html>
