<?php


$con = mysqli_connect("localhost", "id2397976_test", "test123", "id2397976_test");
	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}


$response = array();

function isUserExist($con,$email){
	$sql = "SELECT id FROM users WHERE email= '".$email."'";
	$result = mysqli_query($con, $sql);
	$value = @mysqli_num_rows($result);

	// echo $value;
	if ($value){
		return false;
	}else{
		return true;
	}
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(
		isset($_POST['name']) and
		isset($_POST['email']) and
		isset($_POST['aadhaar']) and
		isset($_POST['password'])
		) {
		if (isUserExist($con,$_POST['email'])){
			
			$pwd = md5($_POST['password']);

			$sql = "INSERT INTO `users` (`id`, `name`, `email`, `aadhaar`, `password`) VALUES 
				(NULL, '".$_POST['name']."', '".$_POST['email']."', '".$_POST['aadhaar']."', '".$pwd."');
				";

			$result = mysqli_query($con, $sql);

			$result = mysqli_query($con, "SELECT id FROM users where email = '".$_POST['email']."'");
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

			$result = mysqli_query($con, "INSERT INTO `tokenList` (`id`, `userId`, `token`) VALUES (NULL, '".$row['id']."', '');");

			
			// $sql = "INSERT INTO `tokenList` (`id`, `userId`, `token`) VALUES (NULL, '3', '');";

			$response['error'] = false;
			$response['message'] = "Successfull";
		}else{
			$response['error'] = true;
			$response['message'] = "already exist";
		}
	}else{
		$response['error'] = true;
		$response['message'] = "Missing";
	}
}else{
	$response['error'] = false;
	$response['message'] = "Invalid Request";
}

echo json_encode($response);

?>