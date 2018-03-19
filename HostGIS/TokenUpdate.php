<?php
	$con = mysqli_connect("localhost", "id2397976_test", "test123", "id2397976_test");
	//$con = mysqli_connect("localhost", "root", "", "Gis");
	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}

	$response = array();

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (
			isset($_POST['id']) and
			isset($_POST['token'])
			) {

			$sql = "UPDATE tokenList SET token = '".$_POST['token']."' WHERE userId = '".$_POST['id']."'";
			$result = mysqli_query($con,$sql);

			
			$response['error'] = false;
			$response['message'] = "updated";
		}
	} else {
		$response['error'] = true;
		$response['message'] = "Invalid request";
	}

	echo json_encode($response);

?>