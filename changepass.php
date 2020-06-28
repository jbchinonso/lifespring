<?php require_once('header.php');

if(!loggedin()){
	header("Location:index");
    exit();
}

$errors = array();
$mailMsg = '';


if (isset($_POST['submit'])) {
$email = clean(trim($_POST['email'])); 
$password = clean(trim($_POST['password']));
$cpassword = clean(trim($_POST['cpassword']));	


if(strlen($password) < 8){
   $errors[] = "Your password must be up to 8 characters";
}
   
if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
   $errors[] = "Please Enter a valid Email Address";
}else{
      $checkemail=mysqli_query($connection,"SELECT * FROM staff WHERE email='$email'"); 
      if(mysqli_num_rows($checkemail) < 1){
      $errors[] = "This Email Address is not registered with us.";
      }
    } 
     
     
     
if($password !== $cpassword){
       $errors[] = "password mix match";
}
 

 
if(empty($errors)){	 

  $protectedpass = sha1($password);
 
  
   $query = "UPDATE staff SET password = '$protectedpass' WHERE email='$email'";
   

   $Result = mysqli_query($connection,$query) or die("cannot update password".mysqli_error($connection));
   if($Result)
{
$message = 'Your password at Lifespring has just been changed. \n\n';
$subject = 'Password change';

mail($email, $subject, $message);
require_once('logout.php');
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
                        <div class="login-header">CHANGE YOUR LOGIN PASSWORD</div>
                        <div class="errors">
                             <?php foreach($errors as $error) echo $error.'<br />'; ?>
                        </div>
                      <div class="form-group">
                        <input type="emai" class="form-control" name="email" placeholder="Email" required>
                      </div>
                    
                      <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="New password" required>
                      </div>

                      <div class="form-group">
                        <input type="password" class="form-control" name="cpassword" placeholder="Comfirm new password" required>
                      </div>
                      
                      <div class="form-group">
                        <input type="submit" value="Change Password" name='submit' class="btn btn-primary py-3 px-5">
                      </div>
                    </form>
                  
                  </div>


	          </div>
	        </div>
        </div>
      </div>

    </section>





    <?php require_once('footer.php') ?>