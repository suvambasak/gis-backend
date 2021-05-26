<?php
$con = mysqli_connect("localhost", "id2397976_test", "test123", "id2397976_test");
	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}


$response = array();

function isUserExist($con,$userId){
	$sql = "SELECT id FROM users WHERE id= '".$userId."'";
	$result = mysqli_query($con, $sql);
	$value = @mysqli_num_rows($result);

	if ($value){
		return true;
	}else{
		return false;
	}
}


function isUpdated($con,$issue,$lat,$lng) {
	$sql = "SELECT id FROM updates WHERE issue= '".$issue."' AND lat = '".$lat."' AND lng = '".$lng."' ";
	$result = mysqli_query($con, $sql);
	$value = @mysqli_num_rows($result);

	if ($value){
		return false;
	}else{
		return true;
	}
}



if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(
		isset($_POST['userId']) and
		isset($_POST['issue']) and
		isset($_POST['comment']) and
		isset($_POST['time']) and
		isset($_POST['date']) and
		isset($_POST['lat']) and
		isset($_POST['lng']) and
		isset($_POST['accuracy'])
		) {
		if (isUserExist($con,$_POST['userId']) and isUpdated($con,$_POST['issue'],$_POST['lat'],$_POST['lng'] )){

	// echo $_POST['userId'];
	// echo $_POST['issue'];
	// echo $_POST['comment'];
	// echo $_POST['time'];
	// echo $_POST['date'];
	// echo $_POST['lat'];
	// echo $_POST['lng'];
	// echo $_POST['accuracy'];


			$sql = "INSERT INTO `updates` (`id`, `userId`, `issue`, `comment`, `time`, `date`, `lat`, `lng`, `accuracy`, `status`, `jobAssigned`) VALUES (NULL, '".$_POST['userId']."', '".$_POST['issue']."', '".$_POST['comment']."', '".$_POST['time']."', '".$_POST['date']."', '".$_POST['lat']."', '".$_POST['lng']."', '".$_POST['accuracy']."', 'NOTDONE', 'none');";

			$result = mysqli_query($con, $sql);

			$response['error'] = false;
			$response['message'] = "updated";
		}else{
			$response['error'] = true;
			$response['message'] = "Alrady Updated, Thank you.";
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