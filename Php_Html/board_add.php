<?php
  session_start();
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

</script>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/board_add.css">
    <style media="screen">
    td { font-size : 9pt; }
    A:link { font : 9pt; color : black; text-decoration : none;
    font-family : 굴림; font-size : 9pt; }
    A:visited { text-decoration : none; color : black; font-size : 9pt; }
    A:hover { text-decoration : underline; color : black;
    font-size : 9pt; }
    </style>


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
        <li><a href="#"= > </a></li>
      </ul>
    </div>
    <center>
    <BR>
    <!-- 입력된 값을 다음 페이지로 넘기기 위해 FORM을 만든다. -->
    <form action="board.php" method=post>
    <table width=600 border=0 cellpadding=1 cellspacing=5 >
        <tr>
            <td height=20 align=center bgcolor=rgb(20, 20, 20)>
            <font color=white><B>글 쓰 기</B></font>
            </td>
        </tr>
        <!-- 입력 부분 -->
        <tr>
            <td bgcolor=white>&nbsp;
            <table>
                <tr>
                    <td width=60 align=left >제 목</td>
                    <td align=left >
                        <INPUT type=text name=title size=60 maxlength=35>
                    </td>
                </tr>
                <tr>
                    <td width=60 align=left >내용</td>
                    <td align=left>
                        <TEXTAREA name=texture cols=65 rows=15></TEXTAREA>
                    </td>
                </tr>
                <tr>
                    <td colspan=10 align=center>
                        <INPUT type=submit value="글 저장하기">
                        &nbsp;&nbsp;
                        <INPUT type=reset value="다시 쓰기">
                        &nbsp;&nbsp;
                        <INPUT type=button value="되돌아가기"
                        onclick="history.back(-1)"> <!--버튼이 클릭되었을때 발생하는 이벤트로 자바스크립트를 실행함. 이렇게 하면 바로 이전페이지로 감-->
                    </td>
                </tr>
                <input type="hidden" name="id" value="<?php echo $_SESSION['id'] ?>">
            </TABLE>
    </td>
    </tr>
    <!-- 입력 부분 끝 -->
    </table>
    </form>
    </center>
  </body>
</html>
