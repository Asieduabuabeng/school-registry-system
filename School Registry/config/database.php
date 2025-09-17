<?php
// Database configuration for MAMP
$servername = "localhost";
$username = "root";        // Default MAMP MySQL username
$password = "root";        // Default MAMP MySQL password
$dbname = "school_registry";
$port = 8889;             // Default MAMP MySQL port

// Create connection with port
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to utf8
$conn->set_charset("utf8");
?>
