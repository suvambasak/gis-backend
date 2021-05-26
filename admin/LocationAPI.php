<?php
	
	$response = array();

	// $con = mysqli_connect("localhost", "id2397976_test", "test123", "id2397976_test");
	$con = mysqli_connect("localhost", "root", "", "Gis");

	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}


	$query = "SELECT * FROM `updates` WHERE status = 'NOTDONE'";
	$result = mysqli_query($con, $query);
	if (!$result) {
	  die('Invalid query: ' . mysql_error());
	}


	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	  	array_push($response,array("id"=>$row['id'],"userId"=>$row['userId'],"issue"=>$row['issue'],"time"=>$row['time'],"date"=>$row['date'],"lat"=>$row['lat'],"lng"=>$row['lng'],"accuracy"=>$row['accuracy'],"jobAssigned"=>$row['jobAssigned']));
	}

	echo json_encode($response);
?>