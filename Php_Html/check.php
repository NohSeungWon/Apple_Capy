
<?php

  // ID 중복체크
  // mysql 접속해서 진행

  if (1 == $_POST['check'])
  {
    $cum=$_POST['param'];
    include 'dbconnect.php';
    $sql = "SELECT * FROM userinfo WHERE id = '$cum'";
    $result = mysqli_query($conn, $sql);
    $row= mysqli_fetch_array($result);

    if ($row['id'] == $cum)
    {
      echo 0;
    }
    else
    {
      echo 1;
    }
  }


  // 비밀번호 중복체크
  if (2 == $_POST['check'])
  {
    $pw=$_POST['pw'];
    $pw2=$_POST['pw2'];

    if ($pw == $pw2)
    {
      echo 0;
    }
    else
    {
      echo 1;
    }
  }



  ?>
