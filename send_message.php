<?php 
 
	

include('config.php');



       
				
		if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		 
		$user_id = $_POST['user_id'];
				
	
		$user_username= trim($_POST["user_name"]);
		$subject= trim($_POST["msg_subject"]);
		$message= trim($_POST["msg_message"]);
	
	
		$sql = "INSERT INTO outbox_user_messages (user_id,user_name,msg_subject,msg_message) VALUES (?,?,?,?)";
	
	if($stmt = $conn->prepare($sql)){
		// Bind variables to the prepared statement as parameters
		$stmt->bind_param("ssss",$param_user_id,
		$param_user_name ,
		$param_subject ,
		$param_message,
		);
		
		// Set parameters
		


		$param_user_id =$user_id;
		$param_user_name =$user_username;
		$param_subject= $subject;
		$param_message=$message;
		
	   
		
		// Attempt to execute the prepared statement
		if($stmt->execute()){
			// Redirect to login page
			echo		"<script type='text/javascript'>
alert('Message sent successfully');
window.location = 'index.php';</script>" ;
		} else{
			echo		"<script type='text/javascript'>
			alert('please complete Message. !!!');
			window.location = './services.php';</script>";
		}
	} 
	// Close statement
	$stmt->close();
	$conn->close();
}
// Close connection

?>