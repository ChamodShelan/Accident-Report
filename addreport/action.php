<?php 
	
	session_start();

	
	$db = mysqli_connect('localhost', 'root', '', 'accident');


if (isset($_POST['users-map'])) 
{
  // receive all input values from the form
  $userid = mysqli_real_escape_string($db, $_POST['userid']);
  $lat = mysqli_real_escape_string($db, $_POST['latclicked']);
  $long = mysqli_real_escape_string($db, $_POST['longclicked']);
  $address = mysqli_real_escape_string($db, $_POST['add']);
  $type = mysqli_real_escape_string($db, $_POST['type']);
  $des = mysqli_real_escape_string($db, $_POST['des']);

	$errors = 0;

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM public WHERE USER_ID ='$userid' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

	if ($user['USER_ID'] == "") 
	  {
      $errors = "No_UserID like SO";
    }
  

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {


  	$query = "INSERT INTO reports (name,address,type,lat,lng,is_approved,USER_ID) 
  			  VALUES('$des', '$adddress', '$type','$lat','$lng',1,'$userid')";
	  mysqli_query($db, $query);
	  
  	echo("DONE");
  }

}
 ?>