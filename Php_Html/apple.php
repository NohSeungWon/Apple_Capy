<?php
  session_start();
// echo $_COOKIE['user_id'];
// echo $_SESSION['id'];
if (!isset($_COOKIE['user_id'])&&!isset($_SESSION['id']))
{
  // 로그인이 안되어있을 떄 로그인, 회원가입을 띄우기
  $value= "<a href=\"user_add.php\">회원가입";
  $value2="<a href=\"login.php\">로그인";
  $value3="<a href=\"post.php\">배송조회";
}
else
{
  // 로그인이 되어있으면 마이페이지와, 로그아웃 띄우기
  $value= "<a href=\"mypage.php\">마이페이지";
  $value2= "<a href=\"logout.php\">로그아웃";
  $value3="<a href=\"post.php\">배송조회";
  $conn = mysqli_connect(
    'localhost',
    'root',
    'password',
    'choice');
}
 ?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/apple.css">
    <title>Won_apple</title>
  </head>
  <body>
    <header>
      <ul class="top-navi">
        <li class="home"><a href="apple.php"><img src="/img/apple.png"></li>
        <li><a href="logout.php">Mac</li>
        <li><a href="#">iPad</li>
        <li><a href="iPhone.php">iPhone</li>
        <li><a href="#">Watch</li>
        <li><a href="board.php">게시판</li>
        <li><a href="support.php">고객지원</li>
        <li class="roll">
          <a href=""><img src="/img/basket.png">
            <ul>
              <li><a href="choice.php">장바구니</li>
                <li><?php echo $value; ?></li>
                <li><?php echo $value3; ?></li>
                <li><?php echo $value2; ?></li>
            </ul>
        </li>
      </ul>
    </header>

    <div class="main-banner">
      <ul>
        <li class="main_product_name"><a href="#">iPhone X S</a></li>
        <li class="main_product_text"><a href="#">보다 큰 세상으로의 초대</a></li>
      </ul>
    </div>

    <div class="main_product">
      <img src=https://www.apple.com/v/home/dx/images/heroes/iphone-xs/iphone_xs_large.jpg width="100%" height="100%">
    </div>

    <div class="sub-banner">
      <ul>
        <li class="sub_product_name"><a href="#">iPhone X R</a></li>
        <li class="sub_product_text"><a href="#">모든 면에서 찬란한</a></li>
      </ul>
    </div>

    <div class="sub_product">
      <img src=https://www.apple.com/v/home/dx/images/heroes/iphone-xr/iphone_xr_large.jpg width="100%" height="100%">
    </div>

  </body>
</html>
