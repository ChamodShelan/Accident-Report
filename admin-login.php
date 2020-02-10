<?php
   include("connection.php");
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT ID FROM admin WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      //$row = mysqli_fetch_array($result);
      //$active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1)
      {
        header("location:map/users-map.php");
      }else {
         echo"<h3>Your Login Name or Password is invalid<h3>";
      }
   }
?>
<html>
   
   <head>
      <title>Admin Login Page</title>
      

      <meta charset="UTF-8">
		<title>Home</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
		</noscript>

      <link rel="stylesheet" type="text/css" href="css/admin-login.css">

      <style type = "text/css">
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
      
   </head>
   
   <body>
   <header id="header">
				<h1><a href="index.html">Accident Reports</a></h1>
				<nav id="nav">
					<ul>
						<li><a href="index.html">Home</a></li>
						<li><a href="map/users-map.php">View Map</a></li>
						<li><a href="elements.html">Report</a></li>
					</ul>
				</nav>
			</header>
   <div class="login-box">
	   <img src="images/login_img1.png" class="avatar">	
		   <h1>Admin Login</h1>
		      <form action="" method="POST">
			      <p>Username</p>
			      <input type="text" name="username" placeholder="Enter Username" REQUIRED>
			      <p>Password</p>
			      <input type="Password" name="password" placeholder="Enter Password" REQUIRED>
               <input type="submit" name="submit" value="Login">

		</form>
      </div>
   </body>
</html>