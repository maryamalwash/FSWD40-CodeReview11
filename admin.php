<?php
ob_start();
session_start();
require_once 'dbconnect.php';

// if session is not set this will redirect to login page
if (!isset($_SESSION['user'])) {
	header("Location: login.php");
	exit;
}
// select logged-in users detail
$res     = mysqli_query($conn, "SELECT * FROM customer WHERE cust_id=".$_SESSION['user']);
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);

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
    <ul class="nav navbar-nav navbar-right">
<li  class="active">
	<a  href="logout.php?logout"> log out
	</a>
</li>

</ul>
    </div>
</nav>

<div id="filter" class="container">

<div class="btn-group" role="group" aria-label="...">
  <button type="button" class="btn btn-default"><a href="home.php"> cars </a></button>

  <button type="button" class="btn btn-default">
  <a href="office.php"> Offices </a></button>
</div>
</div>

<?php

$sql1       = "SELECT * from rented_cars ";
$res_office = mysqli_query($conn, $sql1);

while ($office_row = mysqli_fetch_array($res_office)) {

	echo '<div id="office" class="card col-xs-12">
<div class="container">
            <h4>
              <b>Customer ID : </b> ', $office_row['fk_cust_id'], '<br> <b>Car ID : </b>', $office_row['fk_car_id'], ' <br> <b> Rented car Location :</b> ', $office_row['rented_car_location'], '</h4>  </div> <hr></div>';

}
?>
<footer class="col-xs-12">

&lt;
s&gt;

&lt;
/m&gt;
 web development
</footer>
</body>
</html>
<?php ob_end_flush();?>