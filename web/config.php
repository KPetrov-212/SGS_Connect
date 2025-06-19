<?php
$servername = "db";
$username = "user";
$password = "userpass";
$dbname = "sgsconnect";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>