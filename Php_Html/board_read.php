<?php
  // idx = 게시판 넘버 num=게시판 넘버 fix = 댓글 넘버  re= check 넘버
  session_start();
  $conn = mysqli_connect(
  'localhost',
  'root',
  'password',
  'server file name');
  // 처음 댓글 생성시
  if (isset($_GET['texture_re']))
  {
      $sql2 = "
        INSERT INTO board_re
          (id, texture, num)
          VALUES(
              '{$_SESSION['id']}',
              '{$_GET['texture_re']}',
              '{$_GET['num']}'
          )
      ";
      $result2 = mysqli_query($conn, $sql2);
  }
  // 댓글 수정했을 때
  if (isset($_GET['texture_re_fix']))
  {
    $sql = "UPDATE board_re
    set texture = '{$_GET['texture_re_fix']}'
    where idx='{$_GET['idx_re']}'";
    $result = mysqli_query($conn, $sql);
  }
  // 대댓글 수정 했을 때
  if (isset($_GET['texture_re_refix']))
  {
    $sql = "UPDATE board_re_re
    set texture = '{$_GET['texture_re_refix']}'
    where idx='{$_GET['idx_re_re_fix']}'";
    $result = mysqli_query($conn, $sql);
  }
  // 댓글 삭제 했을 때
  if (isset($_GET['delete']))
  {
    $delete_num=$_GET['delete'];
    $sql = "DELETE from board_re
    where idx='{$_GET['delete']}'";
    $result = mysqli_query($conn, $sql);
  }
  // 대댓글 삭제 했을 때
  if (isset($_GET['delete_re']))
  {
    $delete_num=$_GET['delete_re'];
    $sql = "DELETE from board_re_re
    where idx='{$_GET['delete_re']}'";
    $result = mysqli_query($conn, $sql);
  }

  // 대댓글 등록했을 때
  if (isset($_GET['texture_re_re']))
  {
      $sql3 = "
        INSERT INTO board_re_re
          (id, texture, num, num_2)
          VALUES(
              '{$_SESSION['id']}',
              '{$_GET['texture_re_re']}',
              '{$_GET['idx']}',
              '{$_GET['re_idxnum']}'
          )
      ";
      $result3 = mysqli_query($conn, $sql3);
  }

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
// echo $_GET['idx'];
  // if (isset($_GET['idx']))
  // {
    $sql = "UPDATE boardinfo
    set num = num + 1
    where idx='{$_GET['idx']}'";
    $result = mysqli_query($conn, $sql);
  // }

 ?>



<?php
// if (isset($_GET['idx'])) {
  $sql = "SELECT * FROM boardinfo where idx='{$_GET['idx']}'"; // table 정보 담기
  $result = mysqli_query($conn, $sql);
  $board_row= mysqli_fetch_array($result);
// }

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/board_read.css">
    <title>iPhone</title>
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript">
    function board_re_fix()
    {
      // 댓글 수정 폼 생성하는 곳
      // var를 하나 이상은 위에 생성해야 ajax 가 먹힌다.. 대체 왜그러냐 아오
      // idx = 게시판 넘버 num=게시판 넘버 fix = 댓글 넘버  re= check 넘버

      var t = 1 ;

      var pages = '<?php echo $_GET['num']; ?>'; // 게시판 메인 글 idx번
      var re_idx ="<?php echo $_GET['fix']; ?>"; // 댓글 idx 번호
      var re_num = "<?php echo $_GET['re']; ?>";// 현재 게시판 중 선택된 번호
      var text=$('#titie_re_'+re_num).text();
        $.ajax({
            url:'compare_check.php',
            type:'post',
            data:{param:t, check:1},
            success:function(data)
            {
              if (data==0)
              {
                // alert('t');
                $('#titie_re_'+re_num)
                .html
                ( '<form class="" action="board_read.php" method="get">'+
                  '<input type="hidden" name="idx" value="'+pages+'">'+ // 게시판 원본 글 띄우기 위해 보내는 값
                  // '<input type="hidden" name="idx" value="'+pages+'">'+
                  '<input type="hidden" name="idx_re" value="'+re_num+'">'+ // 게시판 수정시에 보내는 idx 값
                  '<input class="input_text" type="text" name="texture_re_fix" value="'+text+'">'+
                  '<button class="input_btn"type="submit" name="button">수정</button>'+
                  '</form>'
                );
              }
            }

        })
    }
    </script>
    <script type="text/javascript">
    function board_re_re_fix()
    {
      // 대댓글 수정 폼 생성하는 곳
      // var를 하나 이상은 위에 생성해야 ajax 가 먹힌다.. 대체 왜그러냐 아오
      // idx = 게시판 넘버 num=게시판 넘버 fix = 댓글 넘버  re= check 넘버

      var t = 1 ;

      var pages = '<?php echo $_GET['num']; ?>'; // 게시판 메인 글 idx번
      var re_idx ="<?php echo $_GET['fix_re']; ?>"; // 대댓글 idx 번호
      var re_num = "<?php echo $_GET['re_re']; ?>";// 현재 게시판 중 선택된 번호
      var text=$('#titie_re_re'+re_num).text();
        $.ajax({
            url:'compare_check.php',
            type:'post',
            data:{param:t, check:1},
            success:function(data)
            {
              if (data==0)
              {
                // alert('t');
                $('#titie_re_re'+re_num)
                .html
                ( '<form class="" action="board_read.php" method="get">'+
                  '<input type="hidden" name="idx" value="'+pages+'">'+ // 게시판 원본 글 띄우기 위해 보내는 값
                  '<input type="hidden" name="idx_re_re_fix" value="'+re_idx+'">'+ // 대댓글 idx
                  '<input type="hidden" name="idx_re_re" value="'+re_num+'">'+ // 게시판 수정시에 보내는 idx 값
                  '<input class="input_text" type="text" name="texture_re_refix" value="'+text+'">'+
                  '<button class="input_btn"type="submit" name="button">수정</button>'+
                  '</form>'
                );
              }
            }

        })
    }
    </script>



    <!--  왜 그러는 지는 모르겠지만 이렇게 스크립트를 분리하지 않으면 아래것이 실행되지 않는다. -->
    <script>
    function choice_re()
    {
      var t = 2 ;
      var check_num = "<?php echo $_GET['check_num']; ?>";// 현재 게시판 중 선택된 번호
      $.ajax({
          url:'compare_check.php',
          type:'post',
          data:{param:t, check:1},
          success:function(data)
          {
            if (data==1)
            {
              $('.board_re_re'+check_num).show();
            }
          }
      })
    }
    </script>
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
      <div class="board">
          <div class="top">
            <span class="title"><?php echo $board_row['title'];?></span>
            <span class="date"><?php echo $board_row['date'];?></span>
            <?php
            if (!isset($_SESSION['id']) || !isset($board_row['id'])) // 로그인 안되어 있을 때
            {
              // 아무것도 띄우지 않을 때
            }
            else if (isset($_SESSION['id']) || isset($board_row['id'])) // 로그인 되어있을 때
            {
              if ($board_row['id']==$_SESSION['id']) // 둘다 일치할 때
              {
                echo '<form action="board_fix.php" method="get" id="fix">';
                echo '<input type="hidden" name="fix" value="'.$_GET['idx'].'">';
                echo '<a href="#" onclick="document.getElementById(\'fix\').submit();" >수정</a>';
                echo '</form>';
                echo' <form action="board_delete.php" method="get" id="delete">
                      <input type="hidden" name="delete" value="'.$_GET['idx'].'">
                      <a href="#" onclick="document.getElementById(\'delete\').submit();" >삭제</a>
                      </form>';
              }
            }
            ?>
          </div>

        <div class="text_show">
          <span class="id"><?php echo $board_row['id'];?></span>
          <span class="texture"><?php echo $board_row['texture'];?></span>
        </div>
      </div>
    </div>


    <!-- 댓글 부분  -->
    <?php
    // $page_set = 10; // 한페이지 줄수
    // $block_set = 5; // 한페이지 블럭수

    $query = "SELECT count(*) as total FROM board_re";
    $result = mysqli_query($conn, $query) or die ("쿼리 에러 : ".mysqli_error($conn));
    $row = mysqli_fetch_array($result);

    // $total = $row['total']; // 전체글수

    // $total_page = ceil ($total / $page_set); // 총페이지수(올림함수)
    // $total_block = ceil ($total_page / $block_set); // 총블럭수(올림함수)
    //
    // if(isset($_GET['page']))
    // {
    //   $page = $_GET['page'];
    // }
    // else
    // {
    //   $page = 1;
    // }

    // $block = ceil ($page / $block_set); // 현재블럭(올림함수)

    // $limit_idx = ($page - 1) * $page_set; // limit시작위치

    // 현재페이지 쿼리
    $query = "SELECT * FROM board_re where num='{$board_row['idx']}'";
    // $query = "SELECT * FROM boardinfo ORDER BY idx DESC LIMIT $limit_idx, $page_set";
    $result = mysqli_query($conn, $query) or die ("쿼리 d에러 : ".mysqli_error($conn));
    $rows = mysqli_num_rows($result);

    $check=0;



    // <!-- 대댓글 부분  -->
    //
    $query_re_re = "SELECT count(*) as total FROM board_re_re";
    $result_re_re = mysqli_query($conn, $query_re_re) or die ("쿼리 에러 : ".mysqli_error($conn));
    $row_re_re = mysqli_fetch_array($result_re_re);

    // 현재페이지 쿼리 이 부분은 while문에 들어간다
    // $query_re_re = "SELECT * FROM board_re_re where num='{$board_row['idx']}' and num_2='{$row['idx']}'";
    // $result_re_re = mysqli_query($conn, $query_re_re) or die ("쿼리 d에러 : ".mysqli_error($conn));
    // $rows_re_re = mysqli_num_rows($result_re_re);
    $check_re=0;

    // 댓글 db에 있는 것과 아이디를 비교 하는 곳
    if (isset($_SESSION['id']))
    {
      $sql_re = "select * from board_re where id ='{$_SESSION['id']}'";
      $result_re = mysqli_query($conn, $sql_re);
      $row_re = mysqli_fetch_array($result_re);
    }
    // 대댓글 db에 있는 것과 아이디를 비교 하는 곳
    if (isset($_SESSION['id']))
    {
      $sql_re_check = "select * from board_re where id ='{$_SESSION['id']}'";
      $result_re_check = mysqli_query($conn, $sql_re_check);
      $row_re_check = mysqli_fetch_array($result_re_check);
    }

    while ($row = mysqli_fetch_array($result))
    {
      $check++;
      // echo '<li class="idx">'.$num_rows.'</li>';
      // echo '<li class="idx">'.$row['idx'].'</li>';
      // echo '<form action="board_read.php" method="get" id="next'.$check.'">';
      // echo '<input type="hidden" name="idx" value="'.$row['idx'].'">';
      // echo "</form>";
      // echo '<li class="title_re"><a href="#" onclick="document.getElementById(\'next'.$check.'\').submit();" >'.$row['title'].'</a></li>';
      echo '<div class="board_view">';
      echo '<ul class="board_view_top">';
      echo '<li class="id_re">'.$row['id'].'</li>';
      echo '<li class="date_re">'.$row['date'].'</li>';
      // echo $row['idx'];
      if (!isset($_SESSION['id']) || !isset($row_re['id'])) // 로그인 안되어 있을 때
      {
        // 아무것도 띄우지 않을 때
      }
      else if (isset($_SESSION['id']) || isset($row_re['id'])) // 로그인 되어있을 때
      {
        echo '<form class="re_plus" action="board_read.php" method="get">
              <input type="hidden" name="idx" value="'.$_GET['idx'].'">
              <input type="hidden" name="num" value="'.$board_row['idx'].'">
              <input type="hidden" name="fix" value="'.$row['idx'].'">
              <input type="hidden" name="check_num" value="'.$check.'">
              <button class="re_btn"type="submit" name="button">답글달기</button>
              </form>';
              // echo $check;
        if ($row['id']==$_SESSION['id']) // 둘다 일치할 때
        {
          // idx = 게시판 idx
          // num = 게시판 idx
          // fix = 댓글  idx
          // re =  게시판 개수
          echo '<form class="check_re_fix" action="board_read.php" method="get">
            <input type="hidden" name="idx" value="'.$_GET['idx'].'">
            <input type="hidden" name="num" value="'.$board_row['idx'].'">
            <input type="hidden" name="fix" value="'.$row['idx'].'">
            <input type="hidden" name="re" value="'.$check.'">
            <button class="re_btn"type="submit" name="button">수정</button>
          </form>';

          echo '<form class="check_re_delete" action="board_read.php" method="get">
            <input type="hidden" name="idx" value="'.$_GET['idx'].'">
            <input type="hidden" name="num" value="'.$board_row['idx'].'">
            <input type="hidden" name="delete" value="'.$row['idx'].'">
            <button class="re_btn"type="submit" name="button">삭제</button>
          </form>';
        }
      }
      echo '</ul>';
      echo '<li id="titie_re_'.$check.'"class="titie_re">'.$row['texture'].'</li>';
      echo "</div>";

      // 댓글 idx에 맞는 대댓글만 출력하기 위한 쿼리 날리기
      $query_re_re = "SELECT * FROM board_re_re where num='{$board_row['idx']}' and num_2='{$row['idx']}'";
      $result_re_re = mysqli_query($conn, $query_re_re) or die ("쿼리 d에러 : ".mysqli_error($conn));
      $rows_re_re = mysqli_num_rows($result_re_re);

      // 대댓글 출력
      while ($row_re_re = mysqli_fetch_array($result_re_re))
      {

        $check_re++;
        echo '<div class="board_view_re">';
        echo '<ul class="board_view_top_re">';
        echo '<li class="re_re_l">L</li>';
        echo '<li class="id_re_re">'.$row_re_re['id'].'</li>';
        echo '<li class="date_re_re">'.$row_re_re['date'].'</li>';
        // echo $row_re_re['idx'];
        if (!isset($_SESSION['id']) || !isset($row_re_check['id'])) // 로그인 안되어 있을 때
        {
          // 아무것도 띄우지 않을 때
        }
        else if (isset($_SESSION['id']) || isset($row_re_check['id'])) // 로그인 되어있을 때
        {
            // echo $row_re_re['idx'];
          if ($row_re_re['id']==$_SESSION['id']) // 둘다 일치할 때
          {
            // idx = 게시판 idx
            // num = 게시판 idx
            // fix = 댓글  idx
            // re =  게시판 개수
            echo '<form class="check_re_fix" action="board_read.php" method="get">
              <input type="hidden" name="idx" value="'.$_GET['idx'].'">
              <input type="hidden" name="num" value="'.$board_row['idx'].'">
              <input type="hidden" name="fix_re" value="'.$row_re_re['idx'].'">
              <input type="hidden" name="re_re" value="'.$check_re.'">
              <button class="re_btn"type="submit" name="button">수정</button>
            </form>';

            echo '<form class="check_re_delete" action="board_read.php" method="get">
              <input type="hidden" name="idx" value="'.$_GET['idx'].'">
              <input type="hidden" name="num" value="'.$board_row['idx'].'">
              <input type="hidden" name="delete_re" value="'.$row_re_re['idx'].'">
              <button class="re_btn"type="submit" name="button">삭제</button>
            </form>';
          }
        }
        echo '</ul>';
        echo '<li id="titie_re_re'.$check_re.'"class="titie_re_re">'.$row_re_re['texture'].'</li>';
        echo "</div>";
      }


      // 대댓글 등록하는 곳
      // idx = 게시판 idx   re_idxnum = 댓글 idx
      echo '<form class="board_re_re_form" action="board_read.php" method="get">
            <div class="board_re_re'.$check.'" style="display:none">
            <input type="hidden" name="idx" value="'.$_GET['idx'].'">
            <input type="hidden" name="re_idxnum" value="'.$row['idx'].'">
            <input class="texture_re_re" type="text" name="texture_re_re" value="">
            <button class="input_btn_re"type="submit" name="button">등록</button>
            </div>
            </form>';
    }
    ?>


    <?php
      if (isset($_SESSION['id']))
      {
        // 댓글 등록 하는 곳
        echo '
        <form class="" action="board_read.php" method="get">
          <div class="board_re">
            <input type="hidden" name="idx" value="'.$_GET['idx'].'">
            <input class="input_text" type="text" name="texture_re" value="">
            <input type="hidden" name="num" value="'.$board_row['idx'].'">
            <button class="input_btn"type="submit" name="button">등록</button>
          </div>
        </form>';
      }
     ?>

     <?php
     // 댓글 수정
       if (isset($_GET['re']))
       {
         // echo "idx 값 {$_GET['idx']}";
         // echo "num 값 {$_GET['num']}";
         // echo "fix 값 {$_GET['fix']}";
         // echo "re 값 {$_GET['re']}";
         echo "<script>board_re_fix()</script>";
       }
       // 대댓글 수정
       if (isset($_GET['re_re']))
       {

         echo "<script>board_re_re_fix()</script>";
       }
       // 대댓글 달기
       if (isset($_GET['check_num']))
       {
         echo "<script>choice_re()</script>";
       }
       ?>


  </body>
