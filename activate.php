<?php  require("core/functions.php");?>
<?php  require("core/conn.php");?>
<?php
if(isset($_GET['email']) && preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', $_GET['email']))
{
$email = $_GET['email'];
}
if(isset($_GET['key']))
{
$key = $_GET['key'];
}
if(isset($email) && isset($key))
{
$email = htmlentities($email);
$key  = htmlentities($key);
$checkemail=mysqli_query($connection,"SELECT * FROM staff WHERE email='$email' AND active ='$key'");
if(mysqli_num_rows($checkemail)>0)
{
$comfirm = mysqli_query($connection,
     "UPDATE  staff SET
	 active = 'Yes'
	 WHERE email = '$email' AND 
	 active = '$key' LIMIT 1") or die('Error '.mysqli_error());

 $msg = "Congratulations Your Account has been successfully created you can Now loggin"; 
header("Location:login.php?msg=$msg");
exit;
}else{
 $msg = "please You have to be Registered to verify your Account"; 
header("Location:index.php?msg=$msg");
exit;
}
}
?>
