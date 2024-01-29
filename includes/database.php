<?php

// General settings
$host       = "localhost";
$database   = "protoss_units";
$user       = "root";
$password   = "";

$db = mysqli_connect($host, $user, $password, $database)
or die("Error: " . mysqli_connect_error());