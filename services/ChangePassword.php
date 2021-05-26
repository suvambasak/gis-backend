<?php
	$con = mysqli_connect("localhost", "id2397976_test", "test123", "id2397976_test");
	// $con = mysqli_connect("localhost", "root", "", "Gis");
	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}

	$response = array();

	function codeChecker($con,$code,$email) {
		$sql = "SELECT * FROM `recovery` WHERE email = '".$email."' AND code = '".$code."';";
		$result = mysqli_query($con, $sql);
		$value = @mysqli_num_rows($result);

		if ($value)
			return true;
		return false;
	}

	function clearInfo($con,$email){
		$sql = "DELETE FROM recovery WHERE email = '".$email."';";
		$result = mysqli_query($con, $sql);
	}


	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		if (
			isset($_POST['email']) and
			isset($_POST['code']) and 
			isset($_POST['newPwd'])
			){

			if (codeChecker($con, $_POST['code'], $_POST['email'])){

				$pwd = md5($_POST['newPwd']);

				$sql = "UPDATE `users` SET `password` = '".$pwd."' WHERE `users`.`email` = '".$_POST['email']."'";

				$result = mysqli_query($con, $sql);
				clearInfo($con,$_POST['email']);



				$response['error'] = false;
				$response['message'] = "Done";


			}else{
				$response['error'] = true;
				$response['message'] = "Security Code is NOT valid.";
			}




		} else {
			$response['error'] = true;
			$response['message'] = "Attribute Missing!";
		}
	} else {
		$response['error'] = true;
		$response['message'] = "Invalid Request";
	}

	echo json_encode($response);
?>