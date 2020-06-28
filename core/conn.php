<?php
$host = "127.0.0.1";
$user = "root";
$pwd = "";
$dbname ="lifespring";
$connection = mysqli_connect($host,$user,$pwd);
 if(!$connection){
 die ("cannot connect to database".mysql_error());
 }
$db_select = mysqli_select_db($connection,$dbname);
if(!$db_select){
 die ("cannot select db".mysqli_error());
 }


?>