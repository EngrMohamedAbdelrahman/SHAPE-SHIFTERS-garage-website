<?php

 include('header.php'); 

include('config.php');
	 
	// Define variables and initialize with empty values
	$user_name =	$user_pass = $confirm_password =$user_email=$user_phone="";
	$username_err = $password_err = $confirm_password_err = "";
	 
	// Processing form data when form is submitted
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		
	    $user_fname= trim($_POST["fname"]);
		$user_lname= trim($_POST["lname"]);
		$user_username= trim($_POST["user_name"]);
		$user_email= trim($_POST["email"]);
		$user_phone= trim($_POST["phone"]);
		$user_country= trim($_POST["country"]);
		$user_city= trim($_POST["city"]);
		$user_address= trim($_POST["user_address"]);
		$user_zipcode= trim($_POST["zipcode"]);
		
		// Validate user_name 
		// The trim() function removes white space from both sides(left and right) of a string
		if(empty(trim($_POST["user_name"]))){
			$username_err = "Please enter a user_name.";
		} else{
			// Prepare a select statement
			$sql = "SELECT user_id FROM user WHERE user_name=?";
			
			if($stmt = $conn->prepare($sql)){
				// Bind variables to the prepared statement as parameters
				$stmt->bind_param("s", $param_username);
				
				// Set parameters
				$param_username = trim($_POST["user_name"]);
				
				// Attempt to execute the prepared statement
				if($stmt->execute()){
					// store result
					$stmt->store_result();
					
					if($stmt->num_rows == 1){
						echo"<script type='text/javascript'>
   alert('This user_name is already taken');
   window.location = 'customer_signup.php';</script>" ;
					} else{
						$user_name = trim($_POST["user_name"]);
					}
				} else{
					echo "Oops! Something went wrong. Please try again later.";
				}
			}	 
			// Close statement
			$stmt->close();
		}
		
		// Validate user_pass
		if(empty(trim($_POST["user_pass"]))){
			$password_err = "Please enter a user_pass.";     
		} elseif(strlen(trim($_POST["user_pass"])) < 8){
			
			echo"<script type='text/javascript'>
   alert('Password must have atleast 8 characters.');
   window.location = 'customer_signup.php';</script>" ;
		} else{
			$user_pass = trim($_POST["user_pass"]);
		}
		
		// Validate confirm user_pass
		if(empty(trim($_POST["confirm_password"]))){
			$confirm_password_err = "Please enter confirm user_pass.";     
		} else{
			$confirm_password = trim($_POST["confirm_password"]);
			if(empty($password_err) && ($user_pass != $confirm_password)){
				
						echo"<script type='text/javascript'>
   alert('Password did not match.');
   window.location = 'customer_signup.php';</script>" ;
			}
		}
		
		// Check input errors before inserting in database
		if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
		{


			// Prepare an insert statement $user_phone=$id_no=$companyname= $companyfield=$aboutcompany=
			$sql = "INSERT INTO user (Fname,Lname,user_name ,user_email, user_pass ,user_phone,user_address,country,city,zipcode) VALUES (?,?,?,?,?,?,?,?,?,?)";
	
			if($stmt = $conn->prepare($sql)){
				// Bind variables to the prepared statement as parameters
				$stmt->bind_param("ssssssssss",$param_Fname,$param_Lname, $param_username, $param_email, $param_password,$param_phone,$param_address,$param_country,$param_city,$param_zipcode);
				
				// Set parameters
				
				$param_Fname = $user_fname;
				$param_Lname = $user_lname;
				$param_username = $user_name;
				$param_email =$user_email;
				$param_phone= $user_phone;
				$param_address=$user_address;
				$param_city=$user_city;
				$param_country=$user_country;
				$param_zipcode=$user_zipcode;
				
		
		       
				$param_password = password_hash($user_pass, PASSWORD_DEFAULT); 
				// Creates a user_pass hash
				
				// Attempt to execute the prepared statement
				if($stmt->execute()){
					// Redirect to login page
					echo		"<script type='text/javascript'>
   alert('New User Registered');
   window.location = 'customer_login.php';</script>" ;
				} else{
					echo "Something went wrong. Please try again later.";
				}
			} 
			// Close statement
			$stmt->close();
		}
    // Close connection
    $conn->close();
}
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Customer Signup</title>
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
<h1 style="color:#e0dede;">Customer Signup</h1>
<br>
<div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
        <div class="col-xl-6 col-lg-8">
            <div class="col-lg-13 mt-3 mt-lg-0 ">
           
		   <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			
              <div class="row">
               </div>
     <h2>Personal Information</h2>                      
              <div class="form-group mt-100">
                <input type="text" class="form-control" name="fname" id="fname" placeholder="First Name" required>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name" required>
              </div>
              
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Username" required>
              </div>
              
              
              <div class="form-group mt-3">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" required>
              </div>
               <div class="form-group mt-3">
                <input type="password" class="form-control" name="user_pass" id="user_pass" placeholder="Password" required>
              </div>
              <div class="form-group mt-3">
                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
              </div>
              <div class="form-group mt-3">
                <input type="phone" class="form-control" name="phone" id="phone" placeholder="Phone Number" required>
              </div>
              
              <br>
        <h2>Address Information</h2>                      
              <div class="form-group mt-30">
                <input type="text" class="form-control" name="country" id="country" placeholder="Country" required> <!--dropdown-->
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="city" id="city" placeholder="City" required>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="user_address" id="user_address" placeholder="Address" required>
              </div>
               <div class="form-group mt-3">
                <input type="number" class="form-control" name="zipcode" id="zipcode" placeholder="Zip Code" required>
              </div>
              
              
              <br>
              <div class="text-center">
			  <input type="submit" class="btn btn-warning" value="Signup" >
			  
			  </div>
            
           	<a href="customer_login.php"> <div class="text-center"><button class="btn btn-link" type="button" style="color: white;"> Already have an account? Login </button></a></div>

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