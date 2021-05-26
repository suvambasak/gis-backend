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
        window.location.href='https://techcodebox.000webhostapp.com/';
        </SCRIPT>");
	}

	

	if (isset($_REQUEST['email'])){
			// echo $_REQUEST['name'];
			// echo $_REQUEST['email'];

		$result = mysqli_query($con,"DELETE FROM `workerList` WHERE worker = '".$_REQUEST['email']."'");
  		
  		echo ("<SCRIPT LANGUAGE='JavaScript'>
          window.location.href='https://techcodebox.000webhostapp.com/Home.php';
          </SCRIPT>");

  	}  	


?>


<!DOCTYPE html>
<html>
<head>
	<title>GISBMS | Remove Employee</title>
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
		<h2 id="bodyStyle"><b>Remove Employee</b></h2>
	  		<form class="form-horizontal" method="post" action="RemoveEmployee.php">

	    	<div class="form-group">
	      		<label class="control-label col-sm-5" for="email">Email:</label>
	      		<div class="col-sm-3">          
	        		<input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
	     		</div>
	    	</div>
	    
	    	<div class="form-group">        
	    		<div class="control-label col-sm-7">
	        		<button type="submit" class="btn btn-danger">Remove</button>
	     		</div>
    		</div>

  		</form>
	</div>

</body>
</html>