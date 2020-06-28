<?php require_once('header.php');

if(!loggedin()){
  header('Location:index');
  exit();
}


$errors = array();
$msg = '';
$today = date('Y-m-d');

if (isset($_POST['submit'])) {
$total = clean(trim($_POST['total']));	
$men = clean(trim($_POST['men']));
$wemen = clean(trim($_POST['wemen']));
$children = clean(trim($_POST['children']));
$date = clean(trim($_POST['date']));
$service = clean(trim($_POST['service']));
$staff = $_SESSION['user'];

$addedTotal = (int)$men + (int)$wemen + (int)$children;

if(empty($total) ){
   $errors[] = "Please Enter a Valid total Attendance";
}

if($total > $addedTotal || $total < $addedTotal ){
  $errors[] = "Please check your calculation. The total is Wrong";
}

if(empty($men) ){
  $errors[] = "Please Enter a Valid men Attendance";
}

if(empty($wemen) ){
  $errors[] = "Please Enter a Valid wemen Attendance";
}

if(empty($children) ){
  $errors[] = "Please Enter a children total Attendance";
}

if(empty($service) || $service === 'Service Type'){
      $errors[] = "Please choose a service Type";
   }
        
     
if(empty($date) || $date > $today){
       $errors[] = "You Entered a future date";
}else{
  $checkdate=mysqli_query($connection, "SELECT * FROM attendance WHERE date='$date'"); 
  if(mysqli_num_rows($checkdate)>0){
    $errors[] = "The Attendance on this date has already been taken.";
  }
}
 

 
if(empty($errors)){	 
  
   $query = "INSERT INTO attendance SET
   total = '$total',
   men = '$men',
   wemen = '$wemen',
   children = '$children',
   date = '$date',
   service = '$service',
   staff = '$staff'";

   $Result = mysqli_query($connection,$query) or die("error taking attendance ".mysqli_error($connection));
   if($Result)
{
$msg = 'Attendance for - '.$service.' has been successfully Registered';
 } else {
  $msg = "Please Review the form we could not Register ".$service;
 }

}
    
}

?>

	  <section class="home-slider js-fullheight owl-carousel attendance-wrap">
      <div class="slider-item js-fullheight attendance-wrap" style="background-image:url(images/bg_1.jpg);">
      	<div class="overlay"></div>
	        <div class="container">
	          <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center" data-scrollax-parent="true">
	          <div class="col-md-10 text-center ftco-animate mt-5">
                  
                <div class="col-md-12 order-md-last attendance-form">
                    <form action="?" method="POST" class="bg-light p-4 p-md-5 contact-form">
                        <div class="login-header">NOTE MEETING ATTENDANCE</div>
                        <div class="errors">
                             <?php foreach($errors as $error) echo $error.'<br />'; echo'<span class="success">'. $msg.'<span>' ?>
                        </div>
                      <div class="form-group">
                        <input type="number" class="form-control" name="total" placeholder="Total Attendance" required>
                      </div>

                      <div class="form-group">
                        <input type="number" class="form-control" name="men" placeholder="Number of Men" required>
                      </div>
                    
                      <div class="form-group">
                        <input type="number" class="form-control" name="wemen" placeholder="Number of Women" required>
                      </div>

                      <div class="form-group">
                        <input type="number" class="form-control" name="children" placeholder="Number of Children" required>
                      </div>

                      <div class="form-group">
                        <input type="date" class="form-control" name="date" placeholder="Service date" required>
                      </div>

                      <div class="form-group">
                          <select class="form-control" name="service">
                              <option>Service Type</option>
                              <option>Sunday Service</option>
                              <option>Bible Study</option>
                          </select>
                        
                      </div>
                      
                      <div class="form-group">
                        <input type="submit" value="SUBMIT" name="submit" class="btn btn-primary py-3 px-5">
                      </div>
                    </form>
                  
                  </div>


	          </div>
	        </div>
        </div>
      </div>

    </section>






    <?php require_once('footer.php') ?>