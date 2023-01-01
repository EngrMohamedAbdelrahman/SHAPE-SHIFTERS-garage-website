
<?php  include('header.php');  

// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
  include('config.php');
    
	$user_id=$_GET["id"];
	$user_id=$_SESSION['user_id'];
    // Prepare a select statement
    $sql = "SELECT * FROM user WHERE user_id = '".$user_id."'";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
       // mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = $user_id;
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
             
                // Retrieve individual field value
                $user_id = $row['user_id'];
				$user_name = $row['user_name'];
				$user_email = $row['user_email'];
				$user_phone = $row['user_phone'];
				$user_address = $row['user_address'];
								
		$user_fname= $row['Fname'];
		$user_lname= $row['Lname'];
		$user_country= $row['country'];
		$user_city= $row['city'];		
		$user_zipcode= $row['zipcode'];
                
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($conn);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Customer info.</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
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

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
    
</head>
<body>
 
  
    <section id="signup" class="d-flex align-items-center justify-content-center">
    
    <div class="container" data-aos="fade-up">
<h1 style="color:#e0dede;">Customer info.</h1>
<br>
<div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
        <div class="col-xl-6 col-lg-8">
            <div class="col-lg-13 mt-3 mt-lg-0 ">
           
		   <form action="update_data.php" method="post">
			
              <div class="row">
               </div>
     <h2>Personal Information</h2> 
				 <input type="text" class="form-control" name="user_id" id="user_id" value="<?php echo $user_id; ?>" hidden >
				  <div class="form-group mt-100">
                <input type="text" class="form-control" name="user_name" id="user_name" value="<?php echo $user_name; ?>" readonly >
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="fname" id="fname" value="<?php echo $user_fname; ?>"  >
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="lname" id="lname" value="<?php echo $user_lname; ?>"  >
              </div>
              
             
              
              
              <div class="form-group mt-3">
                <input type="email" class="form-control" name="email" id="email" value="<?php echo $user_email; ?>">
              </div>
             
              <div class="form-group mt-3">
                <input type="phone" class="form-control" name="phone" id="phone" value="<?php echo $user_phone; ?>">
              </div>
              
              <br>
        <h2>Address Information</h2>                      
              <div class="form-group mt-30">
                <input type="text" class="form-control" name="country" id="country" value="<?php echo $user_country; ?>"> 
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="city" id="city" value="<?php echo $user_city; ?>">
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="user_address" id="user_address" value="<?php echo $user_address; ?>"
              </div>
               <div class="form-group mt-3">
                <input type="text" class="form-control" name="zipcode" id="zipcode" value="<?php echo $user_zipcode; ?>">
              </div>
              
              
              <br>
              <div class="text-center">
			 
			  <input type="submit"  class="btn btn-warning" name="Submit" value="save edit">
						
			  </div>
            


            </form>

          </div>
         

        </div>
      </div>
      </section><!-- End login -->



   <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
</body>
</html>
<?php

include('footer.php'); 

					 
	 ?> 