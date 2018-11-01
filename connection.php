<?php

#Security Check
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
     // Don't allow the GET method
     die("You cannot call this page directly, noob.");
}

$servername = "localhost";
$username = "username";
$password = "password";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$conn->query("USE DATABASE");
//echo "Connected successfully";
?>