<?php
	$con = mysqli_connect("localhost", "id2397976_test", "test123", "id2397976_test");
	//$con = mysqli_connect("localhost", "root", "", "Gis");
	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}


	$response = array();

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){

		$sql = "SELECT * FROM `updates` WHERE status = 'NOTDONE'";
		
		$result = mysqli_query($con, $sql);
		$value = @mysqli_num_rows($result);

		$response['error'] = false;
		$response['message'] = "Ok";

		$response['count'] = $value;
	}else{
		$response['error'] = false;
		$response['message'] = "Invalid request";
	}

	echo json_encode($response);
?>