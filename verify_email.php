<?php
// filepath: /c:/xampp/htdocs/railsystemNexRail/railsystem/verify_email.php

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "railsys";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if verification code is provided
if (isset($_GET['code'])) {
    $verification_code = $_GET['code'];

    // Verify the user
    $sql = "UPDATE User SET is_verified = 1 WHERE verification_code = '$verification_code' AND is_verified = 0";
    if ($conn->query($sql) === TRUE) {
        if ($conn->affected_rows > 0) {
            echo "Email verification successful! You can now <a href='login.php'>login</a>.";
        } else {
            echo "Invalid or expired verification code.";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "No verification code provided.";
}

$conn->close();
?>