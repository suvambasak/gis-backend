<?php
	// $con = mysqli_connect("localhost", "id2397976_test", "test123", "id2397976_test");
	$con = mysqli_connect("localhost", "root", "", "Gis");
	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}


	$response = array();


	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if(
			isset($_POST['name']) and
			isset($_POST['lat']) and
			isset($_POST['lng']) and
			isset($_POST['phone']) and
			isset($_POST['email']) and
			isset($_POST['type'])	
			) {


			// echo $_POST['name'];
			// echo $_POST['lat'];
			// echo $_POST['lng'];
			// echo $_POST['phone'];
			// echo $_POST['email'];

			if ($_POST['type'] == 'ambulance') {
				$sql = "INSERT INTO `ambulance` (`id`, `name`, `lat`, `lng`, `phone`, `email`) VALUES (NULL, '".$_POST['name']."', '".$_POST['lat']."', '".$_POST['lng']."', '".$_POST['phone']."', '".$_POST['email']."');";
			}
			else
			if ($_POST['type'] == 'firebigade') {
				$sql = "INSERT INTO `firebigade` (`id`, `name`, `lat`, `lng`, `phone`, `email`) VALUES (NULL, '".$_POST['name']."', '".$_POST['lat']."', '".$_POST['lng']."', '".$_POST['phone']."', '".$_POST['email']."');";
			}
			


			$result = mysqli_query($con,$sql);


			$response['error'] = false;
			$response['message'] = "Details saved!";


		} else {
			$response['error'] = true;
			$response['message'] = "Attribute missing";
		}
	} else {
		$response['error'] = true;
		$response['message'] = "Invalid Request";
	}


	echo json_encode($response);
?>