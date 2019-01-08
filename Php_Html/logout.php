<?php
session_start(); // 세션
if($_SESSION['id']!=null){
   session_destroy();
   // unset($_COOKIE["user_id"]);
   setcookie("user_id", "", time() - 3600,'/');

}
// setcookie("user_id", "", time() - 3600,'/');
echo "<script>location.href='apple.php';</script>";

?>
