<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../main.css">
</head>
<body>
<?php
//Create a user session or resume an existing one
session_start();

include_once "../config/connection.php"; //$con variable
//execute query
$query = "SELECT * FROM cars";
$result = mysqli_query($con, $query);
?>
<div class="corner">
    <form action="../index.php" method="GET">
        <input value='Logout' type='submit' id='logoutbutton'
               name='logoutbutton'/>
    </form>

    <br>
    <br>
    <form action="HomePage.php" method="GET">
        <input value='HomePage' type='submit' id='homepage'
               name='homepage'/>
    </form>
</div>

<h1>List of all available cars <?php
    if ($_GET['date'])
        echo "on ";
    echo $_GET['date'];
    ?>.
</h1>

<!--Table Headers-->
<table border="1">
    <tr>
        <th>Make</th>
        <th>Model</th>
        <th>Year</th>
        <th>City</th>
        <th>State</th>
        <th>Rent</th>
    </tr>
    <?php
    $counter = 0;
    // populate table
    if (!$con) {
        die("Could not connect:" . mysqli_error());
    }
    while ($row = mysqli_fetch_array($result)) {
        $counter++;
        $vin = $row["vehicle_identification_number"];

        $date_requested = $_GET['date'];

        $qrt = "SELECT date,date_of_return 
	FROM reservations 
	WHERE reservations.vehicle_identification_number=" . $vin;

        $retval = mysqli_query($con, $qrt);

        if (!$retval) {
            die("Could not fetch data." . mysqli_error());
        }

        $col = mysqli_fetch_array($retval);

        $date = $col['date'];

        $date_of_return = $col['date_of_return'];

        if ($date_requested > $date && $date_requested < $date_of_return) {

        } else {

            echo "<tr>\n";
            //echo "<td>" . $row["vehicle_identification_number"]. "</td>\n";
            echo "<td>" . $row["make"] . "</td>\n";
            echo "<td>" . $row["model"] . "</td>\n";
            echo "<td>" . $row["year"] . "</td>\n";
            echo "<td>" . $row["city"] . "</td>\n";
            echo "<td>" . $row["state"] . "</td>\n";
            echo "<td>" . "<input type='radio' name='select' id='selectcar'	checked='checked' onclick='setVal($counter{);'" . "</td>\n";
        }

        $_SESSION['VIN'] = $row["vehicle_identification_number"];

    }
    ?>
</table>
<br>
<form action="CarReservationPage.php" method="POST">
    <input type="hidden" name="carBtn" id="carBtn">
    <input type="submit" value="Make a reservation">
</form>
<script>
    function setVal(c) {
        $('#memID').val($('#mem' + c).html());
    }
</script>
</body>
</html>