<?php
	$con = mysqli_connect("localhost", "id2397976_test", "test123", "id2397976_test");
// $con = mysqli_connect("localhost", "root", "", "Gis");
	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}
	$response = array();


	function send_android_notification($deviceToken, $message, $lat, $lng) {

		// FIREBASE_SERVER_KEY_FOR_ANDROID_NOTIFICATION
		$headers = array(
		'Authorization: key=AAAAgO3Ke1k:APA91bGRsHKWzzM3TXG2CnDLaCJMmQDESHjpdcxIPkDpMrYIH6qWI2sQ3zxKDQiJEx92DjMJ7QRqgRfGLVcljuDIJ9OeEKNQ89Y_AellGeleWSqlmTjvlVKKmmOM6jwy7QWK-F5iqfiK', 
		'Content-Type: application/json'
		);

		//notificaion.
		$fields = array(
		'to' =>$deviceToken,
		'data'=>array('title'=>'Emergency !!',
					'body'=>$message,
					'lat'=>$lat,
					'lng'=>$lng));

		// Open connection
		$ch = curl_init();
		// Set the url, number of POST vars, POST data
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		// Disabling SSL Certificate support temporarly
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode($fields));
		// Execute post
		$result = curl_exec($ch );
		if($result === false){
			die('Curl failed:' .curl_errno($ch));
		}
		// Close connection
		curl_close($ch);
		return $result;
	}


	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		if (isset($_POST['id']) and
			isset($_POST['lat']) and
			isset($_POST['lng']) and
			isset($_POST['type'])
			){

			$sql = "SELECT token FROM `tokenList` WHERE userId = '1'";
			$result = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			
			$token = $row['token'];

			if ($_POST['type'] == 'Ambulance') {
				$message = 'Ambulance';

				$notificaion = send_android_notification($token, $message, $_POST['lat'], $_POST['lng']);

				$response['error'] = true;
				$response['message'] = "Calling...";
			}
			if ($_POST['type'] == 'Fire') {
				$message = 'Fire';
				
				$notificaion = send_android_notification($token, $message, $_POST['lat'], $_POST['lng']);

				$response['error'] = true;
				$response['message'] = "Calling...";
			}



			

		}
	} else {
		$response['error'] = true;
		$response['message'] = "Invalid Request";
	}

	echo json_encode($response);
?>