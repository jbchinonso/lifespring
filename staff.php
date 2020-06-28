<?php require_once('header.php'); 

if(!loggedin()){
    header("Location:index");
    exit();
    }
  
     if(!Admin($_SESSION['user'])){
      header("Location:index");
      exit();
    }  
    
  
    $errors = array();
    $mailMsg = '';


  if (isset($_POST['register'])) {
    $name = clean(trim($_POST['username']));	
    $password = clean(trim($_POST['password']));
    $email = clean(trim($_POST['email']));
   
  if(strlen($name) < 5){
       $errors[] = "The Name is too short";
  }else{
          $checkname=mysqli_query($connection, "SELECT * FROM staff WHERE username='$name'"); 
          if(mysqli_num_rows($checkname)>0){
            $errors[] = "The Username is Already in use";
          }
        }
       
  if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
       $errors[] = "Please Enter a valid Email Address";
  }else{
          $checkemail=mysqli_query($connection,"SELECT * FROM staff WHERE email='$email'"); 
          if(mysqli_num_rows($checkemail) > 0){
          $errors[] = "The Email Address is Alredy in use.";
          }
        } 
         
         
         
  if(strlen($password) < 5){
           $errors[] = "Password is too short";
  }
     
  
     
  if(empty($errors)){	 
  
      $protectedpass = sha1($password);
      $activation = md5(uniqid(rand(),true));
      
       $query = "INSERT INTO staff SET
       username = '$name',
       email = '$email',
       password = '$protectedpass',
       active = '$activation' ";

       $Result = mysqli_query($connection,$query) or die("error adding a new staff ".mysqli_error($connection));
       if($Result)
  {
  $message = 'welcome to Lifespring Family Worship Center. Please click on the link below to activate your account \n\n';
  $message.= 'localhost/christian/activate.php?email='.urlencode($email).'&key=$activation';
  $subject = 'Registration Comfirmation and Activation key';
 
 
  if(mail($email, $subject, $message)){
    $mailMsg = 'Thank You! - A mail has been sent to '.$email.' please login to your mail box to verify your account';
     } else {
      $mailMsg = "Please Review the form we could not send mail to ".$email;
     }
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
                        <div class="login-header">REGISTER A NEW STAFF</div>
                        <div class="errors">
                             <?php foreach($errors as $error) echo $error.'<br />'; echo $mailMsg ?>
                        </div>
                      <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Username" required>
                      </div>

                      <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Email" required>
                      </div>
                    
                      <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="password" required>
                      </div>
                      
                      <div class="form-group">
                        <input type="submit" value="Sign Up" name="register" class="btn btn-primary py-3 px-5">
                      </div>
                    </form>
                  
                  </div>


	          </div>
	        </div>
        </div>
      </div>

    </section>





    <?php require_once('footer.php') ?>