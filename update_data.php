<?php 
 
	

include('config.php');



       
				
		if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		 
		$user_id = $_POST['user_id'];
				
		$user_fname= trim($_POST["fname"]);
		$user_lname= trim($_POST["lname"]);
		$user_username= trim($_POST["user_name"]);
		$user_email= trim($_POST["email"]);
		$user_phone= trim($_POST["phone"]);
		$user_country= trim($_POST["country"]);
		$user_city= trim($_POST["city"]);
		$user_address= trim($_POST["user_address"]);
		$user_zipcode= trim($_POST["zipcode"]);
	
		$query = "UPDATE user SET Fname ='".$user_fname."' ,Lname ='".$user_lname."' , user_email ='".$user_email."',user_phone ='".$user_phone."',user_address ='".$user_address."'
		,country ='".$user_country."' ,city ='".$user_city."',zipcode ='".$user_zipcode."'
		WHERE user_id='".$user_id."'";

		$result = $conn->query($query);
		if(!$result){
			echo "UPDATE failed: $query <br>" . $conn->error . "<br><br>";
		}else{
		echo	"<script type='text/javascript'>
   alert('Data saved');
   window.location = 'index.php';</script>" ;
	$stmt->close();
	}
	

	
	}//end of if
?>