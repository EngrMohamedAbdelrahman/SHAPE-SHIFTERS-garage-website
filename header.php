<?php
 
include('config.php');  //include connection file
error_reporting(0);  // using to hide undefine undex errors
session_start(); //start temp session until logout/browser closed

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Shape Shifters Garage </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">


  <link href="assets/css/style.css" rel="stylesheet">

 
</head>
<body>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center justify-content-lg-between">
 <a href="index.php" class="logo me-auto me-lg-0"><img src="assets/img/LOGO.png" alt="" class="img-fluid"></a>
      <h1 class="logo me-auto me-lg-0"><a href="index.php">SHAPE-SHIFTERS <br> GARAGE<span>.</span></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
     

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="index.php?#hero">HOME</a></li>
          <li><a class="nav-link scrollto" href="index.php?#about">ABOUT US</a></li>
          <li><a class="nav-link scrollto" href="index.php?#services">SERVICES</a></li>
          <li><a class="nav-link scrollto " href="index.php?#portfolio">PROJECTS</a></li>
          <li><a class="nav-link scrollto" href="index.php?#team">TEAM</a></li>
          <li><a class="nav-link scrollto" href="index.php?#contact">CONTACT</a></li>
     
      
 
    
 <?php

						if(!(empty($_SESSION["user_id"]))) // if user is not login
						
							{
												$user_id=$_SESSION["user_id"];
												$user_name=$_SESSION["username"];
								echo  '	
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Welcome : '.$user_name.' <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="customer_data.php?id='.$user_id.'" >User Info</a></li>
          <li><a href="user_requests.php" >User Requests</a></li>
        
          <li><a href="outbox_user_messages.php" > Messages</a></li>
       
          <li><a href="logout.php" >Logout</a></li>
		 
        </ul>
      </li>	';		

							}

						?>

  </ul>
   </nav>
   
  <?php  
if(empty($_SESSION["user_id"])) // if user is not login
							{
								echo '<a href="customer_login.php" class="get-started-btn scrollto">Login</a> 
	  <a href="customer_signup.php" class="get-started-btn scrollto">Signup</a> ';
							}
?>
    </div>
  </header><!-- End Header -->

</body>

</html>
	
	  