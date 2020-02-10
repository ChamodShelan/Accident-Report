
<!DOCTYPE html>
<html>
<head>
  <title>Registration</title>
  <link rel="stylesheet" type="text/css" href="css/signup.css">
  


  <?php 

$url='localhost';
$username='root';
$password='';
$conn=mysqli_connect($url,$username,$password,"accident");
if(!$conn){
 die('Could not Connect My Sql:' .mysql_error());
}

if(isset($POST['submit']))
{


	$fname = $POST['fname'];
    $lname =  $POST['lname'];
    $dob = $POST['dob'];
	$nic = $POST['nic'];
    $email = $POST['email'];
    $lic = $POST['lic'];
    $dob = $POST['dob'];
    $city = $POST['city'];
	$uname = $POST['uname'];
	$pass = $POST['pass'];
    $tel = $POST['tel'];

    $query = "INSERT INTO public(ID,username,password,fname,lname,NIC,License,DOB,City,Telephone,Email) VALUES ('','$uname','$pass','$fname','$lname','$nic','$lic','$dob','$city','$telephone','$email')";

	$rs = mysqli_query($db,$query);
	if(count($rs)==1)
	{
		echo"<h3>SUBMITED<h3>";
	}
	else{
		echo"error";
	}


 }



?>
</head>
<body>

<div class="Register-Form">
		<img src="images/signup.png">
		<h1> Register Now</h1>
    <form action="" method="POST">
			
		<input type="name" class="input-box" placeholder="Your First Name" name="fname">
		<input type="name" class="input-box" placeholder="Your Last Name" name="lname">
		<input type="date" class="input-box" placeholder="Enter your Birthday" name="dob">
		<input type="id" class="input-box" placeholder="Enter your ID Number" name="nic">
		<input type="licnum" class="input-box" placeholder="Enter your License Number" name="lic">
		<input type="email" class="input-box" placeholder="Your Email" name="email">
		<input type="pnum" class="input-box" placeholder="Your Phone Number" name="tel">
    <input type="name" class="input-box" placeholder="Enter your City" name="city">
    <input type="text" class="input-box" placeholder="Enter a username" name="username" REQUIRED>
		<input type="password" class="input-box" placeholder="Your Password" REQUIRED>
		<input type="password" class="input-box" placeholder="Re-Enter your password" name="password">
		<button type="submit" name='sumbit' class="register-btn">SIGNUP</button>
		<hr>
		<p class="or">Or</p>
		<button type="button" class="Login-btn">LOGIN</button>
		<p>Do you have already registered?<a href="index.php">Log in</a></p>
	    </form>
	</div>

</body>
</html>