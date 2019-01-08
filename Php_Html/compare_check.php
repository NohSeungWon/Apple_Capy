<?php
  // ID 중복체크
  // mysql 접속해서 진행

  // if (1 == $_POST['check'])
  // { echo 0;
  //   $cum=$_POST['param'];
  //   $conn = mysqli_connect(
  //     'localhost',
  //     'root',
  //     'password',
  //     'product');
  //   $sql = "SELECT * FROM compare WHERE img = '$cum'";
  //   $result = mysqli_query($conn, $sql);
  //   $row= mysqli_fetch_array($result);
  if ($_POST['param'] == 1 ) {
    // code...  echo 0;
      echo 0;
  }
  else if (2 == $_POST['param']) {
    // code...
    echo 1;
  }
  // }
  // // 비밀번호 중복체크
  // if (2 == $_POST['check'])
  // {
  //   $pw=$_POST['pw'];
  //   $pw2=$_POST['pw2'];
  //
  //   if ($pw == $pw2)
  //   {
  //     echo 0;
  //   }
  //   else
  //   {
  //     echo 1;
  //   }
  // }
  ?>
