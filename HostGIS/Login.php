<?php
// $con = mysqli_connect("localhost", "id2397976_test", "test123", "id2397976_test");
$con = mysqli_connect("localhost", "id2397976_test", "test123", "id2397976_test");
	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(
		isset($_POST['email']) and
		 isset($_POST['password']) and
		   isset($_POST['token']) ) {

		$pwd = md5($_POST['password']);

		$sql = "SELECT * FROM users WHERE email = '".$_POST['email']."' AND password ='".$pwd."'";
		$result = mysqli_query($con, $sql);
		$value = @mysqli_num_rows($result);

		if ($value){
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

			$sql = "UPDATE tokenList SET token = '".$_POST['token']."' WHERE userId = '".$row['id']."'";
		
			$result = mysqli_query($con, $sql);


			$response['error'] = false;
			$response['message'] = "Login successfull";
			
			$response['id'] = $row['id'];
			$response['email'] = $row['email'];
		}else{
			$response['error'] = true;
			$response['message'] = "Incorrect username and password";
		}
	}else{
		$response['error'] = true;
		$response['message'] = "Incorrect username and password";
	}
}else{
	$response['error'] = true;
	$response['message'] = "Invalid Request";
}
echo json_encode($response);
?>