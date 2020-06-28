<?php require_once('header.php');

if(loggedin()){
	header("Location:dashboard");
    exit();
}

$error = '';
	 
 if (isset($_POST['login'])) {
  
    $username = clean(trim($_POST['username']));	
    $password = clean(trim($_POST['password'])); 
	 
	if(!empty($username) && !empty($password)){
	        $password = sha1($password);
			 $checkname=mysqli_query($connection,"SELECT username,password,email FROM  staff WHERE username='$username' AND password='$password' AND active='Yes' OR email='$username' AND password='$password' AND active='Yes' LIMIT 1")or die('Error'.mysqli_error());				 
			if(mysqli_num_rows($checkname)>0){
			  $key = mysqli_real_escape_string($connection,md5($password.time()));
			  $time = time()+86400;
		      setcookie("sessionkey","$key","$time" );
		$getuser =	  mysqli_query($connection,"SELECT username FROM  staff WHERE username='$username' OR email='$username' AND active='Yes' LIMIT 1")or die('Error! cannot identify the User '.mysqli_error());
        $fetchuser= Mysqli_fetch_array($getuser);		
	    $_SESSION['user'] = $fetchuser['username'];
		mysqli_query($connection,"UPDATE staff SET sessionkey = '$key' WHERE username = '$username' OR email='$username' ")or die('cant update staff table'.mysqli_error());
			  $sucess="you have sucessfully logged in";
	redirect_to("dashboard?msg=$sucess");
} else {  
$error="incorrect name and password combination";
	}	
   
		} 
			  
      }	



?>



	  <section class="home-slider js-fullheight owl-carousel">
      <div class="slider-item js-fullheight" style="background-image:url(images/bg_1.jpg);">
      	<div class="overlay"></div>
	        <div class="container">
	          <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center" data-scrollax-parent="true">
	          <div class="col-md-10 text-center ftco-animate mt-5">
                  
                <div class="col-md-12 order-md-last">
                    <form action="?" method="POST" class="bg-light p-4 p-md-5 contact-form">
                        <div class="login-header">LOGIN TO THE BACK OFFICE</div>
                        <div class="errors">
                             <?php echo $error ?>
                        </div>
                      <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Username or Email" required>
                      </div>
                    
                      <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="password" required>
                      </div>
                      
                      <div class="form-group">
                        <input type="submit" value="Login" name='login' class="btn btn-primary py-3 px-5">
                      </div>
                    </form>
                  
                  </div>


	          </div>
	        </div>
        </div>
      </div>

    </section>





    <?php require_once('footer.php') ?>