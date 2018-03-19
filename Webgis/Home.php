<?php
  $con = mysqli_connect("localhost", "id2397976_test", "test123", "id2397976_test");
  // $con = mysqli_connect("localhost", "root", "", "Gis");
  
  if (mysqli_connect_errno()) {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit();
  }

  session_start();

  if ($_SESSION['login_user'] == ''){
    // echo ("<SCRIPT LANGUAGE='JavaScript'>
    //       window.location.href='https://techcodebox.000webhostapp.com';
    //       </SCRIPT>");
    echo ("<SCRIPT LANGUAGE='JavaScript'>
          window.location.href='http://localhost/Webgis';
          </SCRIPT>");
  }

?>


<!DOCTYPE html>
<html>
  <head>
    <title>GISBMS | Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .topcorner{
          position:absolute;
          top:0;
          right:0;
          margin-right: 30px;
          margin-top: 15px;
        }
        #pagetitle{
          margin-left: 30px;
        }
        #pagebody{
          margin-left: 30px;
          margin-right: 30px;
        }

        #fromstyle{
          margin-left: 50px;
          margin-bottom: 50px;
        }
        #map {
          height: 500px;
          width: 95%;
          margin: auto;
        }
        #cpr{
          background-color: #e0e0e0;
          padding-left: 13px;
          padding-top: 5px;
          padding-bottom: 5px;
        }
    </style>
  </head>
  <body>
    <div id="pagetitle"> <h2><b>GIS Based Monitoring System</b></h2> </div>
    <div class="topcorner">
      <button type="button" class="btn btn-danger" onclick="window.location.href='https://techcodebox.000webhostapp.com/Logout.php';">
      Logout
      </button>
    </div>

    <div id="map"></div>
    
    <script>
      function initMap() {

      	var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		        var dataSet = JSON.parse(this.responseText);
		        // document.getElementById("demo").innerHTML = dataSet.length;

		        var index;
		        for (index = 0; index<dataSet.length; index++){
		        	var l = parseFloat(dataSet[index].lat);
		        	var n = parseFloat(dataSet[index].lng);  
              var jobIdForForm = parseInt(dataSet[index].id);

                    var contentData = "<h4>"+dataSet[index].issue+"</h4><br><b>Job ID :</b>"+ dataSet[index].id +"<br><b>Date : </b>"+ dataSet[index].date +"<br><b>Time : </b>"+ dataSet[index].time +"<br><b>Worker : </b>"+dataSet[index].jobAssigned;

                    if (dataSet[index].jobAssigned == "none"){
                        addMarker({location:{lat:l, lng:n},content:contentData, id:jobIdForForm});
                    }else{
                        addMarker({location:{lat:l, lng:n},content:contentData,iconImage:'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',id:jobIdForForm});
                    }
		        }
		    }
		};

		xmlhttp.open("GET", "LocationAPI.php", true);
		xmlhttp.send();

        var option = {
        	zoom : 10,
        	center : {lat: 22.9751, lng: 88.4345},
            styles:  [
              {elementType: 'geometry', stylers: [{color: '#ebe3cd'}]},
              {elementType: 'labels.text.fill', stylers: [{color: '#523735'}]},
              {elementType: 'labels.text.stroke', stylers: [{color: '#f5f1e6'}]},
              {
                featureType: 'administrative',
                elementType: 'geometry.stroke',
                stylers: [{color: '#c9b2a6'}]
              },
              {
                featureType: 'administrative.land_parcel',
                elementType: 'geometry.stroke',
                stylers: [{color: '#dcd2be'}]
              },
              {
                featureType: 'administrative.land_parcel',
                elementType: 'labels.text.fill',
                stylers: [{color: '#ae9e90'}]
              },
              {
                featureType: 'landscape.natural',
                elementType: 'geometry',
                stylers: [{color: '#dfd2ae'}]
              },
              {
                featureType: 'poi',
                elementType: 'geometry',
                stylers: [{color: '#dfd2ae'}]
              },
              {
                featureType: 'poi',
                elementType: 'labels.text.fill',
                stylers: [{color: '#93817c'}]
              },
              {
                featureType: 'poi.park',
                elementType: 'geometry.fill',
                stylers: [{color: '#a5b076'}]
              },
              {
                featureType: 'poi.park',
                elementType: 'labels.text.fill',
                stylers: [{color: '#447530'}]
              },
              {
                featureType: 'road',
                elementType: 'geometry',
                stylers: [{color: '#f5f1e6'}]
              },
              {
                featureType: 'road.arterial',
                elementType: 'geometry',
                stylers: [{color: '#fdfcf8'}]
              },
              {
                featureType: 'road.highway',
                elementType: 'geometry',
                stylers: [{color: '#f8c967'}]
              },
              {
                featureType: 'road.highway',
                elementType: 'geometry.stroke',
                stylers: [{color: '#e9bc62'}]
              },
              {
                featureType: 'road.highway.controlled_access',
                elementType: 'geometry',
                stylers: [{color: '#e98d58'}]
              },
              {
                featureType: 'road.highway.controlled_access',
                elementType: 'geometry.stroke',
                stylers: [{color: '#db8555'}]
              },
              {
                featureType: 'road.local',
                elementType: 'labels.text.fill',
                stylers: [{color: '#806b63'}]
              },
              {
                featureType: 'transit.line',
                elementType: 'geometry',
                stylers: [{color: '#dfd2ae'}]
              },
              {
                featureType: 'transit.line',
                elementType: 'labels.text.fill',
                stylers: [{color: '#8f7d77'}]
              },
              {
                featureType: 'transit.line',
                elementType: 'labels.text.stroke',
                stylers: [{color: '#ebe3cd'}]
              },
              {
                featureType: 'transit.station',
                elementType: 'geometry',
                stylers: [{color: '#dfd2ae'}]
              },
              {
                featureType: 'water',
                elementType: 'geometry.fill',
                stylers: [{color: '#b9d3c2'}]
              },
              {
                featureType: 'water',
                elementType: 'labels.text.fill',
                stylers: [{color: '#92998d'}]
              }
            ]
        	}

        var map = new google.maps.Map(document.getElementById('map'), option);

        //add marker
        function addMarker(props){
        	var marker  = new google.maps.Marker({
	        	position : props.location,
	        	map : map
        	});


            if(props.iconImage){
            // Set icon image
                marker.setIcon(props.iconImage);
         }
        	if(props.content){
            	var infoWindow = new google.maps.InfoWindow({
            		content: props.content
            	});

            	marker.addListener('click', function(){
            		infoWindow.open(map, marker);
                setJobId(props.id);
            	});
            }
        }
      }
       
      function setEmployeeEmail(emailId){
        document.getElementById('email').value = emailId;
      }

      function setJobId(jobId){
        document.getElementById('issue').value = jobId;
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDHORtGgr7hb2tpbx5Bd1lkB4jdy0TAqQs&callback=initMap">
    </script>

    

    <div id="pagebody">
        <p><h3>Admin Console Dashboard</h3></p>

       <div id="fromstyle">
            <p><h4>Job Assign</h4></p>

            <form class="form-inline" method="post" action="JobAssign.php">
            <div class="form-group">
              <label for="issue">Issue ID:</label>
              <input type="number" class="form-control" id="issue" placeholder="Enter issue ID" name="issueId">
            </div>
            <div class="form-group">
              <label for="employee">Employee:</label>
              <input type="email" class="form-control" id="email" placeholder="Enter employee email" name="employeeEmail">
            </div>
            <button type="submit" class="btn btn-primary">Assign</button>
          </form>
       </div>


       <div id="fromstyle">
          <p><h4>Admin Control</h4></p>

          <button type="button" class="btn btn-success" onclick="window.location.href='https://techcodebox.000webhostapp.com/AddNewEmployee.php';">
            Add New Employee
          </button>

          <button type="button" class="btn btn-danger" onclick="window.location.href='https://techcodebox.000webhostapp.com/RemoveEmployee.php';">
            Remove Employee
          </button>
        </div>


       <div id="fromstyle">
         <p><h4>Available Employee List</h4></p>

        <ul class="list-group">
          <?php
            $employeeList = "SELECT * FROM `workerList`";
            $result = mysqli_query($con, $employeeList);
            $len = @mysqli_num_rows($result);

            for ($i=0; $i<$len; $i++){
              $row=mysqli_fetch_array($result, MYSQLI_ASSOC);
          ?>
          <li class="list-group-item" onclick=<?php echo "setEmployeeEmail('".$row['worker']."')"; ?> >
            <?php
              echo $row['name']."  -  ";
              echo $row['worker'];
            ?>
          <span class="badge">
            <?php
              $numberJobResult = mysqli_query($con,"SELECT id FROM `updates` WHERE jobAssigned = '".$row['worker']."' AND status = 'NOTDONE'");
              $numberOfJobs =@mysqli_num_rows($numberJobResult);
              echo $numberOfJobs;
            ?>
          </span></li>
          <?php
            }
          ?>
       </div>

    </div>
    <div id="cpr">
      <footer> Copyright &copy; 2017 Suvam Basak</footer>
    </div>
  </body>
</html>