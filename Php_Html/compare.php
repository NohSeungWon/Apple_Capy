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
<?php
// mysql  로그인
// $product = $_GET['product'];
$conn = mysqli_connect(
  'localhost',
  'root',
  'password',
  'product');
$sql = "SELECT * FROM compare"; // table 정보 담기
$result = mysqli_query($conn, $sql);
$row= mysqli_fetch_array($result);


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/compare.css">
    <title>iPhone</title>
  </head>
  <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>

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
      <div class="compare_intro">
        <h2>iPhone 모델 비교하기</h2>
        <h3>모델을 변경하려면 드롭다운 메뉴를 사용하세요</h3>
      </div>
    </div>

    <script type="text/javascript">
    function compare_section_a()
    {
        var t = $("#compare_section_a option:selected").val();
        // alert (t);
        $.ajax({
            url:'compare_check.php',
            type:'post',
            data:{param:t, check:1},
            success:function(data){
              if (data==0)
              {
                $('#compare_product_a').attr("src","/img/"+t+".jpg");
                $('#compare_a').attr("src","/img/"+t+"_a.jpg");
                $('#compare2_a').attr("src","/img/"+t+"_b.jpg");
                // alert (t);
              }
              // else
              // {
              //   // $('#dd').append("노노");
              //   $('#idw').append("t");
              //   // $('#id').css("background-color", "rgb(54, 126, 104)");
              // }
            }
        })
    }
    function compare_section_b()
    {
      var t = $("#compare_section_b option:selected").val();
      $.ajax({
          url:'compare_check.php',
          type:'post',
          data:{param:t, check:1},
          success:function(data){
            if (data==0)
            {
              $('#compare_product_b').attr("src","/img/"+t+".jpg");
              $('#compare_b').attr("src","/img/"+t+"_a.jpg");
              $('#compare2_b').attr("src","/img/"+t+"_b.jpg");
            }
          }
      })
    }
    function compare_section_c()
    {
      var t = $("#compare_section_c option:selected").val();
      $.ajax({
          url:'compare_check.php',
          type:'post',
          data:{param:t, check:1},
          success:function(data){
            if (data==0)
            {
              $('#compare_product_c').attr("src","/img/"+t+".jpg");
              $('#compare_c').attr("src","/img/"+t+"_a.jpg");
              $('#compare2_c').attr("src","/img/"+t+"_b.jpg");
            }
          }
      })
    }
    // 상단 고정 스크립트
    $( document ).ready( function() {
        var jbOffset = $( '.compare_section' ).offset();
        $( window ).scroll( function() {
          if ( $( document ).scrollTop() > jbOffset.top ) {
            $( '.compare_section' ).addClass( 'compare_section_fixed' );
          }
          else {
            $( '.compare_section' ).removeClass( 'compare_section_fixed' );
          }
        });
      } );


      // 장바구니로 보내기
      function choice_a()
      {
        var t = $("#compare_section_a option:selected").text();
        $.ajax({
            url:'choice.php',
            type:'post',
            data:{param:t, check:1},
            success:function(data)
            {
              alert("장바구니에 추가되었습니다.")
            }
        })
      }
      function choice_b()
      {
        var t = $("#compare_section_b option:selected").text();
        $.ajax({
            url:'choice.php',
            type:'post',
            data:{param:t, check:1},
            success:function(data)
            {
              alert("장바구니에 추가되었습니다.")
            }
        })
      }
      function choice_c()
      {
        var t = $("#compare_section_c option:selected").text();
        $.ajax({
            url:'choice.php',
            type:'post',
            data:{param:t, check:1},
            success:function(data)
            {
              alert("장바구니에 추가되었습니다.")
            }
        })
      }

      function popup()
      {
          window.alert('로그인이 필요합니다.');
      }

    </script>

    <div class="compare_section" id="compare_section">
      <div class="compare_section_a">
        <select class="" id="compare_section_a" oninput="compare_section_a()">
          <option id="i_xr_a" value="compare_iphonexr">iPhone XR</option>
          <option id="i_8_a" value="compare_iphone8">iPhone 8</option>
          <option id="i_8_plus_a" value="compare_iphone8plus">iPhone 8 plus</option>
          <option id="i_7_a" value="compare_iphone7">iPhone 7</option>
          <option id="i_plus_a" value="compare_iphone7plus">iPhone 7 plus</option>
        </select>
        <?php
        if (!isset($_SESSION['id']))
        {
          // 로그인이 안되어있을 떄 로그인, 회원가입을 띄우기
          echo '<button type="button" name="button" onclick="popup()">담기</button>';
        }
        else
        {
          echo '<button type="button" name="button" onclick="choice_a()">담기</button>';
        }
         ?>
      </div>
      <div class="compare_section_b">
        <select class="" id="compare_section_b" name="" oninput="compare_section_b()">
          <option id="i_8_c" value="compare_iphone8">iPhone 8</option>
          <option id="i_7_c" value="compare_iphone7">iPhone 7</option>
          <option id="i_8_plus_c" value="compare_iphone8plus">iPhone 8 plus</option>
          <option id="i_plus_c" value="compare_iphone7plus">iPhone 7 plus</option>
          <option id="i_xr_c" value="compare_iphonexr">iPhone XR</option>
        </select>
        <?php
        if (!isset($_SESSION['id']))
        {
          // 로그인이 안되어있을 떄 로그인, 회원가입을 띄우기
          echo '<button type="button" name="button" onclick="popup()">담기</button>';
        }
        else
        {
          echo '<button type="button" name="button" onclick="choice_b()">담기</button>';
        }
        ?>
      </div>
      <div class="compare_section_c">
        <select class="" name="" id="compare_section_c" oninput="compare_section_c()">
          <option id="i_7_c" value="compare_iphone7">iPhone 7</option>
          <option id="i_8_c" value="compare_iphone8">iPhone 8</option>
          <option id="i_8_plus_c" value="compare_iphone8plus">iPhone 8 plus</option>
          <option id="i_plus_c" value="compare_iphone7plus">iPhone 7 plus</option>
          <option id="i_xr_c" value="compare_iphonexr">iPhone XR</option>
        </select>
        <?php
        if (!isset($_SESSION['id']))
        {
          // 로그인이 안되어있을 떄 로그인, 회원가입을 띄우기
          echo '<button type="button" name="button" onclick="popup()">담기</button>';
        }
        else
        {
          echo '<button type="button" name="button" onclick="choice_c()">담기</button>';
        }
        ?>
      </div>
    </div>
    <div class="compare_product">
      <div class="compare_product_a">
          <img id ="compare_product_a"class="iphonexs"src="/img/compare_iphonexr.jpg" width="100%">
      </div>
      <div class="compare_product_b">
        <img id ="compare_product_b"class="iphonexs"src="/img/compare_iphone8.jpg" width="100%">
    </div>
      <div class="compare_product_c">
        <img id ="compare_product_c"class="iphonexs"src="/img/compare_iphone7.jpg" width="100%">
    </div>
    </div>
    <!--  사진 a 부분 -->
    <div class="compare_product">
      <div class="compare_product_a">
          <img id ="compare_a"class="iphonexs"src="/img/compare_iphonexr_a.jpg" width="100%">
      </div>
      <div class="compare_product_b">
        <img id ="compare_b"class="iphonexs"src="/img/compare_iphone8_a.jpg" width="100%">
    </div>
      <div class="compare_product_c">
        <img id ="compare_c"class="iphonexs"src="/img/compare_iphone7_a.jpg" width="100%" height="85%">
    </div>
    </div>
    <div class="display">
      <p>디스플레이</p>
    </div>
    <!--사진 b 부분  -->
    <div class="compare_c">
      <div class="compare_c_a">
          <img id ="compare2_a"class="iphonexs"src="/img/compare_iphonexr_b.jpg" width="100%">
      </div>
      <div class="compare_c_b">
        <img id ="compare2_b"class="iphonexs"src="/img/compare_iphone8_b.jpg" width="100%">
    </div>
      <div class="compare_c_c">
        <img id ="compare2_c"class="iphonexs"src="/img/compare_iphone7_b.jpg" width="100%">
    </div>
    </div>
  </body>
</html>
