<?php
// mysql  로그인
// $product = $_GET['product'];
$conn = mysqli_connect(
  'localhost',
  'root',
  'password',
  'product');
$sql = "SELECT * FROM product where title='{$_GET['product']}'"; // table 정보 담기
$result = mysqli_query($conn, $sql);
$row= mysqli_fetch_array($result);
?>
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

 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" href="/css/8.css">
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
    <h1><?php echo $row['title']; ?></h1>
    <h2><?php echo $row['choice']; ?></h2>
    <div class="show_product">
        <ul class="small">
          <li><?php echo $row['small_name']; ?></li>
          <li><?php echo $row['big_display']; ?></li>
          <li><?php echo $row['small_price']; ?></li>
          <button type="button" name="선택">선택</button>
        </ul>
      <img src="<?php echo $row['small_url']; ?>" height="250px">
      <img src="<?php echo $row['big_uri']; ?>" height="350px" >
        <ul class="big">
          <li><?php echo $row['big_name']; ?></li>
          <li><?php echo $row['small_display']; ?></li>
          <li><?php echo $row['big_price']; ?></li>
          <button type="button" name="선택">선택</button>
        </ul>
    </div>
    <div class="components">
      <img class="components"src="/img/components.png" alt="">
    </div>

   </body>
 </html>
