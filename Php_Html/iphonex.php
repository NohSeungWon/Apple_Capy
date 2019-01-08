<?php
// mysql  로그인
// $product = $_GET['product'];
$conn = mysqli_connect(
  'localhost',
  'root',
  'password',
  'product');
$sql = "SELECT * FROM new_product where name='{$_GET['product']}'"; // table 정보 담기
$result = mysqli_query($conn, $sql);
$row= mysqli_fetch_array($result);
?>

 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" href="/css/iPhonex.css">
     <title>iPhone</title>
   </head>
   <body>
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
           'password',
           'choice');
       }
      ?>
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

     <div class="main-banner">
       <ul>
         <li class="main_product_name"><a href="#"><?php echo $row['name']; ?></a></li>
         <li class="main_product_text"><a href="#"><?php echo $row['description']; ?></a></li>
       </ul>
     </div>
     <div class="main_product">
       <img src="<?php echo $row['url']; ?>" width="100%">
     </div>
     <div class="main_introduce">
       <ul>
         <li><strong>두 가지 크기로 만나는 Super Retina. 그중 한 대에는 iPhone 사상</strong></li>
         <li><strong>가장 거대한 디스플레이가 탑재되었죠. 여기에 더욱 빨라진 Face ID</strong></li>
         <li><strong>스마트폰 사상 가장 스마트하고 강력한 칩 ,혁신적인 듀얼카메라</strong></li>
         <li><strong>시스템까지. 당신이 사랑하는 iPhone의 모든 장점 극대화 시킨 모습</strong></li>
         <li><strong>바로 iPhone Xs 입니다.</strong></li>
         <p class="main_introduce_small"><strong>출시일은 추후 공개됩니다.</strong></p>
       </ul>
     </div>
     <div class="img_section">
        <ul>
          <li><strong>iPhone의 새로운 시대</strong></li>
        </ul>
     </div>
     <div class="desc">
       <img src="/img/iphonexs_desc.png" width="100%">
     </div>

   </body>
 </html>
