<html>
<head> 
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/login.css">
  <link rel="stylesheet" href="css/theme.css">
  <link rel="stylesheet" href="css/scrollbar.css">
</head>
<header>
<img  src="images/edpl-logo.png" width="300" height="80" style="padding-left:2%;" />
</header>
<body>
<?php 

if(isset($_POST['register'])) {

include "db.php";

function validate($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

date_default_timezone_set('Asia/Kolkata');
$reg_date = date('Y-m-d');

$error = array();
   
    if (empty($_POST['email'])) {
        $error[] = 'Please Enter your Email ';
    } else {

        if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['email'])) {
         
            $email = $_POST['email'];
        } else {
             $error[] = 'Your Email Address is invalid  ';
        }
    }
  
   if(!empty($_POST['password'])) {
   $password = validate($_POST['password']);
  }else {
   $error[] = "Please check your Password";
  }
  
   if(!empty($_POST['usertype'])) {
  $usertype = validate(strtolower($_POST['usertype']));
  }else {
   $error[] = "Please check UserType";
  }    
  
 
  if(empty($error)) {
	  
	  $login_sql = "INSERT into registration WHERE email ='$email' AND password = '$password' AND usertype='$usertype' ";
	  $result = mysqli_query($dbc, $login_sql) or die(mysqli_error($dbc));
	  
	  if(mysqli_num_rows($result) == '1') {
		  
		 

                   session_start();
		 $_SESSION = mysqli_fetch_assoc($result);
              /*   $_SESSION['email'] = $result['email'];
                 $_SESSION['usertype']  = $result['usertype'];
                 $_SESSION['id']  = $result['id'];
                */
		  if($usertype == 'admin') {
			  echo '<script type="text/javascript"> window.location = "taskallotment/task.php"  </script>';
		               
		      } elseif ($usertype == 'mentor') {
			                 echo '<script type="text/javascript"> window.location = "mentor/" </script>';
		         } else {
			                      echo '<script type="text/javascript"> window.location = "interndashboard.php"  </script>';
		  }
		  
		  
	  } else {
		   echo "<h5 style='color:red; font-weight:bold; text-align:center;'> Invalid Login </h5>";
	  }
	  	  
	  
  }else {
	  foreach($error as $key) {
		  echo "<li style='text-align:left;'>". $key ."</li>";
	  }
	  
  }
  
  

}

?>
  <style>
@media only screen and (max-width: 650px) {
    form {
        background: teal!important;
        background-repeat:repeat;
        background-image: none;
    }
  footer p {
 color:#000;
}
}
</style>									
					<!-- Result of Invalid login appears here -->
<form action="" method="POST" class="w3-container" style="padding-top:2%;">	
<div class="w3-row-padding">
<div class="w3-half">

  <div class="w3-card">
  <div class="w3-container w3-teal">
    <h1><b>Personal Details</b></h1>
  </div>

  <div class="w3-container" id>
   <p><input type="text" name="name" class="w3-input w3-border w3-round" placeholder ="Name" required /></p>

    <p><input type="email" name="email" class="w3-input w3-border w3-round" placeholder ="Email" required /></p>

    <p><input type="text" name="mobile" class="w3-input w3-border w3-round" placeholder ="Mobile" required /></p>

    <p><input type="text" name="fb" class="w3-input w3-border w3-round" placeholder ="Facebook (fb.com/rahul78275)"></p>

    <p><input type="text" name="twitter" class="w3-input w3-border w3-round" placeholder ="Twitter (twitter.com/rahul78275)"></p>
<br>
  </div>
  </div>
  <br>
</div>

<div class="w3-half">

  <div class="w3-card">
  <div class="w3-container  w3-teal">
    <h1><b>Official Details</b></h1>
  </div>

  <div class="w3-container">
   <p><input type="text" name="department" class="w3-input w3-border w3-round" placeholder ="Department" required /></p>

    <p><input type="text" name="designation" class="w3-input w3-border w3-round" placeholder ="Designation" required /></p>

    <p style="color:#fff;">Profile Picture<input type="file" name="profile_pic" class="w3-input w3-border w3-round" required /></p>

    <p><textarea type="text" name="aboutme" rows="3" class="w3-input w3-border w3-round" placeholder ="About Me" ></textarea></p>
  </div>
  
  </div>

  <br>

</div>
    <div class="w3-container">
     <center> <button type="submit" name="register" class="w3-btn w3-orange" style="color:#fff!important;">Register</button></center>
    </div><br>
</div>
</form>	

<footer class="footer">
<div class="w3-container">
<p style="float:right;">Designed By : Rahul kumar </p>
</div>
</footer>
	
	</body>
	</html>