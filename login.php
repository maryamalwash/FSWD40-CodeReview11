
<?php
ob_start();
session_start();
require_once 'dbconnect.php';

// it will never let you open index(login) page if session is set
if (isset($_SESSION['user']) != "") {
	header("Location: home.php");
	exit;
}

$error = false;

if (isset($_POST['btn-login'])) {

	// prevent sql injections/ clear user invalid inputs
	$email = trim($_POST['email']);
	$email = strip_tags($email);
	$email = htmlspecialchars($email);

	$pass = trim($_POST['pass']);
	$pass = strip_tags($pass);
	$pass = htmlspecialchars($pass);
	// prevent sql injections / clear user invalid inputs

	if (empty($email)) {
		$error      = true;
		$emailError = "Please enter your email address.";
	} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$error      = true;
		$emailError = "Please enter valid email address.";
	}

	if (empty($pass)) {
		$error     = true;
		$passError = "Please enter your password.";
	}

	// if there's no error, continue to login
	if (!$error) {

		$pass = hash('sha256', $pass);// password hashing

		$res   = mysqli_query($conn, "SELECT cust_id,cust_email,cust_password FROM customer WHERE cust_email='$email'");
		$row   = mysqli_fetch_array($res, MYSQLI_ASSOC);
		$count = mysqli_num_rows($res);// if uname/pass correct it returns must be 1 row

		if ($count == 1 && $row['cust_password'] == $pass) {
			$_SESSION['user'] = $row['cust_id'];
			header("Location: home.php");
		} else {
			$errMSG = "Incorrect Credentials, Try again...";
		}

	}

}

if (isset($_POST['btn-signup'])) {

	// sanitize user input to prevent sql injection
	$name = trim($_POST['name']);
	$name = strip_tags($name);
	$name = htmlspecialchars($name);

	$email = trim($_POST['email']);
	$email = strip_tags($email);
	$email = htmlspecialchars($email);

	$pass = trim($_POST['pass']);
	$pass = strip_tags($pass);
	$pass = htmlspecialchars($pass);

	$numb = trim($_POST['numb']);
	$numb = strip_tags($numb);
	$numb = htmlspecialchars($numb);

	$age = trim($_POST['age']);
	$age = strip_tags($age);
	$age = htmlspecialchars($age);

	// basic name validation
	if (empty($name)) {
		$error     = true;
		$nameError = "Please enter your full name.";
	} else if (strlen($name) < 3) {
		$error     = true;
		$nameError = "Name must have atleat 3 characters.";
	} else if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
		$error     = true;
		$nameError = "Name must contain alphabets and space.";
	}

	//basic email validation
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$error      = true;
		$emailError = "Please enter valid email address.";
	} else {
		// check whether the email exist or not
		$query  = "SELECT cust_email FROM customer WHERE cust_email='$email'";
		$result = mysqli_query($conn, $query);
		$count  = mysqli_num_rows($result);
		if ($count != 0) {
			$error      = true;
			$emailError = "Provided Email is already in use.";
		}
	}
	// password validation
	if (empty($pass)) {
		$error     = true;
		$passError = "Please enter password.";
	} else if (strlen($pass) < 6) {
		$error     = true;
		$passError = "Password must have atleast 6 characters.";
	}

	// password hashing for security
	$pass = hash('sha256', $pass);

	// if there's no error, continue to signup
	if (!$error) {

		$query = "INSERT INTO customer(cust_name,cust_email,cust_password,cust_number,cust_age) VALUES('$name','$email','$pass', $numb , $age)";
		$res   = mysqli_query($conn, $query);

		if ($res) {
			$errTyp = "success";
			$errMSG = "Successfully registered, you may login now";
			unset($name);
			unset($email);
			unset($pass);
			unset($numb);
			unset($age);
		} else {
			$errTyp = "danger";
			$errMSG = "Something went wrong, try again later...";
		}

	}

}
?>
<!DOCTYPE html>
<html>
<head>
<title>Cars agency</title>
<link rel="stylesheet" type="text/css" href="style.css">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>


<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="login.php">Car agency</a>
    </div>

   <form class="form-inline  navbar-form navbar-right" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete="off">




<?php
if (isset($errMSG)) {
	echo $errMSG;?>

	<?php
}
?>



            <input type="email" name="email" class="form-control" placeholder="Your Email" value="<?php echo $email;?>" maxlength="40" />

            <span class="text-danger"><?php echo $emailError;?></span>


            <input  type="password" name="pass" class="form-control" placeholder="Your Password" maxlength="15" />

           <span  class="text-danger"><?php echo $passError;?></span>

            <button type="submit" class="btn btn-default" name="btn-login">Sign In</button>

   </form>
 </div>
</nav>
   </div>
</div>
<div class="hero-image">
    		<div class="hero">

 <form method="post" id="form2" class="row" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete="off">


            <h2>Sign Up</h2>
            <hr />

<?php
if (isset($errMSG)) {

	?>
																	           <div class="alert alert-<?php echo $errTyp?>">
	<?php echo $errMSG;?>
	</div>

	<?php
}
?>






            <input id="input2" type="text" name="name" class="form-control" placeholder="Enter Name" maxlength="50" value="<?php echo $name?>" />

               <span class="text-danger"><?php echo $nameError;?></span>





            <input type="email" id="input2" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" value="<?php echo $email?>" />

               <span class="text-danger"><?php echo $emailError;?></span>




            <input type="password" name="pass" id="input2" class="form-control" placeholder="Enter Password" maxlength="15" />

               <span class="text-danger"><?php echo $passError;?></span>





            <input type="Number" name="numb" id="input2" class="form-control" placeholder="Phone number" maxlength="11" />





            <input type="Number" name="age" id="input2" class="form-control" placeholder="age" maxlength="3" />

            <hr/>


<div class="-xs-6">
            <button type="submit" class="btn btn-block btn-primary" id="input2" name="btn-signup">Sign Up</button>


   </form>

</div>
</div>
</div></div>
<footer>

&lt;
s&gt;

&lt;
/m&gt;
 web development
</footer>
</body>
</html>
<?php ob_end_flush();?>