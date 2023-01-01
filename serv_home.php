<?php

include('header.php');
include('config.php');

if (empty($_SESSION['username'])) {

	header('location:customer_login.php');
}
?>



<!DOCTYPE html>

<head>
	<meta charset="UTF-8">
	<title>Home Services</title>
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
			<h1 style="color:#e0dede;">Home Services</h1>
			<br>
			<div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
				<div class="col-xl-6 col-lg-8">
					<div class="col-lg-13 mt-3 mt-lg-0 ">
						<!---->

						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"  enctype="multipart/form-data" class="order">
							<h4>
								<fieldset>
									<h2>Car Details</h2>

									<h4 style="text-align:left;  color:white;">Car Type</h4>
									<input type="text" name="car_type" class="form-control">

									<h4 style="text-align:left;  color:white;">Car Model</h4>
									<input type="text" name="car_model" class="form-control">

									<h2 >Select Services</h2>
									<div class="row" style="text-align:left "; >								
									
									
										<div class="col-6">
											
											<input type="checkbox" name="fix_rims" value="Fix Rims">
											<label style="color:white; font-size:20px">Fix Rims</label>
										</div>
										<div class="col-6">

											
											<input type="checkbox" name="change_car_oil" value="Change Car Oil">
											<label style="color:white; font-size:20px">Change Car Oil</label>
										</div>
										

									</div>

									<div class="row " style="text-align:left ">	

									<div class="col-6">
										
											<input type="checkbox" name="engine_flush" value="Engine Flush">
											<label style="color:white; font-size:20px">Engine Flush</label>
										</div>
										<div class="col-6">
										
											<input type="checkbox" name="k_miles_service" value="10k Miles Servic">
											<label style="color:white; font-size:20px">10k Miles Service</label>
										</div>
									</div>
									
									<br>
									<h4 style="text-align:left;  color:white;">Date</h4>
									<input type="date" name="date_op" class="form-control">

									<h4 style="text-align:left;  color:white;">Time</h4>
									<input type="time" name="time_op" class="form-control">

									<h4 style="text-align:left;  color:white;">Loction</h4>
									<input type="text" name="loction_op" class="form-control">
								</fieldset>
							

								<fieldset>
									<h2>Payment</h2>
									<h4>


										<label for="stcpay" style="color:white;"> STC Pay</label>
										<input type="radio" id="stcpay" name="payment_method" value="stcpay">
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<label for="Bank_Transfer" style="color:white;"> Bank Transfer</label>
										<input type="radio" id="Bank_Transfer" name="payment_method" value="Bank_Transfer">
										<input type="file" name="image" style="color:white;">
									</h4>
								</fieldset>
								

								<fieldset>
									<h2>Customer Details</h2>
									<input type="hidden" name="user_id" placeholder="<?php echo $_SESSION["user_id"]; ?>" readonly>
									<h4 style="text-align:left;  color:white;">Username</h4>
									<input type="text" name="user_name" class="form-control" placeholder="<?php echo $_SESSION["username"]; ?>" readonly>

									<h4 style="text-align:left;  color:white;">Phone Number</h4>
									<input type="tel" name="customer_contact" class="form-control" placeholder="<?php echo $_SESSION["phone"]; ?>" readonly>


									<br><br>
									<input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
								</fieldset>
							</h4>
						</form>



						<!---->
					</div>
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

//CHeck whether submit button is clicked or not
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$serv_id = "07";
	$serv_name = "Home Services";
	$stat = "Requested";  // Requested, On in progress, Finished, Cancelled
	$user_id = $_SESSION["user_id"];
	$user_name = $_SESSION["username"];
	$customer_contact = $_SESSION["phone"];

	$car_type = $_POST['car_type'];
	$car_model = $_POST['car_model'];

	$payment_method = $_POST['payment_method'];

	
if(empty($_POST['fix_rims'])){
	$fix_rims = 'null';
}else{
	$fix_rims ='OK';
}

if(empty($_POST['change_car_oil'])){
$change_car_oil =  'null';
}else{
	$change_car_oil =  'OK';	
}


if(empty($_POST['engine_flush'])){
	$engine_flush =  'null';
	}else{
		$engine_flush =  'OK';	
	}

	if(empty($_POST['k_miles_service'])){
		$k_miles_service =  'null';
		}else{
			$k_miles_service = 'OK';
		}

		if(empty($_POST['date_op'])){
			$date_op =  'null';
			}else{
				$date_op = $_POST['date_op'];	
			}
		
			if(empty($_POST['time_op'])){
				$time_op =  'null';
				}else{
					$time_op = $_POST['time_op'];	
				}
				if(empty($_POST['loction_op'])){
					$loction_op =  'null';
					}else{
						$loction_op = $_POST['loction_op'];	
					}
	/////////////upload image/////////////////////////
	if(isset($_FILES['image']['name']))
	{
		//Get the details of the selected image
		$image_name = $_FILES['image']['name'];

		}else{
		$image_name = "null"; //SEtting DEfault Value as blank
	}
//////////////////////////////////////////////////





	$sql = "INSERT INTO serv_home (serv_id,serv_name,stat,user_id,user_name,customer_contact,car_type,
	car_model, fix_rims,change_car_oil,engine_flush,k_miles_service,payment_method,date_op,time_op,loction_op,image_name) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

	if ($stmt = $conn->prepare($sql)) {
		// Bind variables to the prepared statement as parameters
		$stmt->bind_param(
			"sssssssssssssssss",
			$param_serv_id,
			$param_serv_name,
			$param_stat,
			$param_user_id,
			$param_user_name,
			$param_customer_contact,

			$param_car_type,
			$param_car_model,
			$param_fix_rims,
			$param_change_car_oil,
			$param_engine_flush,
			$param_k_miles_service,
			$param_payment_method,

			$param_date_op,
			$param_time_op,
			$param_loction_op,
			$param_image_name
		);

		// Set parameters



		$param_serv_id = $serv_id;
		$param_serv_name = $serv_name;
		$param_stat = $stat;
		$param_user_id = $user_id;
		$param_user_name = $user_name;
		$param_customer_contact = $customer_contact;

		$param_car_type = $car_type;
		$param_car_model = $car_model;
		$param_fix_rims = $fix_rims;
		$param_change_car_oil = $change_car_oil;

		$param_payment_method = $payment_method;

		$param_engine_flush = $engine_flush;
		$param_k_miles_service = $k_miles_service;
		$param_date_op = $date_op;
		$param_time_op = $time_op;
		$param_loction_op = $loction_op;
		$param_image_name=$image_name;


		// Attempt to execute the prepared statement
		if ($stmt->execute()) {
			// Redirect to login page
			echo		"<script type='text/javascript'>
alert('The Request has been sent successfully');
window.location = 'index.php';</script>";
		} else {
			echo		"<script type='text/javascript'>
			alert('please complete information. !!!');
			window.location = './services.php';</script>";
		}
	}
	// Close statement
	$stmt->close();
	$conn->close();
}
// Close connection

?>
<?php
include('footer.php');
?>