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
	<title>outbox user messages</title>
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
			<h1 style="color:#e0dede;">Messages</h1>
			<br>
			

			<div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
				<div class="col-xl-10 col-lg-8">
					<div class="col-lg-10 mt-4 mt-lg-0 ">
						<!---->

                        
                
						<table class="tbl-full" >
               
						<tr>
						
                        <th width="8%"><h2>#</h2></th>
                        <th width="30%"><h2>Date</h2></th>
                        <th width="20%"><h2>Subject</h2></th>
						
                       
                        <th width="35%"><h2>Message</h2></th>
                        <th width="40%"><h2>Reply</h2></th>
						</h2>
                    </tr>
	
                    <?php 
					require_once "config.php";
                        //Get all the orders from database
						$user_id=$_SESSION['user_id'];

						//////////////////////
                     
					  $sql1= "SELECT *
                      FROM outbox_user_messages 				
                      WHERE user_id='".$user_id."'					   			
					  ";


                        $res1 = mysqli_query($conn,$sql1);
		
                        $count1 = mysqli_num_rows($res1);
		

                        $sn = 1; //Create a Serial Number and set its initail value as 1

                        if($count1>0)
                        {
                            //Order Available
                            while($row=mysqli_fetch_assoc($res1))
                            {
                                

                                ?>	

                                    <tr>
                                        <td style="text-align:left;  color:white;"><?php echo $sn++; ?> </td>
                                        <td style="text-align:left;  color:white;"><?php echo $row['date']; ?></td>
                                        <td style="text-align:left;  color:white;"><?php echo $row['msg_subject']; ?></td>                                      
                                        <td style="text-align:left;  color:white;"><?php echo $row['msg_message']; ?></td>
										<td style="text-align:left;  color:white;"><?php echo $row['msg_reply']; ?></td>
                                    </tr>
									
                                <?php

                            }
                        }
					
                    ?>

				   </div>
                </table>



						<!---->
					</div>
				</div>
			</div>
			<br>
			<br>
			
			<a href="customer_message.php"> <div class="text-center"><input type="submit"  class="btn btn-warning" name="Submit" value="Send New Message"></a></div>
		</div>
	</section>
	<!-- End login -->



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