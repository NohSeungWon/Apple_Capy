<?php
  // echo $_POST['idx'];
  // echo $_POST['id'];
  // echo $_POST['title'];
  // echo $_POST['texture'];

    $conn = mysqli_connect(
      'localhost',
      'root',
      'password',
      'sever file name');
    $sql = "UPDATE boardinfo
    set title = '{$_POST['title']}',
    texture = '{$_POST['texture']}'
    where idx='{$_POST['idx']}'";
    $result = mysqli_query($conn, $sql);

    if($result === false){
      echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
      error_log(mysqli_error($conn));
    }
    echo "<script>location.href='board.php';</script>";
?>
