<?php

$con = mysqli_connect("localhost", "id2397976_test", "test123", "id2397976_test");
	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}

$response = array();


function checkWorker($con,$email){
	$result = mysqli_query($con,"SELECT * FROM workerList WHERE worker= '".$email."'");
	$value = @mysqli_num_rows($result);

	if ($value){
		return 1;
	}
	return 0;
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(isset($_POST['email'])) {

		if (checkWorker($con,$_POST['email'])){

			$response['error'] = false;
			$response['message'] = "Go";

		}else{
			$response['error'] = true;
			$response['message'] = "You are not a worker";
		}
		
	}else{
		$response['error'] = true;
		$response['message'] = "Invalid Request";
	}
}else{
	$response['error'] = true;
	$response['message'] = "Invalid Request";
}
echo json_encode($response);
?>