<?php
session_start(); // 세션

if($_SESSION['id']!=null)
{
   session_destroy();
}

$id= $_POST['id'];
    $conn = mysqli_connect(
      'localhost',
      'root',
      'password',
      'user');
    $sql = "DELETE FROM userinfo where id='{$_POST['id']}'"; // table 정보 담기
    $result = mysqli_query($conn, $sql);

    if($result === false){
      echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
      error_log(mysqli_error($conn));
    }
    echo "<script>location.href='apple.php';</script>";
?>
