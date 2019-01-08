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

  }
 ?>

<?php
$conn = mysqli_connect(
  'localhost',
  'root',
  'password',
  'server file name');
  if(isset($_POST['title']))
  {
    $num=0;
    $sql2 = "
      INSERT INTO boardinfo
        (id, title, texture, num)
        VALUES(
            '{$_POST['id']}',
            '{$_POST['title']}',
            '{$_POST['texture']}',
            '$num'
        )
    ";
    $result2 = mysqli_query($conn, $sql2);
    if($result2 === false)
    {
      echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
      error_log(mysqli_error($conn));
    }
  }

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/board.css">
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
      <h1>자유게시판</h1>

        <ul class="board_title">
          <li class="boadr_title_num">번호</li>
          <li class="boadr_title_title">제목</li>
          <li class="boadr_title_witer">작성자</li>
          <li class="boadr_title_date">날짜</li>
          <li class="boadr_title_sum">조회수</li>
        </ul>

        <?php  // 메인 글 페이징

        $page_set = 10; // 한페이지 줄수
        $block_set = 5; // 한페이지 블럭수

        $query = "SELECT count(*) as total FROM boardinfo";
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
        $query = "SELECT * FROM boardinfo ORDER BY idx DESC LIMIT $limit_idx, $page_set";
        $result = mysqli_query($conn, $query) or die ("쿼리 d에러 : ".mysqli_error($conn));
        $rows = mysqli_num_rows($result);
        // $row = mysqli_fetch_array($result)
        $p= "SELECT count(*) FROM boardinfo";
        $num_result = mysqli_query($conn, $p);
        $num_rows = mysqli_num_rows($result);

        $check=0;
        echo "<pre>";
        while ($row = mysqli_fetch_array($result))
        {
          $check++;
          echo '<div class="board_view">';
          // echo '<li class="idx">'.$num_rows.'</li>';
          echo '<li class="idx">'.$row['idx'].'</li>';
          echo '<form action="board_read.php" method="get" id="next'.$check.'">';
          echo '<input type="hidden" name="idx" value="'.$row['idx'].'">';
          echo "</form>";
          echo '<li class="title"><a href="#" onclick="document.getElementById(\'next'.$check.'\').submit();" >'.$row['title'].'</a></li>';
          echo '<li class="id">'.$row['id'].'</li>';
          echo '<li class="date">'.$row['date'].'</li>';
          echo '<li class="select">'.$row['num'].'</li>';
          echo '</ul>';
          echo "</div>";
          $num_rows--;
        }
        echo "</pre>";
        // echo '<li class="title">'.$row['title'].'</li>';


        // 페이지번호 & 블럭 설정
        $first_page = (($block - 1) * $block_set) + 1; // 첫번째 페이지번호
        $last_page = min ($total_page, $block * $block_set); // 마지막 페이지번호

        $prev_page = $page - 1; // 이전페이지
        $next_page = $page + 1; // 다음페이지
        $reset_page= $page = 1;

        $prev_block = $block - 1; // 이전블럭
        $next_block = $block + 1; // 다음블럭


        // 이전블럭을 블럭의 마지막으로 하려면...
        $prev_block_page = $prev_block * $block_set; // 이전블럭 페이지번호
        // 이전블럭을 블럭의 첫페이지로 하려면...
        // $prev_block_page = $prev_block * $block_set - ($block_set - 1);
        $next_block_page = $next_block * $block_set - ($block_set - 1); // 다음블럭 페이지번호

        $PHP_SELF=$_SERVER['PHP_SELF'];
        // 페이징 화면

        ?>

        <?php
        echo "<div class= num>";
        if ($prev_page>=1)
        {
          echo ($prev_page > 0) ? "<a href='$PHP_SELF?page=$reset_page'>[처음]</a> " : "[처음] ";
          echo ($prev_block > 0) ? "<a href='$PHP_SELF?page=$prev_block_page'>[이전]</a> " : "[이전] ";
        }

        $just = 0;
        for ($i=$first_page; $i<=$last_page; $i++)
        {
        echo ($i != $page) ? "<a href='$PHP_SELF?page=$i'>$i</a> " : "<b>$i</b> ";
        $just++;
        }
        if ($just!=1) // 마지막페이지로 넘어가면 1이 되기 때문에 1이 아닐 경우만 띄움
        {
          echo ($next_block <= $total_block) ? "<a href='$PHP_SELF?page=$next_block_page'>[다음]</a> " : "[다음] ";
          echo ($next_page <= $total_page) ? "<a href='$PHP_SELF?page=$total_page'>[마지막]</a>" : "[마지막]";
        }
        echo "</div>";

        // idx 번호 초기화
        $sql= "ALTER TABLE boardinfo AUTO_INCREMENT=1";
        $result = mysqli_query($conn, $sql);
        $sql2=  "SET @CNT = 0";
        $result = mysqli_query($conn, $sql2);
        $query= "UPDATE boardinfo SET boardinfo.idx = @CNT:=@CNT+1";
        $result = mysqli_query($conn, $query);
        ?>


        <script type="text/javascript">
          function popup()
          {
              window.alert('로그인이 필요합니다.');
          }
        </script>
        <?php
        if (!isset($_SESSION['id']))
        {  // 로그인이 안되어있을 떄 로그인, 회원가입을 띄우기
          echo '<button type="button" name="button" onclick="popup()">글쓰기</button>';
        }
        else
        {  // 로그인이 되어있으면 마이페이지와, 로그아웃 띄우기
          echo '<button type="button" name="button" onclick="location=\'board_add.php\'">글쓰기</button>';
        }
         ?>

        <!-- <button type="button" name="button" onclick="location='board_add.php'">글쓰기</button> -->
        </body>
        </html>
