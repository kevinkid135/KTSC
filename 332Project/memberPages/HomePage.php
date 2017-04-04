<!DOCTYPE HTML>
<html>
<head>
    <title>Homepage</title>
    <link rel="stylesheet" type="text/css" href="../main.css">
</head>
<body>
 <?php
  //Create a user session or resume an existing one
 session_start();
 ?>

  <?php
 //check if the user clicked the logout link and set the logout GET parameter
if(isset($_GET['logout'])){
	//Destroy the user's session.
	$_SESSION['id']=null;
	header("Location: index.php");
	session_destroy();
}
 ?>

<h1>KTSC</h1>
<div class="corner">
    <a href="../index.php">logout</a>
</div>
<p>
    <a href="parkingLocations.php">Parking Locations</a>
</p>
<p>
    <a href="rentalHistory.php">Rental History</a>
</p>
<p>Available cars on <input type="date" name="date">
    <button>Search</button>
</p>
</body>
</html>