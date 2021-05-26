<?php
	$con = mysqli_connect("localhost", "id2397976_test", "test123", "id2397976_test");
  // $con = mysqli_connect("localhost", "root", "", "Gis");

  if (mysqli_connect_errno()) {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit();
  }



  session_start();


  if (isset($_REQUEST['username']) and isset($_REQUEST['pwd'])){
    // echo $_REQUEST['username'];
    // echo $_REQUEST['pwd'];
    $password =  md5($_REQUEST['pwd']);

    $result = mysqli_query($con,"SELECT * FROM `adminLogin` WHERE username = '".$_REQUEST['username']."' AND password = '".$password."';");

    $value = @mysqli_num_rows($result);

    if ($value){
    	// echo $value;
    	$_SESSION['login_user']= $_REQUEST['username'];

    	echo ("<SCRIPT LANGUAGE='JavaScript'>
			    window.location.href='https://techcodebox.000webhostapp.com/Home.php';
			    </SCRIPT>");

      // echo ("<SCRIPT LANGUAGE='JavaScript'>
      //     window.location.href='http://localhost/Webgis/Home.php';
      //     </SCRIPT>");
    }else{
    	echo ("<SCRIPT LANGUAGE='JavaScript'>
			    window.alert('Username or Password not matching')
			    </SCRIPT>");
    }
  }


?>

<!DOCTYPE html>
<html>
<head>
	<title>GISBMS Login</title>
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
		<h2 id="bodyStyle"><b>GISBMS Sign in</b></h2>
	  		<form class="form-horizontal" method="post" action="index.php">

	    	<div class="form-group">
	      		<label class="control-label col-sm-5" for="username">Username:</label>
	      		<div class="col-sm-3">
	        		<input type="text" class="form-control" id="username" placeholder="Enter username" name="username">
	      		</div>
	    	</div>

	    	<div class="form-group">
	      		<label class="control-label col-sm-5" for="pwd">Password:</label>
	      		<div class="col-sm-3">          
	        		<input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
	     		</div>
	    	</div>
	    
	    	<div class="form-group">        
	    		<div class="control-label col-sm-7">
	        		<button type="submit" class="btn btn-default">Sign in</button>
	     		</div>
    		</div>

  		</form>
	</div>

</body>
</html>