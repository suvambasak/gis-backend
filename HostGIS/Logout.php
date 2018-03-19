<?php
	$con = mysqli_connect("localhost", "id2397976_test", "test123", "id2397976_test");
	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}

	$response = array();

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		if(isset($_POST['id'])){

			$sql = "UPDATE tokenList set token = 'NULL' WHERE userId = '".$_POST['id']."'";
			$result = mysqli_query($con, $sql);

			if($result){
				$response['error'] = false;
				$response['message'] = "Logout";
			}else{
				$response['error'] = true;
				$response['message'] = "Not";
			}
		}
	}else{
		$response['error'] = true;
		$response['message'] = "Invalid Request";
	}

	echo json_encode($response);

?>