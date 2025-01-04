<?php
session_start();

// Database connection
$host = "localhost";
$user = "root";
$password = "";
$database = "railsys";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Process login form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $captchaResponse = $_POST['g-recaptcha-response'];

    // Verify CAPTCHA
    $secretKey = "6LfTjJwqAAAAABPC1N6E3SG3rH_bjeT7MpCL7iG6"; 
    $verifyResponse = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$captchaResponse}");
    $responseData = json_decode($verifyResponse);

    if (!$responseData->success) {
        $error = "CAPTCHA verification failed. Please try again.";
    } else {
        // Check if email exists
        $stmt = $conn->prepare("SELECT userId, password, is_verified FROM User WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($userId, $hashedPassword, $isVerified);
            $stmt->fetch();

            if (!$isVerified) {
                $error = "Please verify your email before logging in.";
            } elseif (password_verify($password, $hashedPassword)) {
                // Success - Start session
                $_SESSION['user_id'] = $userId;
                $_SESSION['email'] = $email;
                header("Location: index.php");
                exit();
            } else {
                $error = "Invalid email or password.";
            }
        } else {
            $error = "No account found with this email.";
        }
        $stmt->close();
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NexRail</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
        
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="header">
        <div class="brand">NexRail</div>
        <div class="nav-links">
            <span class="current-page">Login</span>
            <a href="register.php">Register</a>
            <a href="schedule.php">Train Schedule</a>
            <a href="notification.php">Notification</a>
            <a href="arrival_depart.php">Arrival/Depart</a>
            <a href="seat_selection.php">Seat Selection</a>
            <a href="price.php">Pricing</a>
            <a href="customersupport.php">Customer Support</a>
        </div>
        <div class="hamburger" onclick="toggleDropdown()">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="dropdown" id="dropdown">
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
            <a href="schedule.php">Train Schedule</a>
            <a href="notification.php">Notification</a>
            <a href="arrival_depart.php">Arrival/Depart</a>
            <a href="seat_selection.php">Seat Selection</a>
            <a href="price.php">Pricing</a>
            <a href="customersupport.php">Customer Support</a>
        </div>
    </div>

    <!-- Login Form Section -->
    <div class="container">
        <h1 class="title" style="text-align: center; margin-top: 20px;">Next Generation Railway System</h1>

        <!-- Error Message -->
        <?php if (isset($error)): ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php endif; ?>

        <form action="login.php" method="POST" class="form-container" onsubmit="return validateForm()">
            <!-- Email Input -->
            <div class="input-box">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <!-- Password Input -->
            <div class="input-box">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <!-- reCAPTCHA Widget -->
            <div class="g-recaptcha" data-sitekey="6LfTjJwqAAAAAERLoNQF1VOa7-2F5jA_TyMRcogP"></div>

            <!-- Buttons Row -->
            <div class="button-group">
                <button type="submit">Log In</button>
                <span>Don't have an account? 
                    <a href="register.php">Register</a>
                </span>
            </div>
        </form>
    </div>

    <!-- Footer Section -->
    <div class="footer">
        <p>&copy; 2024 NexRail. All rights reserved.</p>
    </div>

    <!-- Client-Side Validation -->
    <script>
        function validateForm() {
            const email = document.getElementById("email").value.trim();
            const password = document.getElementById("password").value.trim();

            if (email === "" || password === "") {
                alert("Please fill in all fields.");
                return false;
            }
            return true;
        }
    </script>
    <script src="javascript/script.js"></script>
</body>
</html>
