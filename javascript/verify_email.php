<?php
$conn = new mysqli("localhost", "root", "", "railsys");
if ($conn->connect_error) die("Database connection failed");

if (isset($_GET['code'])) {
    $code = $_GET['code'];
    $stmt = $conn->prepare("UPDATE users SET is_verified = 1 WHERE verification_code = ?");
    $stmt->bind_param("s", $code);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Email verified successfully! You can now <a href='login.php'>login</a>.";
    } else {
        echo "Invalid or expired verification link.";
    }
}
$conn->close();
?>
