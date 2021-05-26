<?php
	$con = mysqli_connect("localhost", "id2397976_test", "test123", "id2397976_test");
	// $con = mysqli_connect("localhost", "root", "", "Gis");
	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}

	$response = array();


	function send_email($email,$code){

		$mailto = $email;
	    $mailSub = "GISBMS";
	    $mailMsg = "Your 6 Digit code is - ".$code;

	    require 'PHPMailer-master/PHPMailerAutoload.php';
	   	
	   	$mail = new PHPMailer();
	   	$mail ->IsSmtp();
	   	$mail ->SMTPDebug = 0;
		$mail ->SMTPAuth = true;
		$mail ->SMTPSecure = 'ssl';
		$mail ->Host = "smtp.gmail.com";
	   	$mail ->Port = 465; // or 587
	   	$mail ->IsHTML(true);
	   	$mail ->Username = "tech.codebox@gmail.com";
	   	$mail ->Password = "pythontest";
	   	$mail ->SetFrom("tech.codebox@gmail.com");
	   	$mail ->Subject = $mailSub;
	   	$mail ->Body = $mailMsg;
	   	$mail ->AddAddress($mailto);
		
		if(!$mail->Send())
			return false;
		else 
			return true;
	}

	function clearInfo($con,$email){
		$sql = "DELETE FROM recovery WHERE email = '".$email."';";
		$result = mysqli_query($con, $sql);
	}


	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		if (isset($_POST['email'])) {


			clearInfo($con,$_POST['email']);

			$code = mt_rand(111111,999999);

			$sql = "INSERT INTO `recovery` (`email`, `code`) VALUES ('".$_POST['email']."', '".$code."');";
			$result = mysqli_query($con,$sql);


			if (send_email($_POST['email'],$code)){
				$response['error'] = false;
				$response['message'] = "next";

			} else {
				$response['error'] = false;
				$response['message'] = "Unknown Error!";
			}

		} else {
			$response['error'] = true;
			$response['message'] = "Email id is missing!";
		}
	} else {
		$response['error'] = true;
		$response['message'] = "Invalid Request";
	}

	echo json_encode($response);
?>	