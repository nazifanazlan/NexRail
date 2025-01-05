<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'railsys');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve and sanitize form data
$customer_id = $conn->real_escape_string($_POST['customer_id']);
$customer_name = $conn->real_escape_string($_POST['customer_name']);
$issue = $conn->real_escape_string($_POST['issue']);
$contact = $conn->real_escape_string($_POST['contact']);

// Insert data into the database
$sql = "INSERT INTO customer_support (customer_id, customer_name, issue, contact_details)
        VALUES ('$customer_id', '$customer_name', '$issue', '$contact')";

if ($conn->query($sql) === TRUE) {
    // Close the connection before redirecting
    $conn->close();
    header("Location: notificationpage.php?status=success&message=Support+request+submitted&customer_id=" . urlencode($customer_id));
    exit;
} else {
    // Close the connection before redirecting
    $error_message = urlencode("Error submitting request: " . $conn->error);
    $conn->close();
    header("Location: notificationpage.php?status=error&message=$error_message");
    exit;
}
?>
