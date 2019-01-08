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


  if (isset($_SESSION['id']))
  {
    $conn = mysqli_connect(
      'localhost',
      'root',
      'password',
      'user');
    $sql = "SELECT * FROM userinfo where id='{$_SESSION['id']}'"; // table 정보 담기
    $result = mysqli_query($conn, $sql);
    $row= mysqli_fetch_array($result);

    if($result === false){
      echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
      error_log(mysqli_error($conn));
    }
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
      <h1>정보를 수정하세요</h1>
      <div class="user_input">
        <p>Apple Membership</p>
        <form class="" action="fix_user.php"  method="post" id="fix_form">
          <input type="text" name="name"  value="<?php echo $row['name']; ?>">
          <input type="text" name="email"  value="<?php echo $row['email']; ?>">
          <input type="hidden" name="id" value="<?php echo $row['id'];?>">
          <button id="fix" class="fix" name="button" onclick="document.getElementById('fix_form').submit();">수정</button>
        </form>
        <form class="delete" action="delete_user.php" method="post"  id="delete_form">
          <input type="hidden" name="id" value="<?php echo $row['id'];?>">
          <button id="delete" class="delete" name="button" onclick="document.getElementById('delete_form').submit();">아이디 삭제</button>
        </form>

      </div>
  </body>
</html>
