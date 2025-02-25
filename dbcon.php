<?php

// Database configuration
define("HOSTNAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");

define("DATABASE", "crud_opration");

// Establish database connection
$connection = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
} 

?>
