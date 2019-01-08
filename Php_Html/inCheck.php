<?php

$id = $_POST[id];

$conn = $this->mysql_conn("localhost","root", "password","user");

$sql = " select count(*) from userinfo where id='$id' ";

$Result = mysql_query($sql);

$rows = mysql_num_rows($Result);

if($rows > 0){

$data = mysql_fetch_array($Result);

}

if($data[0] == 0){ echo "사용가능한 ID입니다."; }

else{ echo "사용중인 ID입니다."; }

mysql_close($conn);

?>
