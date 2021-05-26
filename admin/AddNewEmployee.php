<?php

  // $con = mysqli_connect("localhost", "id2397976_test", "test123", "id2397976_test");
  $con = mysqli_connect("localhost", "root", "", "Gis");
  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
  }

  session_start();

  if ($_SESSION['login_user'] == ''){
    echo ("<SCRIPT LANGUAGE='JavaScript'>
          window.location.href='https://techcodebox.000webhostapp.com';
          </SCRIPT>");
  }


	function checkEmail($con, $email){
		$result = mysqli_query($con, "SELECT id FROM workerList WHERE worker= '".$email."'");
	 $value =  @mysqli_num_rows($result);

  	if ($value){
  		return 0;
  	}
  	return 1;
  }


  function notify($con,$email){

    $sql = "SELECT * FROM `tokenList`, `users` WHERE users.id = tokenList.userId and users.email = '".$email."'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $token = $row['token'];

    $headers = array(
    'Authorization: key=AAAAgO3Ke1k:APA91bGRsHKWzzM3TXG2CnDLaCJMmQDESHjpdcxIPkDpMrYIH6qWI2sQ3zxKDQiJEx92DjMJ7QRqgRfGLVcljuDIJ9OeEKNQ89Y_AellGeleWSqlmTjvlVKKmmOM6jwy7QWK-F5iqfiK', 
    'Content-Type: application/json'
    );

    $msg = "Hi, " . $row['name'] .", You added as Employee!";

    $fields = array(
    'to' =>$token,
    'notification'=>array('title'=>'Job','body'=>$msg));

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



	if (isset($_REQUEST['name']) and isset($_REQUEST['email'])){

		if (checkEmail($con, $_REQUEST['email'])){
			// echo $_REQUEST['name'];
			// echo $_REQUEST['email'];

			$result = mysqli_query($con, "INSERT INTO `workerList` (`id`, `name`, `worker`) VALUES (NULL, '".$_REQUEST['name']."', '".$_REQUEST['email']."');");

      $noti = notify($con,$_REQUEST['email']);

      var_dump($noti);

			echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.location.href='https://techcodebox.000webhostapp.com/Home.php';
        </SCRIPT>");
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>GISBMS | New Employee</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  	<style type="text/css">
  		#bodyStyle{
  			margin-left: 43%;
  			margin-top: 200px;
  			margin-bottom: 30px;
  		}
  	</style>
</head>
<body>
	<div class="container form-horizontal">
		<h2 id="bodyStyle"><b>Add New Employee</b></h2>
	  		<form class="form-horizontal" method="post" action="AddNewEmployee.php">

	    	<div class="form-group">
	      		<label class="control-label col-sm-5" for="name">Name:</label>
	      		<div class="col-sm-3">
	        		<input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
	      		</div>
	    	</div>

	    	<div class="form-group">
	      		<label class="control-label col-sm-5" for="email">Email:</label>
	      		<div class="col-sm-3">          
	        		<input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
	     		</div>
	    	</div>
	    
	    	<div class="form-group">        
	    		<div class="control-label col-sm-8">
	        		<button type="submit" class="btn btn-success">Add</button>
	     		</div>
    		</div>

  		</form>
	</div>

</body>
</html>