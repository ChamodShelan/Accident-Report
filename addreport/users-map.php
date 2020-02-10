<!DOCTYPE html>
<html>
<head>
	<title>Reports</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">

	<link rel="stylesheet" href="css/report.css">



	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/googlemap.js"></script>
	<style type="text/css">
		.container {
			position:absolute;
			height:450px;
			width:50%;
		}
		#map {
			width: 100%;
			height: 100%;
			border: 1px solid blue;
		}
		#data, #allData {
			display: none;
		}

		#longclicked,#latclicked
		{
			color:red;

		}

	</style>

<script type='text/javascript'> 
        var map;
        
        function initMap() {                            
            var latitude = 27.7172453;
            var longitude = 85.3239605;
            
            var myLatLng = {lat: latitude, lng: longitude};
            
            map = new google.maps.Map(document.getElementById('map'), {
              center: myLatLng,
              zoom: 14,
              disableDoubleClickZoom: true,
            });
            
               
            google.maps.event.addListener(map,'click',function(event) {                
                document.getElementById('latclicked').innerHTML = event.latLng.lat();
                document.getElementById('longclicked').innerHTML =  event.latLng.lng();
            });
            
            
            google.maps.event.addListener(map,'mousemove',function(event) {
                document.getElementById('latmoved').innerHTML = event.latLng.lat();
                document.getElementById('longmoved').innerHTML = event.latLng.lng();
            });
                    
            var marker = new google.maps.Marker({
              position: myLatLng,
              map: map,
              title: latitude + ', ' + longitude 
            });    
            
            // Update lat/long value of div when the marker is clicked
            marker.addListener('click', function(event) {              
              document.getElementById('latclicked').innerHTML = event.latLng.lat();
              document.getElementById('longclicked').innerHTML =  event.latLng.lng();
            });
            
            // Create new marker on double click event on the map
            google.maps.event.addListener(map,'dblclick',function(event) {
                var marker = new google.maps.Marker({
                  position: event.latLng, 
                  map: map, 
                  title: event.latLng.lat()+', '+event.latLng.lng()
                });
                
                // Update lat/long value of div when the marker is clicked
                marker.addListener('click', function() {
                  document.getElementById('latclicked').innerHTML = event.latLng.lat();
                  document.getElementById('longclicked').innerHTML =  event.latLng.lng();
                });            
            });
            

        }
        </script>

<?php 
	
	session_start();

	
	$db = mysqli_connect('localhost', 'root', '', 'accident');


if (isset($_POST['users-map'])) 
{

  $userid = mysqli_real_escape_string($db, $_POST['userid']);
  $lat = mysqli_real_escape_string($db, $_POST['latclicked']);
  $long = mysqli_real_escape_string($db, $_POST['longclicked']);
  $address = mysqli_real_escape_string($db, $_POST['add']);
  $type = mysqli_real_escape_string($db, $_POST['type']);
  $des = mysqli_real_escape_string($db, $_POST['des']);

	$errors = 0;


  $user_check_query = "SELECT * FROM public WHERE USER_ID ='$userid' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

	if ($user['USER_ID'] == "") 
	  {
      $errors = "No_UserID like SO";
    }
  

  if (count($errors) == 0) {


  	$query = "INSERT INTO reports (name,address,type,lat,lng,is_approved,USER_ID) 
  			  VALUES('$des', '$adddress', '$type','$lat','$lng',1,'$userid')";
	  mysqli_query($db, $query);
	  
  }

}
 ?>


</head>
<body>
	<div class="container">
		<center><h1>Report Incident</h1></center>
		<?php 
			require 'report.php';
			$rep = new report;
		
			$loc = $rep->getBlankLatLng();
			$loc = json_encode($loc, true);
			echo '<div id="data">' . $loc . '</div>';

			$allData = $rep->getAll();
			$allData = json_encode($allData, true);
			echo '<div id="allData">' . $allData . '</div>';			
		 ?>
		<div id="map"></div>
	</div>
<div class='right'>
	<form class="form-horizontal" method="post">
			<label>Enter Your USER ID: </label>
			<input type='text' placeholder='USER ID' id="userid">
			<h3> Follow Below Instructions </h3>
			<ul>
				<li>Place the marker on map where accident happened</li>
				<li>Obtain Latitues and Longitudes from below</li>
				<li>Fill out the form</li>
				<li>Attach any photographs that you have on incident</li>
				<li>Then Submit!</li>
			</ul>
			<label>Latitues of mouse point: </label>
			<div id="latmoved"></div>
			<Label>Longitudes of mouse point:</label>
			<div id="longmoved"></div>
			<hr>
			<label>Latitues of marker: </label>
			<div id="latclicked"></div>
			<Label>Longitudes of marker</label>
			<div id="longclicked"></div>
			<hr>
			<label>Enter Latitues: </label>
			<input type='text' placeholder='LATITUTES'>
			<br>
			

			<label>Enter Longitutes: </label>
			<input type='text' placeholder='LATITUTES'>
			<br>

			<LABEL>Enter Address: </label>
			<input type='text' placeholder='Address' id="add" name="add">
			<br>

			<label>Nature of accident: (Eg: Car Crash)</label>
			<input type='text' placeholder='Type' id="type" name="type">
			<br>

			<label>Describe Situation Briefly</label>
			<input type='text' id="des" name="des">
			<br>

			<button type='reset' class='button'>Reset</button>
			<button type='Submit' class='button' name='user-map'>Submit</button>

	</form>
</div>
</body>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-AB-9XZd-iQby-bNLYPFyb0pR2Qw3orw&callback=loadMap">
</script>
</html>