<?php
$server="localhost";
$username="webuser";
$password="";
$database="test";
mysql_query("CREATE DATABASE IF NOT EXISTS test",$con);
$con=mysqli_connect($server,$username,$password,$database);
if (!$con)
  {
  echo '{"status":500,"message":"Can not connect with databases"}';
  }
else
echo '{"status":200,"message":"Connected with databases"}';
?>
