<?php 
require_once('header.php'); 

if(!loggedin()){
  header('Location:index');
  exit();
}

if(isset($_POST['newMember'])){
  header('Location:registerMember');
  exit();
}

if(isset($_POST['attendance'])){
  header('Location:attendance');
  exit();
}

if(isset($_POST['addstaff'])){
  header('Location:staff');
  exit();
}


if(isset($_POST['cpass'])){
  header('Location:changepass');
  exit();
}
?>


	  <section class="home-slider js-fullheight owl-carousel dashboard-wrap">
      <div class="slider-item js-fullheight dashboard-wrap" style="background-image:url(images/bg_1.jpg);">
      	<div class="overlay"></div>
	        <div class="container">
	          <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center" data-scrollax-parent="true">
	          <div class="col-md-10 text-center ftco-animate mt-5">
                  
                <div class="col-md-12 order-md-last">
                    <form action="#" method="POST" class="bg-light p-4 p-md-5 contact-form">
                        <div class="login-header">BACK OFFICE DASHBOARD</div>
                        <div class="dashboard-form">
                        <div class="write-data">
                            <div class="form-group">
                                <input type="submit" value="Register New Member" name="newMember" class="btn btn-primary py-3 px-5 form-group">
                              </div>

                              <div class="form-group">
                                <input type="submit" value="Register New Admin" name="addstaff" class="btn btn-primary py-3 px-5 form-group">
                              </div>

                            <div class="form-group">
                                <input type="submit" value="Write Attendance" name="attendance" class="btn btn-primary py-3 px-5 form-group">
                              </div>
                        </div>

                        <div class="read-data">
                            <div class="form-group">
                                <input type="submit" value="View Members" class="btn btn-primary py-3 px-5 form-group">
                              </div>

                            <div class="form-group">
                                <input type="submit" value="Attendance Register" class="btn btn-primary py-3 px-5 form-group">
                              </div>

                              <div class="form-group">
                                <input type="submit" value="Change Your password" name="cpass" class="btn btn-primary py-3 px-5 form-group">
                              </div>
                        </div>
                        </div>
                     
                      
                      
                    </form>
                  
                  </div>


	          </div>
	        </div>
        </div>
      </div>

    </section>



    <?php require_once('footer.php') ?>