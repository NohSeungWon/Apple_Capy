<?php
  session_start();
  if(isset($_POST['param']))
  {
    $conn = mysqli_connect(
      'localhost',
      'root',
      'password',
      'server file name');
      $cum=0;
      switch ($_POST['param'])
      {
        case 'iPhone XR':
          $cum=900000;
          $img='/img/compare_iphonexr.jpg';
          break;
        case 'iPhone 8':
          $cum=800000;
          $img='/img/compare_iphone8.jpg';
          break;
        case 'iPhone 8 plus':
          $cum=880000;
          $img='/img/compare_iphone8plus.jpg';
          break;
        case 'iPhone 7':
          $cum=700000;
          $img='/img/compare_iphone7.jpg';
          break;
        case 'iPhone 7 plus':
          $cum=770000;
          $img='/img/compare_iphone7plus.jpg';
          break;
      }

    $sql = "
      INSERT INTO basket
        (id, name, cum, img)
        VALUES(
          '{$_SESSION['id']}',
          '{$_POST['param']}',
          '$cum',
          '$img'
        )
    ";
    $result = mysqli_query($conn, $sql);

    if($result === false)
    {
      echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
      error_log(mysqli_error($conn));
    }
  }
?>

<?php

  if (!isset($_COOKIE['user_id'])&&!isset($_SESSION['id']))
  {
    // 로그인이 안되어있을 떄 로그인, 회원가입을 띄우기
    $value= "<a href=\"user_add.php\">회원가입";
    $value2="<a href=\"login.php\">로그인";
    $value3="<a href=\"post.php\">배송조회";
    echo "<script>window.alert('로그인이 필요한 서비스 입니다.');</script>"; // 잘못된 아이디 또는 비빌번호 입니다
    echo "<script>location.href='login.php';</script>";
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
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/choice.css">
    <title>iPhone</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js" ></script>
    <!-- iamport.payment.js -->
    <script type="text/javascript" src="https://cdn.iamport.kr/js/iamport.payment-1.1.5.js"></script>
    <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
    <script type="text/javascript">
    function compare_section_a()
    {
        var t = $("#compare_section_a option:selected").val();
        // alert (t);
        $.ajax({
            url:'choice_delete.php',
            type:'post',
            data:{param:t, check:1},
            success:function(data)
            {
              if (data==0)
              {
                $('#compare_product_a').attr("src","/img/"+t+".jpg");
                $('#compare_a').attr("src","/img/"+t+"_a.jpg");
                $('#compare2_a').attr("src","/img/"+t+"_b.jpg");
              }
            }
        })
    }
    </script>

    <script>
    IMP.init('imp84532101'); // 아임포트 관리자 페이지의 "시스템 설정" > "내 정보" 에서 확인 가능

    function pay() {
    // IMP.request_pay(param, callback) 호출
    IMP.request_pay({
      pg : 'kakaopay',
      pay_method : 'card',
      merchant_uid : 'merchant_' + new Date().getTime(),
      name : $('.name').text(),
      amount : 100,
      // $('#total_cum').val()
      buyer_email : 'iamport@siot.do',
      buyer_name : '구매자이름',
      buyer_tel : '010-1234-5678',
      buyer_addr : '서울특별시 강남구 삼성동',
      buyer_postcode : '123-456'
  }, function(rsp) {
      if ( rsp.success ) {
      	//[1] 서버단에서 결제정보 조회를 위해 jQuery ajax로 imp_uid 전달하기
      	jQuery.ajax({
      		url: "/payments/complete", //cross-domain error가 발생하지 않도록 주의해주세요
      		type: 'POST',
      		dataType: 'json',
      		data: {
  	    		imp_uid : rsp.imp_uid
  	    		//기타 필요한 데이터가 있으면 추가 전달
      		}
      	}).done(function(data) {
      		//[2] 서버에서 REST API로 결제정보확인 및 서비스루틴이 정상적인 경우
          alert("결제가 완료되었습니다.");
      		if ( everythings_fine ) {
            // alert("결제가 완료되었습니다.");
            // location.href='apple.php';
      			// var msg = '결제가 완료되었습니다.';
      			// msg += '\n고유ID : ' + rsp.imp_uid;
      			// msg += '\n상점 거래ID : ' + rsp.merchant_uid;
      			// msg += '\결제 금액 : ' + rsp.paid_amount;
      			// msg += '카드 승인번호 : ' + rsp.apply_num;
            // // post();
      			// alert(msg);
      		}
          else {
      			//[3] 아직 제대로 결제가 되지 않았습니다.
      			//[4] 결제된 금액이 요청한 금액과 달라 결제를 자동취소처리하였습니다.
      		}
      	});
      } else {
          var msg = '결제에 실패하였습니다.';
          msg += '에러내용 : ' + rsp.error_msg;

          alert(msg);
      }
  });
}
function show_pay()
{
  $('.get_form').show();
  // location.href='apple.php';
}
</script>
<script>
// 숫자 콤마처리 ,
function numberWithCommas(x)
{
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
</script>
<script>
function check_sum() // 셀렉트 박스 클릭시 토탈 금액 변경
{
  var s = '<?php echo $_POST['check_find']; ?>';
  var t = '<?php echo $_POST['check_val']; ?>';
  $('#ptag').text('총 금액 : '+numberWithCommas(t)+'원');

}
</script>
<!-- <script>
function post()
{
  var name = $('#get_name').val();
  var phone = $('#get_phone').val();
  var mail = $('#url').val();
  alert(mail);
}
</script> -->
<script>
    //load함수를 이용하여 core스크립트의 로딩이 완료된 후, 우편번호 서비스를 실행합니다.
    function adress() {
        new daum.Postcode({
            oncomplete: function(data) {
                // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성``하는 부분.

                // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var fullAddr = ''; // 최종 주소 변수
                var extraAddr = ''; // 조합형 주소 변수

                // 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                    fullAddr = data.roadAddress;

                } else { // 사용자가 지번 주소를 선택했을 경우(J)
                    fullAddr = data.jibunAddress;
                }

                // 사용자가 선택한 주소가 도로명 타입일때 조합한다.
                if(data.userSelectedType === 'R'){
                    //법정동명이 있을 경우 추가한다.
                    if(data.bname !== ''){
                        extraAddr += data.bname;
                    }
                    // 건물명이 있을 경우 추가한다.
                    if(data.buildingName !== ''){
                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
                    fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.getElementById('sample6_postcode').value = data.zonecode; //5자리 새우편번호 사용
                document.getElementById('sample6_address').value = fullAddr;

                // 커서를 상세주소 필드로 이동한다.
                document.getElementById('sample6_address2').focus();
            }
        }).open();
    }
</script>
<!-- <script type="text/javascript">
  function selectDelRow() {
    var chk = document.getElementsByName("d"); // 체크박스객체를 담는다
    var len = chk.length;    //체크박스의 전체 개수
    var checkRow = '';      //체크된 체크박스의 value를 담기위한 변수
    var checkCnt = 0;        //체크된 체크박스의 개수
    var checkLast = '';      //체크된 체크박스 중 마지막 체크박스의 인덱스를 담기위한 변수
    var rowid = '';             //체크된 체크박스의 모든 value 값을 담는다
    var cnt = 0;
    // ptag= 화면 total_cum = hidden 값

    for(var i=0; i<len; i++)
    {
      if(chk[i].checked == true)
      {
        checkCnt++;        //체크된 체크박스의 개수
        checkLast = i;     //체크된 체크박스의 인덱스
      }
    }

    for(var i=0; i<len; i++)
    {
      if(chk[i].checked == true)
      {  //체크가 되어있는 값 구분
        checkRow = chk[i].value;
        if(checkCnt == 1)
        {                            //체크된 체크박스의 개수가 한 개 일때,
          rowid += "'"+checkRow+"'";        //'value'의 형태 (뒤에 ,(콤마)가 붙지않게)
        }
        else
        {                                            //체크된 체크박스의 개수가 여러 개 일때,
          if(i == checkLast)
          {                     //체크된 체크박스 중 마지막 체크박스일 때,
            rowid += "'"+checkRow+"'";  //'value'의 형태 (뒤에 ,(콤마)가 붙지않게)
          }
          else
          {
            rowid += "'"+checkRow+"',";	 //'value',의 형태 (뒤에 ,(콤마)가 붙게)
          }
        }
      cnt++;
      checkRow = '';    //checkRow초기화.
    }
    alert(rowid);    //'value1', 'value2', 'value3' 의 형태로 출력된다.
  }
}
  </script> -->
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
        <li><a href="#"= > </a></li>
      </ul>
    </div>
    <h1><?php echo "{$_SESSION['id']}" ?>님의 장바구니</h1>

    <ul class="top">
      <li class="top_number">번호</li>
      <li class="top_product">상품명</li>
      <li class="top_cum">가격</li>
    </ul>



    <?php
    $page_set = 10; // 한페이지 줄수
    $block_set = 5; // 한페이지 블럭수
    $query = "SELECT count(*) as total FROM basket";
    $result = mysqli_query($conn, $query) or die ("쿼리 에러 : ".mysqli_error($conn));
    $row = mysqli_fetch_array($result);

    $total = $row['total']; // 전체글수

    $total_page = ceil ($total / $page_set); // 총페이지수(올림함수)
    $total_block = ceil ($total_page / $block_set); // 총블럭수(올림함수)

    if(isset($_GET['page']))
    {
      $page = $_GET['page'];
    }
    else
    {
      $page = 1;
    }

    $block = ceil ($page / $block_set); // 현재블럭(올림함수)

    $limit_idx = ($page - 1) * $page_set; // limit시작위치

    // 현재페이지 쿼리
    $query = "SELECT * FROM basket where id='{$_SESSION['id']}' ORDER BY idx DESC LIMIT $limit_idx, $page_set ";
    $result = mysqli_query($conn, $query) or die ("쿼리 d에러 : ".mysqli_error($conn));
    $rows = mysqli_num_rows($result);
    // $row = mysqli_fetch_array($result)
    $p= "SELECT count(*) FROM basket";
    $num_result = mysqli_query($conn, $p);
    $num_rows = mysqli_num_rows($result);
    $check=0;
    $total=0;
    echo "<pre>";
    while ($row = mysqli_fetch_array($result))
    {
      $check++;
      // 하나의 form 태그안에 다른 form이 있을 수 없는 것 같음..
      // 셀렉트 박스를 클릭하면 그에 해당하는 값이 포스트로 전달되게 하는 곳
      echo '<form id="select_'.$check.'" action="choice.php" method="post">';
      echo '<input type="hidden" name="check_find" value="'.$check.'">';
      echo '<input type="hidden" name="check_val" value="'.$row['cum'].'">';
      echo '</form>';

      echo '<form class="" action="choice_delete.php" method="post">';
      echo '<div class="board_view">';
      echo '<input type="checkbox" id="select_box" name = "d" value="'.$row['cum'].'" >';
      // echo '<input type="checkbox" id="select_box" value="'.$row['cum'].'" oninput="check_sum()">';

      // echo '<form id="select_'.$check.'" action="choice.php" method="post">';
      // echo '<input type="hidden" name="check_find" value="'.$check.'">';
      // echo '<input oninput="document.getElementById(\'select_\''.$check.').submit();" class="checkbox" type="checkbox" name="check_val" value="'.$row['cum'].'">';
      // echo '</form>';
      echo '<li class="idx">'.$check.'</li>';
      // echo '<form action="board_read.php" method="get" id="next'.$check.'">';
      // echo '<input type="hidden" name="idx" value="'.$row['idx'].'">';
      // echo "</form>";
      // echo '<li class="id">'.$row['id'].'</li>';
      $cum = number_format($row['cum']);
      echo '<li class="name">'.$row['name'].'</li>';
      echo '<img class="img" src="'.$row['img'].'" height="200px">';

      echo '<li class="cum">'.$cum.'원</li>';
      echo '<input type="hidden" name="choic_idx" value="'.$row['idx'].'">';
      echo'<button class="choice_delete" type="submit" name="button">x</button>';
      echo '</ul>';
      echo "</div>";
      echo'</form>';
      $num_rows--;
      $total+=$row['cum'];
    }
    echo "</pre>";
    // echo '<li class="title">'.$row['title'].'</li>';


    // 페이지번호 & 블럭 설정
    $first_page = (($block - 1) * $block_set) + 1; // 첫번째 페이지번호
    $last_page = min ($total_page, $block * $block_set); // 마지막 페이지번호

    $prev_page = $page - 1; // 이전페이지
    $next_page = $page + 1; // 다음페이지

    $prev_block = $block - 1; // 이전블럭
    $next_block = $block + 1; // 다음블럭
    $reset_page= $page = 1;

    // 이전블럭을 블럭의 마지막으로 하려면...
    $prev_block_page = $prev_block * $block_set; // 이전블럭 페이지번호
    // 이전블럭을 블럭의 첫페이지로 하려면...
    //$prev_block_page = $prev_block * $block_set - ($block_set - 1);
    $next_block_page = $next_block * $block_set - ($block_set - 1); // 다음블럭 페이지번호

    $PHP_SELF=$_SERVER['PHP_SELF'];
    // 페이징 화면

    ?>
    <form class="all_delete" action="choice_delete.php" method="post">
      <input type="hidden" name="all" value="<?php echo $_SESSION['id'] ?>">
      <button type="submit" name="button">전체삭제</button>
    </form>
    <!-- 결제요청 넘기는 값  -->
    <input id="total_cum" type="hidden" name="" value="<?php echo $total ?>">
    <p id="ptag"> 총액 = <?php echo number_format($total) ?> 원</p>
    <!-- <p id ="what">dd</p> -->

    <button class="get" type="button" name="button" onclick="show_pay()">주문하기</button>

          <!-- <div class="get_input" style="display:block"> -->
          <form class="get_form" action="index.html" method="post" style="display:none">
            <span class="get_title">배송지 입력</span>
            <div class="get_input">
              <div class="get_input_name">
                <input id="get_name" type="text" name="" value="" placeholder="이름">
              </div>
              <div class="get_input_phone">
                <input id="get_phone" type="text" name="" value="" placeholder="연락처 (-)하이픈 없이">
              </div>
            <div class="get_input_mail">
              <td><input id="get_mail" type="text" id="email" name="email"
                placeholder="메일"> @
              <select id="url">
              <option>naver.com</option> <option>daum.net</option> <option>nate.com</option>
              </select></td>
            </div>
            <div class="get_input_adress">
              <input type="text" class="adress_num" id="sample6_postcode" placeholder="우편번호">
              <input type="button" onclick="adress()" value="우편번호 찾기"><br>
              <input type="text" class="adress_main" id="sample6_address" placeholder="주소">
              <input type="text" class="adress_detail" id="sample6_address2" placeholder="상세주소">
            </div>
            <button class="get_real" type="button" name="button" onclick="pay()">결제하기</button>
          </div>
          </form>





    <?php
    // echo "<div class= paging>";
    // if ($prev_page>=1)
    // {
    //   echo ($prev_page > 0) ? "<a href='$PHP_SELF?page=$reset_page'>[처음]</a> " : "[처음] ";
    //   echo ($prev_block > 0) ? "<a href='$PHP_SELF?page=$prev_block_page'>...</a> " : "... ";
    // }
    //
    //
    // for ($i=$first_page; $i<=$last_page; $i++)
    // {
    // echo ($i != $page) ? "<a href='$PHP_SELF?page=$i'>$i</a> " : "<b>$i</b> ";
    // }
    // echo ($next_block <= $total_block) ? "<a href='$PHP_SELF?page=$next_block_page'>...</a> " : "... ";
    // echo ($next_page <= $total_page) ? "<a href='$PHP_SELF?page=$total_page'>[마지막]</a>" : "[마지막]";

    // echo "</div>";

    $sql= "ALTER TABLE basket AUTO_INCREMENT=1";
    $result = mysqli_query($conn, $sql);
    $sql2=  "SET @CNT = 0";
    $result = mysqli_query($conn, $sql2);
    $query= "UPDATE basket SET basket.idx = @CNT:=@CNT+1";
    $result = mysqli_query($conn, $query);

    ?>

    <?php
      if (isset($_POST['check_find']))
      {
        echo "<script>check_sum()</script>";
      }
     ?>


  </body>
</html>
