<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Support - NexRail</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #ffffff;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 50%;
            margin: 50px auto;
            background: #1e1e1e;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        }

        .container h1 {
            text-align: center;
            color: #ffffff;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #cccccc;
        }

        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #333;
            border-radius: 5px;
            font-size: 16px;
            background-color: #2c2c2c;
            color: #ffffff;
        }

        .form-group textarea {
            height: 100px;
            resize: none;
        }

        .submit-btn {
            width: 100%;
            background: #4CAF50;
            color: white;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .submit-btn:hover {
            background: #45a049;
        }
    </style>
</head>
<body>
<div class="header">
    <div class="brand">NexRail</div>
    <div class="nav-links">
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
        <a href="schedule.php">Train Schedule</a>
        <a href="notification.php">Notification</a>
        <a href="arrival_depart.php">Arrival/Depart</a>
        <a href="seat_selection.php">Seat Selection</a>
        <a href="price.php">Pricing</a>
        <span class="current-page">Customer Support</span>
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
        <span class="current-page">Customer Support</span>
    </div>
</div>
    <div class="container">
        <h1>Customer Support Form</h1>
        <form action="submit_support.php" method="POST">
            <div class="form-group">
                <label for="customer-id">Customer ID</label>
                <input type="text" id="customer-id" name="customer_id" placeholder="Enter your Customer ID" required>
            </div>
            <div class="form-group">
                <label for="customer-name">Customer Name</label>
                <input type="text" id="customer-name" name="customer_name" placeholder="Enter your Name" required>
            </div>
            <div class="form-group">
                <label for="issue">Issue</label>
                <textarea id="issue" name="issue" placeholder="Describe your issue" required></textarea>
            </div>
            <div class="form-group">
                <label for="contact">Contact Details</label>
                <input type="text" id="contact" name="contact" placeholder="Enter your Contact Details" required>
            </div>
            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>
    <div class="footer">
        <p>&copy; 2024 NexRail. All rights reserved.</p>
    </div>
    <script src="javascript/script.js"></script>
</body>
</html>