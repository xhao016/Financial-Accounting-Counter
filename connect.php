<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "record_accounting";

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);


// Check connection
if ($con->connect_error) {

die("Connection failed: " .$con->connect_error);

}
else {
    error_log ("<br>Database Connected.");
}

?>


