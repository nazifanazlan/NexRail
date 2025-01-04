<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Train Arrival/Departure - NexRail</title>
    <link rel="stylesheet" href="css/arrivedepart.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="header">
        <div class="brand">NexRail</div>
        <div class="nav-links">
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
            <a href="schedule.php">Train Schedule</a>
            <a href="notification.php">Notification</a>
            <span class="current-page">Arrival/Depart</span>
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
            <span class="current-page">Arrival/Depart</span>
            <a href="seat_selection.php">Seat Selection</a>
            <a href="price.php">Pricing</a>
            <a href="customersupport.php">Customer Support</a>
        </div>
    </div>

    <div class="content">
        <h1>Train Arrival and Departure Information</h1>

        <!-- Train Schedule Table -->
        <table class="train-table">
            <thead>
                <tr>
                    <th>Train Number</th>
                    <th>Train Name</th>
                    <th>Departure Station</th>
                    <th>Departure Time</th>
                    <th>Arrival Station</th>
                    <th>Arrival Time</th>
                    <th>Platform</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>12345</td>
                    <td>ETS</td>
                    <td>Penang Sentral</td>
                    <td>10:00 AM</td>
                    <td>KL Sentral</td>
                    <td>2:00 PM</td>
                    <td>5</td>
                    <td>On Time</td>
                </tr>
                <tr>
                    <td>68790</td>
                    <td>ETS</td>
                    <td>KL Sentral</td>
                    <td>11:00 AM</td>
                    <td>Gemas</td>
                    <td>4:30 PM</td>
                    <td>2</td>
                    <td>On Time</td>
                </tr>
                <tr>
                    <td>76890</td>
                    <td>Komuter</td>
                    <td>Padang Besar</td>
                    <td>2:30 PM</td>
                    <td>Penang Sentral</td>
                    <td>5:30 PM</td>
                    <td>3</td>
                    <td>Delayed</td>
                </tr>
                <tr>
                    <td>23113</td>
                    <td>Komuter</td>
                    <td>Penang Sentral</td>
                    <td>2:30 PM</td>
                    <td>Alor Setar</td>
                    <td>3:30 PM</td>
                    <td>1</td>
                    <td>On Time</td>
                </tr>
            </tbody>
        </table>

        <!-- Real-time Tracker Section -->
        <div class="tracker-section">
            <h2>Real-Time Train Tracker</h2>
            <p>Track your train's live location and estimated arrival time.</p>
            <div id="real-time-tracker">
            </div>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2024 NexRail. All rights reserved.</p>
    </div>

    <script src="javascript/script.js"></script>
</body>
</html>
