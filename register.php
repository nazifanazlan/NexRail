<?php
session_start();

// Include Composer autoloader
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Database configuration
$host = "localhost";
$user = "root";
$password = "";
$database = "railsys";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Handle registration form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm-password']);

    // Password policy check
    $passwordPolicy = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";

    // Check if passwords match
    if ($password !== $confirmPassword) {
        $error = "Passwords do not match.";
    } elseif (!preg_match($passwordPolicy, $password)) {
        $error = "Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character (@$!%*?&).";
    } else {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT userId FROM User WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "Email is already registered. Please use a different email.";
        } else {
            // Insert new user into the database
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $verificationCode = md5(rand() . time()); // Generate a random verification code

            // Use prepared statement to insert user data into the database
            $stmt = $conn->prepare("INSERT INTO User (userName, email, password, is_verified, verification_code) VALUES (?, ?, ?, 0, ?)");
            $stmt->bind_param("ssss", $username, $email, $hashedPassword, $verificationCode);

            if ($stmt->execute()) {
                // Send verification email using PHPMailer
                $verificationLink = "http://localhost/railsystemNexRail/verify_email.php?code=$verificationCode";
                $subject = "Verify Your NexRail Account";
                $message = "Hello $username,\n\nPlease click the link below to verify your email and activate your account:\n\n$verificationLink\n\nThank you,\nNexRail Team";

                // PHPMailer setup
                $mail = new PHPMailer(true);  // Correct class initialization with exception handling enabled
                try {
                    $mail->isSMTP();  // Use SMTP for sending
                    $mail->Host = 'smtp.gmail.com';  // Your SMTP server (e.g., Gmail)
                    $mail->SMTPAuth = true;
                    $mail->Username = 'kemalhazeeq99@gmail.com';  // Your email address
                    $mail->Password = 'ubko hbkz fvbi deuz';  // Your email password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;  // SMTP port (use 465 for SSL)

                    $mail->setFrom('no-reply@nexrail.com', 'NexRail');
                    $mail->addAddress($email, $username);  // Add the recipient
                    $mail->Subject = $subject;
                    $mail->Body    = $message;

                    if ($mail->send()) {
                        $success = "Registration successful! Please check your email to verify your account.";
                    } else {
                        $error = "Registration successful, but failed to send verification email. Mailer Error: " . $mail->ErrorInfo;
                    }
                } catch (Exception $e) {
                    $error = "Mailer Error: " . $mail->ErrorInfo;
                }
            } else {
                $error = "Error: Could not register. Please try again later.";
            }
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
    <title>Register - NexRail</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .form-container {
            max-width: 800px;
            margin: 0 auto;
        }
        .form-group {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            margin-top: 30px;
        }
        .form-group .input-box {
            width: 45%;
        }
        .input-box label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
        }
        .input-box input {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 10px;
            box-sizing: border-box; 
        }
        .button-group {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-top: 30px;
        }
        .button-group button {
            background-color: #D9D9D9;
            color: black;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .button-group a {
            color: white;
            text-decoration: underline;
        }
        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 20px;
        }
        .success-message {
            color: green;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="brand">NexRail</div>
        <div class="nav-links">
            <a href="login.php">Login</a>
            <span class="current-page">Register</span>
            <a href="schedule.php">Train Schedule</a>
            <a href="faq.php">FAQ</a>
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
            <span class="current-page">Register</span>
            <a href="schedule.php">Train Schedule</a>
            <a href="notification.php">Notification</a>
            <a href="arrival_depart.php">Arrival/Depart</a>
            <a href="seat_selection.php">Seat Selection</a>
            <a href="price.php">Pricing</a>
            <a href="customersupport.php">Customer Support</a>
        </div>
    </div>

    <div class="container">
        <h1 class="title" style="text-align: center;">Next Generation Railway System</h1>

        <!-- Error or Success Message -->
        <?php if (isset($error)): ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php elseif (isset($success)): ?>
            <p class="success-message"><?php echo $success; ?></p>
        <?php endif; ?>

        <!-- Registration Form -->
        <form action="register.php" method="POST" class="form-container">
            <div class="form-group">
                <div class="input-box">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input-box">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
            </div>

            <div class="form-group">
                <div class="input-box">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-box">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" id="confirm-password" name="confirm-password" required>
                </div>
            </div>

            <div class="button-group">
                <button type="submit">Register Now</button>
                <span>Already have an account? <a href="login.php">Login</a></span>
            </div>
        </form>
    </div>

    <div class="footer">
        <p>&copy; 2024 NexRail. All rights reserved.</p>
    </div>
    <script src="javascript/script.js"></script>
</body>
</html>
