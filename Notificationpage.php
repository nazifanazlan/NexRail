<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'railsys');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve status, message, and customer_id from the URL
$status = $_GET['status'] ?? '';
$message = $_GET['message'] ?? '';
$customer_id = $_GET['customer_id'] ?? '';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification</title>
    <style>
        /* Styling here */
    </style>
</head>
<body>
<div class="notification">
    <?php
    // Display status message
    if ($status === 'success') {
        echo "<h1>Success!</h1>";
    } elseif ($status === 'error') {
        echo "<h1>Error!</h1>";
    }
    echo "<p>" . htmlspecialchars($message) . "</p>";

    // Check if customer_id is provided and fetch the submission details
    if (!empty($customer_id)) {
        // Update SQL query to not use created_at
        $sql = "SELECT * FROM customer_support WHERE customer_id = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $customer_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Display the details if a record is found
        if ($row = $result->fetch_assoc()) {
            echo "<h2>Submitted Details:</h2>";
            echo "<p><strong>Name:</strong> " . htmlspecialchars($row['customer_name']) . "</p>";
            echo "<p><strong>Issue:</strong> " . htmlspecialchars($row['issue']) . "</p>";
            echo "<p><strong>Contact:</strong> " . htmlspecialchars($row['contact_details']) . "</p>";
        } else {
            echo "<p>No submission found for Customer ID: " . htmlspecialchars($customer_id) . "</p>";
        }
        $stmt->close();
    } else {
        echo "<p>No Customer ID provided.</p>";
    }

    // Close the database connection
    $conn->close();
    ?>
    <a href="customersupport.php" class="btn">Back to Customer Support</a>
</div>
</body>
</html>
