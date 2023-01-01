

<?php

 include('header.php'); 
 include('config.php'); 
	// Define variables and initialize with empty values
	$username = $password = "";
	$username_err = $password_err ="";
	 
	// Processing form data when form is submitted
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
	// $usertype=trim($_POST["usertype"]);
		// Check if username is empty
		if(empty(trim($_POST["username"]))){
			$username_err = "Please enter username.";
		} else{
			$username = trim($_POST["username"]);
		}
		
		// Check if password is empty
		if(empty(trim($_POST["password"]))){
			$password_err = "Please enter your password.";
		} else{
			$password = trim($_POST["password"]);
		}
	
		
		// Validate credentials
		if(empty($username_err) && empty($password_err)){
			// Prepare a select statement


			$sql = "SELECT user_id, user_name,user_email,user_phone ,user_address, user_pass FROM user WHERE user_name = ?";
			
			if($stmt = $conn->prepare($sql)){
				// Bind variables to the prepared statement as parameters
				$stmt->bind_param("s", $param_username);
				
				// Set parameters
				$param_username = $username;
				
				// Attempt to execute the prepared statement
				if($stmt->execute()){
					// Store result
					$stmt->store_result();
					
					// Check if username exists, if yes then verify password
					if($stmt->num_rows == 1){                    
						// Bind result variables
						$stmt->bind_result($user_id, $username, $email,$phone,$address,$hashed_password);
						// $stmt->fetch() will fetch results from a prepared statement into
						// the bound variables
						if($stmt->fetch()){
							//  password_verify ( string $password , string $hash ) : bool
							//	password : The user's password.
							//  hash : A hash created by password_hash().
							if(password_verify($password, $hashed_password)){
								
								// Password is correct, so start a new session
								session_start();
								
								// Store data in session variables
								$_SESSION["loggedin"] = true;
								$_SESSION["user_id"] = $user_id;
								$_SESSION["username"] = $username;
								$_SESSION["email"] = $email;
								$_SESSION["phone"] = $phone;
								$_SESSION["address"] = $address;
								header("location:index.php");
								
							} // end of if(password_verify($password, $hashed_password))
							else{
								// Display an error message if password is not valid
								$password_err = "The password you entered was not valid.";
							}
						} // end of $stmt->fetch()
					} // end of if($stmt->num_rows == 1)
					else{
						// Display an error message if username doesn't exist
						$username_err = "No account found with this username.";
					}
				}  // end of if($stmt->execute())
				else{
					echo "Oops! Something went wrong. Please try again later.";
				}
			} // End of if($stmt = $conn->prepare($sql))
			
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
    <title>customer Login</title>
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

    <section id="login" class="d-flex align-items-center justify-content-center">
    
    <div class="container" data-aos="fade-up">
<h1>Customer Login</h1>
      <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
        <div class="col-xl-6 col-lg-8">
            <div class="col-lg-13 mt-3 mt-lg-0 ">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" role="form" >
              <div class="row">
               </div>                        
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="username"  placeholder="Username" required>
                <span class="text-danger"><?php echo $username_err; ?></span>
              </div>
              <div class="form-group mt-3">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
                  <span class="text-danger"><?php echo $password_err; ?></span>
              </div>
              <br>
              
              
                
			<div class="text-center">
             <input type="submit" class="btn btn-warning" value="login" class="get-started-btn scrollto"> 
            </div>
			
              
            
           	<a href="./admin_login.php"> <div class="text-center"><button class="btn btn-link" type="button" style="color: white;"> Admin Login </button></a></div>
           	<a href="customer_signup.php"> <div class="text-center"><button class="btn btn-link" type="button" style="color: white;"> Don't have an account? Signup </button></a></div>

            </form>

          </div>
         

        </div>
      </div>
      </section><!-- End login class="php-email-form"-->

 
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