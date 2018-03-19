<?php

	$con = mysqli_connect("localhost", "id2397976_test", "test123", "id2397976_test");
	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}


	$response = array();


	function getName($con,$id){
		$sql = "SELECT name FROM users WHERE id = '".$id."'";
		$result = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

		return $row['name'];
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		if (isset($_POST['id'])){

			$sql = "SELECT * FROM `updates` WHERE status = 'NOTDONE'";

			$result = mysqli_query($con, $sql);
			$value = @mysqli_num_rows($result);

			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				$name = getName($con,$row['userId']);
				array_push($response,array("issue"=>$row['issue'],"lat"=>$row['lat'],"lng"=>$row['lng'],"name"=>$name,"comment"=>$row['comment'],"updateId"=>$row['id']));
			}
		}
	}

	echo json_encode($response);
?>