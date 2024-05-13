<?php
// Database configuration
$dbHost = 'localhost'; // or your host link for remote servers
$dbUsername = 'root'; // your database username
$dbPassword = ''; // your database password
$dbName = 'library'; // your database name

// Create connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "DB Connected successfully<BR>";



