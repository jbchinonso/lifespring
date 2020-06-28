<?php require_once('header.php');

if(!loggedin()){
  header('Location:index');
  exit();
}


$errors = array();
$msg = '';

if (isset($_POST['register'])) {
$fullname = clean(trim($_POST['fullname']));	
$address = clean(trim($_POST['address']));
$phone = clean(trim($_POST['phone']));
$staff = $_SESSION['user'];

if(strlen($fullname) < 10){
   $errors[] = "Please Enter the fullname. this is too short";
}

if(strlen($address) < 5){
      $errors[] = "Please Enter a Valid Address. this is too short";
   }
        
     
if(strlen($phone)!== 11){
       $errors[] = "Please Enter a valid Nigerian phone number";
}else{
  $checkphone=mysqli_query($connection, "SELECT * FROM members WHERE phone='$phone'"); 
  if(mysqli_num_rows($checkphone)>0){
    $errors[] = "This Phone Number has Already been Registered.";
  }
}
 

 
if(empty($errors)){	 
  
   $query = "INSERT INTO members SET
   fullname = '$fullname',
   address = '$address',
   phone = '$phone',
   staff = '$staff' ";

   $Result = mysqli_query($connection,$query) or die("error registering a new member ".mysqli_error($connection));
   if($Result)
{
$msg = 'Thank You! - '.$fullname.' has been successfully Registered';
 } else {
  $msg = "Please Review the form we could not Register ".$fullname;
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
                        <div class="login-header">REGISTER A NEW MEMBER</div>
                        <div class="errors">
                             <?php foreach($errors as $error) echo $error.'<br />'; echo'<span class="success">'. $msg.'<span>' ?>
                        </div>
                      <div class="form-group">
                        <input type="text" class="form-control" name="fullname" placeholder="FullName" required>
                      </div>

                      <div class="form-group">
                        <input type="text" class="form-control" name="address" placeholder="Address" required>
                      </div>
                    
                      <div class="form-group">
                        <input type="tel" class="form-control" name="phone" placeholder="Phone Number" pattern="[0-9]{11}" maxlength="11" required>
                      </div>
                      
                      <div class="form-group">
                        <input type="submit" value="REGISTER" name="register" class="btn btn-primary py-3 px-5">
                      </div>
                    </form>
                  
                  </div>


	          </div>
	        </div>
        </div>
      </div>

    </section>





    <?php require_once('footer.php') ?>