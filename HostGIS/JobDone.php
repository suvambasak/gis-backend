<?php

	$con = mysqli_connect("localhost", "id2397976_test", "test123", "id2397976_test");
	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}
	$response = array();


	function verify($con,$id, $email){

		$sql = "SELECT * FROM updates WHERE id = '".$id."' and jobAssigned = '".$email."';";
		$result = mysqli_query($con, $sql);
		$value = @mysqli_num_rows($result);

		if($value){
			return 1;
		}
		return 0;
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		if (isset($_POST['id']) and isset($_POST['email']) ){

			if(verify($con, $_POST['id'], $_POST['email'])){
				$sql = "UPDATE `updates` SET `status` = 'Done' WHERE `updates`.`id` = '".$_POST['id']."';";



				$result = mysqli_query($con, $sql);
				$value = @mysqli_num_rows($result);

				$response['error'] = false;
				$response['message'] = "Done";
			}
		} else{
			$response['error'] = true;
			$response['message'] = "Not Done";
		}
	} else {
		$response['error'] = true;
		$response['message'] = "Invalid Request";
	}

	echo json_encode($response);
?>