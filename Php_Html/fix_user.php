<?php

    $conn = mysqli_connect(
      'localhost',
      'root',
      'password',
      'user');
    $sql = "UPDATE userinfo
    set name = '{$_POST['name']}',
    email = '{$_POST['email']}'
    where id='{$_POST['id']}'";
    $result = mysqli_query($conn, $sql);

    if($result === false){
      echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
      error_log(mysqli_error($conn));
    }
    echo "<script>location.href='mypage.php';</script>";
?>
