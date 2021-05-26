<?php

	// $con = mysqli_connect("localhost", "id2397976_test", "test123", "id2397976_test");
	$con = mysqli_connect("localhost", "root", "", "Gis");

	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}

	function validIssue($con,$id){
		$sql = "SELECT * FROM `updates` WHERE id = '".$id."' AND jobAssigned = 'none'";
		$result = mysqli_query($con, $sql);
		$value = @mysqli_num_rows($result);

		if ($value){
			return true;
			// echo "issue id ".$value;
		}
		return false;
	}

	function validEmployee($con,$email){
		$sql = "SELECT * FROM `workerList` WHERE worker = '".$email."'";
		$result = mysqli_query($con, $sql);
		$value = @mysqli_num_rows($result);

		if ($value){
			return true;
			// echo "employee".$value;
		}
		return false;
	}


	function notifyEmployee($con,$issueId){
		$sql = "SELECT * FROM `updates`, `tokenList` WHERE updates.userId = tokenList.userId AND updates.id = '".$issueId."'";
		$result = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$token = $row['token'];


		$headers = array(
		'Authorization: key=AAAAgO3Ke1k:APA91bGRsHKWzzM3TXG2CnDLaCJMmQDESHjpdcxIPkDpMrYIH6qWI2sQ3zxKDQiJEx92DjMJ7QRqgRfGLVcljuDIJ9OeEKNQ89Y_AellGeleWSqlmTjvlVKKmmOM6jwy7QWK-F5iqfiK', 
		'Content-Type: application/json'
		);


		$msg = $row['issue'];

		$fields = array(
		'to' =>$token,
		'notification'=>array('title'=>'Job','body'=>$msg));

		// Open connection
		$ch = curl_init();
		// Set the url, number of POST vars, POST data
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		// Disabling SSL Certificate support temporarly
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode($fields));
		// Execute post
		$result = curl_exec($ch );
		if($result === false){
			die('Curl failed:' .curl_errno($ch));
		}
		// Close connection
		curl_close($ch);
		return $result;
	}



	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		if($_POST['issueId'] !="" and $_POST['employeeEmail'] != ""){

			if (validIssue($con,$_POST['issueId']) and validEmployee($con,$_POST['employeeEmail'])){
					
				$sql = "UPDATE `updates` SET `jobAssigned` = '".$_POST['employeeEmail']."' WHERE `updates`.`id` = '".$_POST['issueId']."';";
				$result = mysqli_query($con, $sql);
				$value = @mysqli_num_rows($result);

				$noti = notifyEmployee($con,$_POST['issueId']);
				var_dump($noti);

				echo "infromation updated...";
				echo ("<SCRIPT LANGUAGE='JavaScript'>
			    window.alert('Succesfully Updated')
			    window.location.href='https://techcodebox.000webhostapp.com/Home.php';
			    </SCRIPT>");
			}else {
				echo ("<SCRIPT LANGUAGE='JavaScript'>
			    window.alert('Already Assigned!!');
			    window.location.href='https://techcodebox.000webhostapp.com/Home.php';
			    </SCRIPT>");
			}

		}else{
			echo "empty";
		}
	}else{
		echo "Invalid Request!";
	}
?>