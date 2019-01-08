<?php
  $conn = mysqli_connect(
  'localhost',
  'root',
  'password',
  'sever file name');
if ($_POST['all']) //전체 삭제
{
  $id= $_POST['all'];
  $sql = "DELETE FROM basket where id='$id'"; // table 정보 담기
  $result = mysqli_query($conn, $sql);

  if($result === false)
  {
    echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
    error_log(mysqli_error($conn));
  }
  echo "<script>location.href='choice.php';</script>";
}
else if ($_POST['choic_idx']) // 부분 삭제
{
      $id= $_POST['choic_idx'];
      $sql = "DELETE FROM basket where idx='$id'"; // table 정보 담기
      $result = mysqli_query($conn, $sql);

      if($result === false)
      {
        echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
        error_log(mysqli_error($conn));
      }
      echo "<script>location.href='choice.php';</script>";
}

?>
