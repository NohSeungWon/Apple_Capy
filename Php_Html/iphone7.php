 <?php
// // mysql  로그인
// // $product = $_GET['product'];
// $conn = mysqli_connect(
//   'localhost',
//   'root',
//   'password',
//   'product');
// $sql = "SELECT * FROM products where name='{$_GET['product']}'"; // table 정보 담기
// $result = mysqli_query($conn, $sql);
// $row= mysqli_fetch_array($result);
?>

 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" href="/css/iPhonex.css">
     <title>iPhone</title>
   </head>
   <body>

     <header>
       <header>
         <ul class="top-navi">
           <li class="home"><a href="apple.php"><img src="/img/apple.png"></li>
           <li><a href="#">Mac</li>
           <li><a href="#">iPad</li>
           <li><a href="iPhone.php">iPhone</li>
           <li><a href="#">Watch</li>
           <li><a href="board.php">게시판</li>
           <li><a href="#">고객지원</li>
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
         <form action="iphonex.php" method="get" id="iphonex">
             <input type="hidden" name="product" value="iPhone X S">
             <li><a href="#" onclick="document.getElementById('iphonex').submit();" >iPhone XS</a></li>
         </form>
         <form action="iphoneXR.php" method="get" id="iphoneXR">
             <input type="hidden" name="product" value="iPhone X R">
             <li><a href="#" onclick="document.getElementById('iphoneXR').submit();" >iPhone XR</a></li>
         </form>
         <form action="iphone7.php" method="get" id="iphone7">
             <input type="hidden" name="product" value="iPhone 8">
             <li><a href="#" onclick="document.getElementById('iphone7').submit();" >iPhone 8</a></li>
         </form>
         <form action="iphone8.php" method="post" id="iphone8">
             <input type="hidden" name="product" value="iPhone 7">
             <li><a href="#" onclick="document.getElementById('iphone8').submit();" >iPhone 7</a></li>
         </form>
         <form action="compare.php" method="get" id="compare">
             <input type="hidden" name="product" value="">
             <li><a href="#" onclick="document.getElementById('compare').submit();" >비교하기</a></li>
         </form>
       </ul>
     </div>

     <div class="d">
       <ul>
          <li><?php echo $row['name']; ?></li>
          <li><?php echo $row['description']; ?></li>
       </ul>
     </div>


   </body>
 </html>
