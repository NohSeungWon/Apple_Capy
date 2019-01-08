<?php

$id= $_GET['delete'];
    $conn = mysqli_connect(
      'localhost',
      'root',
      'password',
      'server file name');
    $sql = "DELETE FROM boardinfo where idx='$id'"; // table 정보 담기
    $result = mysqli_query($conn, $sql);

    if($result === false)
    {
      echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
      error_log(mysqli_error($conn));
    }
    echo "<script>location.href='board.php';</script>";
?>
