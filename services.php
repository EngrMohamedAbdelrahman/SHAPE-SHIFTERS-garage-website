<?php

 include('header.php'); 

	 
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
    <title>SERVICES</title>
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
  
  <section id="services" class="services" >
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Services</h2>
         
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i > <img src="assets/img/hardware.png" alt="" class="img-fluid"> </i></div>
              <h4><a href="#Repairs">Repairs</a></h4>
              <p>Engine rebuilding or reconditioning of motor vehicles collision service such as body, frame and fender straightening and repair and painting of motor vehicles.</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i><img src="assets/img/tools.png" alt="" class="img-fluid"></i></div>
              <h4><a href="#Customization">Customization</a></h4>
              <p>Altering the vehicle to improve its performance, often by replacing the engine and transmission; made into a personal "styling" statement, using paint work and aftermarket accessories to make the car look unlike any car as delivered from the factory.</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i><img src="assets/img/house.png" alt="" class="img-fluid"></i></div>
              <h4><a href="#Homeservice">Home service</a></h4>
              <p>A unique service of repairing and changing the car parts at your home, just book an appointment and we'll be at your service.</p>
            </div>
          </div>

         

        </div>

      </div>
    </section>
	    </section>


<section id="Repairs" class="team">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Repairs</h2>
         
        </div>

        <div class="row">

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="100">
              <div class="member-img">
                <img src="assets/img/portfolio/Brake_Services.jpg" class="img-fluid" width="512px" height="512px" alt="">
               
              </div>
              <div class="member-info">
                <h4>Brake Services</h4>
              <a href="./serv_brake.php"> <input type="button"  class="btn btn-warning" name="Submit" value="Request Service"></a>
				
				
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="200">
              <div class="member-img">
                <img src="assets/img/portfolio/work_r.jpg" class="img-fluid" width="512px" height="512px" alt="">
               
              </div>
              <div class="member-info">
                <h4>Engine Services</h4>
                  <a href="./serv_engine.php"> <input type="button"  class="btn btn-warning" name="Submit" value="Request Service"></a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="300">
              <div class="member-img">
                <img src="assets/img/team/team-3.jpg" class="img-fluid" width="512px" height="512px" alt="">
               
              </div>
              <div class="member-info">
                <h4>Cooling System and Radiatar Services</h4>
                 <a href="./serv_cooling.php"> <input type="button"  class="btn btn-warning" name="Submit" value="Request Service"></a>
              </div>
            </div>
          </div>

          

        </div>

      </div>
    </section>
	
	
	
	<section id="Customization" class="team">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Customization</h2>
         
        </div>

        <div class="row">

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="100">
              <div class="member-img">
                <img src="assets/img/portfolio/mercedes_c.jpg" class="img-fluid" width="512px" height="512px" alt="">
                
              </div>
              <div class="member-info">
                <h4>Paint Job Services</h4>
                 <a href="./serv_paint.php"> <input type="button"  class="btn btn-warning" name="Submit" value="Request Service"></a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="200">
              <div class="member-img">
                <img src="assets/img/portfolio/rims_hs.jpg" class="img-fluid" width="512px" height="512px" alt="">
               
              </div>
              <div class="member-info">
                <h4>Rims Services</h4>
                 <a href="./serv_rims.php"> <input type="button"  class="btn btn-warning" name="Submit" value="Request Service"></a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="300">
              <div class="member-img">
                <img src="assets/img/portfolio/bottom_r.jpeg" class="img-fluid" width="512px" height="512px" alt="">
               
              </div>
              <div class="member-info">
                <h4>Suspension Services</h4>
                 <a href="./serv_suspension.php"> <input type="button"  class="btn btn-warning" name="Submit" value="Request Service"></a>
              </div>
            </div>
          </div>

          

        </div>

      </div>
    </section>
	
	
	
	<section id="Homeservice" class="team">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Home service</h2>
         
        </div>

        <div class="row">

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="100">
              <div class="member-img">
                <img src="assets/img/portfolio/oil_hs.jpg" class="img-fluid" width="512px" height="512px" alt="">
                
              </div>
              <div class="member-info">
                <h4>OIL CHANGE</h4>
                <a href="./serv_home.php"> <input type="button"  class="btn btn-warning" name="Submit" value="Request Service"></a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="200">
              <div class="member-img">
                <img src="assets/img/portfolio/engine_hs.jpg" class="img-fluid" width="512px" height="512px" alt="">
               
              </div>
              <div class="member-info">
                <h4>ENGINE FLUSH</h4>
                 <a href="./serv_home.php"> <input type="button"  class="btn btn-warning" name="Submit" value="Request Service"></a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="300">
              <div class="member-img">
                <img src="assets/img/portfolio/rims_hs.jpg" class="img-fluid" width="512px" height="512px" alt="">
               
              </div>
              <div class="member-info">
                <h4>RIMS CHANGE</h4>
                <a href="./serv_home.php"> <input type="button"  class="btn btn-warning" name="Submit" value="Request Service"></a>
              </div>
            </div>
          </div>

          

        </div>

      </div>
    </section>
	
	
	


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