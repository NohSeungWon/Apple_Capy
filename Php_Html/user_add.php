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
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script>
function check_id()
{
       var no ="중복";
      $.ajax({
          url:'check.php',
          type:'post',
          data:{param:$('#id').val(), check:1},
          success:function(data){
            if (data==0)
            {
              $('#id').css("background-color", "rgb(244, 72, 124)");
              // $('#dd').append("중복");
            }
            else
            {
              // $('#dd').append("노노");
              $('#id').css("background-color", "rgb(54, 126, 104)");
            }
          }
      })
}

function check_pw()
{
  $.ajax({
     url:'check.php',
     type:'post',
     data:{pw:$('#pw').val(), pw2:$('#pw2').val(), check:2},
     success:function(data){
       if (data==1)
       {
         $('#pw2').css("background-color", "rgb(166, 24, 67)");
       }
       else
       {
         $('#pw2').css("background-color", "rgb(6, 82, 59)");
       }
     }
  })
}
<?php
  if(isset($_POST['id'])) {
    $conn = mysqli_connect(
      'localhost',
      'root',
      'password',
      'user');
    $sql = "
      INSERT INTO userinfo
        (id, pw, name, email)
        VALUES(
            '{$_POST['id']}',
            '{$_POST['pw']}',
            '{$_POST['name']}',
            '{$_POST['email']}'
        )
    ";
    $result = mysqli_query($conn, $sql);
    if($result === false){
      echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
      error_log(mysqli_error($conn));
    }
     echo "<script>window.alert('회원가입이 완료되었습니다.');</script>";
    echo "<script>location.href='apple.php';</script>";
  }
?>

</script>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/user_add.css">
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
      <h1>Apple의 세계에 오신 것을 환영합니다.</h1>
      <div class="user_input">
        <p>Apple Membership</p>
        <form class="" action="#"  method="post">
          <input id="id" type="text" name="id"  placeholder="ID" oninput="check_id()">
          <input id="pw" type="password" name="pw"  placeholder="암호">
          <input id="pw2" type="password" name="pw2"  placeholder="암호확인" oninput="check_pw()">
          <input type="text" name="name"  placeholder="이름">
          <input type="text" name="email"  placeholder="메일">
          <button type="submit" name="button">제출</button>
        </form>
      </div>
  </body>
</html>
