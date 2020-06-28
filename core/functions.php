 <?php 

       // this includes all my funtions
		
function cleanUri($str, $delimiter='-', $replace=array(), $charset='UTF-8') {
		$str = trim($str);
		$lat_search = array('�','d','c','c','�','�','�','C','C','�');
		$lat_replace = array('s','d','c','c','z','s','d','c','c','z');
		$str = str_replace($lat_search, $lat_replace, $str);
		$str = iconv($charset, 'UTF-8', $str);
		
		if ( !empty($replace) ) $str = str_replace((array)$replace, ' ', $str);
		
		$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
			
		return $clean;
	}	

	
	
  function loggedin(){
	global $connection;
   if(isset($_SESSION["user"]) && isset($_COOKIE['sessionkey'])){
   $user = $_SESSION["user"];
   $key = $_COOKIE['sessionkey'];
 if(mysqli_num_rows(mysqli_query($connection,"SELECT * FROM staff WHERE sessionkey = '$key'")) > 0)
   return true;
} else
  { 
  return false;
   }	
 }
 

 
 
 
function clean($value){
	  global $connection;
      $magic_quotes_active = get_magic_quotes_gpc();
	  $new_enough_php = function_exists("mysqli_real_escape_string");//ie php >= 4.3.0
	  
	  if($new_enough_php){ // php 7.0 or heigher
	  //undo any magic quotes so mysql_real_escape_string do the work
	  if($magic_quotes_active){$value = stripslashes($value);}
	  
	  $value = mysqli_real_escape_string($connection,$value);
	  }
        else{ // php lower than 4.3.0
		//if magic quotes not on add slashes manually
		if(!$magic_quotes_active){$value = addslashes($value);}
		//if magic quotes is active then slashes already exit
		
		}
		return $value;
}
function Admin($user){
	   global $connection;
       if(loggedin()) {
       $query = mysqli_query($connection,"SELECT * FROM staff WHERE username = '$user'");
	   while($Admin = mysqli_fetch_array($query)){
	   if($Admin['role'] == "Admin"){
	   return true;
	      }
	   else{
	      return false;
	   }
	    }  
		  }
   }
   
 function currbalance($accno){ 
	global $connection;
	//get current balance 
	$sql = "SELECT balance FROM customers WHERE accno='".$accno."' "; 
	$res=mysqli_query($connection,$sql); 
	 if(!$res){ 
	         throw new Exception(mysql_error()); 
	       }else{ 
	       $row = mysqli_fetch_array($res); 
	       $currbal=$row['balance']; 
	       return $currbal; 
	       } 
	
	} 
	
	
function setbalance($accno,$bal){ 
	global $connection;
	//update current balance 
	$sql = "UPDATE customers SET balance='".$bal."' WHERE accno='".$accno."'"; 
	if(!mysqli_query($connection,$sql)){ 
	         throw new Exception(mysqli_error()); 
	       }else{ 
		   return TRUE;
		   } 
	        
	} 	
	
function writestatement($teller,$accno,$txntype,$amount,$bal,$narration){ 
	global $connection;
	  $time = date('d-M-Y');
	//write Statement of Account 
	$sqlquery = "INSERT INTO statement SET 
	date = '$time',
	teller = '$teller',
	accno = '$accno',
	txntype = '$txntype',
	amount = '$amount',
	balance ='$bal',
	narration ='$narration'"; 
	$Result = mysqli_query($connection,$sqlquery) or die("error ".mysqli_error());
	if($Result){
		return TRUE;
	}
	        
	} 	

	
function maindate($time)
{
$time = date('l jS F Y \a\t g:I A');
return $time;
}

function maindate2($time)
{
$ftime = date('D-d-M-Y',strtotime($time));
return $ftime;
}
function newdate($time){
$stime = date("g-i a",strtotime($time));
return $stime;
}
function redirect_to($location){
  header("Location:$location");
exit;
}



 function format($name) 
    {
        $f1 = strrpos($name, ".");
        $f2 = substr($name, $f1 + 1, 999);
        $fname = strtolower($f2);

        return $fname;
    }
	
	
	function validatePhone($string) {
    $numbersOnly = ereg_replace("[^0-9]", "", $string);
    $numberOfDigits = strlen($numbersOnly);
    if ($numberOfDigits == 11 ) {
       return true;
    } else {
        return false;
    }
}
	
	
// the function.php file ends here
?>