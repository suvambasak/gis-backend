<?php
	$con = mysqli_connect("localhost", "id2397976_test", "test123", "id2397976_test");
	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}
	
	$response = array();

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		if (isset($_POST['email'])){

			$sql = "SELECT * FROM `updates` WHERE jobAssigned = '".$_POST['email']."' AND status = 'NOTDONE'";

			$result = mysqli_query($con, $sql);
			$value = @mysqli_num_rows($result);

			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				array_push($response,array("id"=>$row['id'],"issue"=>$row['issue'],"lat"=>$row['lat'],"lng"=>$row['lng']));
			}
		}
	}

	echo json_encode($response);
?>