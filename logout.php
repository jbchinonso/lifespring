<?php require_once("core/conn.php");
 require_once("core/functions.php");
 ?>
 
<?php 

if(!loggedin()){
	header("location:index");
}
$time = time()-1440;
$user = $_SESSION["user"];
$_SESSION["user"] = array();
unset($_SESSION["user"]);
session_destroy();
 setcookie("sessionkey","","$time" );
 $regmsg="you have sucessfully logged out ";
header("Location:index?msg=$regmsg");
exit();
?>