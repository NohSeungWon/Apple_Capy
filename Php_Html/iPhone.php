
<?php
  session_start();
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
      'pirlo',
      'choice');
  }
 ?>
<!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" href="/css/iphone.css">
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
               <li><a href="choice.php">장바구니</li>
                 <li><?php echo $value; ?></li>
                 <li><?php echo $value3; ?></li>
                 <li><?php echo $value2; ?></li>
             </ul>
         </li>
       </ul>
     </header>
    <div class="products">
      <ul>
        <form action="iphonex.php" method="get" id="iphonex">
            <input type="hidden" name="product" value="iPhone X S">
            <li><a href="#" onclick="document.getElementById('iphonex').submit();" >iPhone XS</a></li>
        </form>
        <form action="iphoneXR.php" method="get" id="iphoneXR">
            <input type="hidden" name="product" value="iPhone X R">
            <li><a href="#" onclick="document.getElementById('iphoneXR').submit();" >iPhone XR</a></li>
        </form>
        <form action="iphone8.php" method="get" id="iphone7">
            <input type="hidden" name="product" value="iPhone 8">
            <li><a href="#" onclick="document.getElementById('iphone7').submit();" >iPhone 8</a></li>
        </form>
        <form action="iphone8.php" method="get" id="iphone8">
            <input type="hidden" name="product" value="iPhone 7">
            <li><a href="#" onclick="document.getElementById('iphone8').submit();" >iPhone 7</a></li>
        </form>
        <form action="compare.php" method="get" id="compare">
            <input type="hidden" name="product" value="">
            <li><a href="#" onclick="document.getElementById('compare').submit();" >비교하기</a></li>
        </form>
      </ul>
    </div>
    <h1>세상의 모든 iPhone을 경험하세요</h1>

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

    <div class="i8-banner">
      <ul>
        <li class="sub_product_name"><a href="#">iPhone 8</a></li>
        <li class="sub_product_text"><a href="#">아이폰이 없다는 건</a></li>
      </ul>
    </div>

    <div class="i8_product">
      <img src=https://store.storeimages.cdn-apple.com/8755/as-images.apple.com/is/image/AppleInc/aos/published/images/i/ph/iphone8/gallery1/iphone8-gallery1-2017?wid=2000&hei=1536&fmt=jpeg&qlt=95&op_usm=0.5,0.5&.v=1506703285757 width="100%" height="100%">
    </div>

    <div class="i7-banner">
      <ul>
        <li class="sub_product_name"><a href="#">iPhone 7</a></li>
        <li class="sub_product_text"><a href="#">세상에 없던 색상</a></li>
      </ul>
    </div>

    <div class="i7_product">
      <img src=https://store.storeimages.cdn-apple.com/8755/as-images.apple.com/is/image/AppleInc/aos/published/images/i/ph/iphone7/gallery2/iphone7-gallery2-2016?wid=835&hei=641&fmt=jpeg&qlt=95&op_usm=0.5,0.5&.v=1473877132504 width="100%" height="100%">
    </div>

  </body>
</html>
