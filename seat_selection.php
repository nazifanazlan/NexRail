<?php
// Database configuration
$host = "localhost";
$user = "root";
$password = "";
$database = "railsys";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Fetch distinct stations for origin and destination dropdowns
$stationQuery = "SELECT DISTINCT stationName FROM trainSchedule";
$stationResult = $conn->query($stationQuery);

$stations = [];
if ($stationResult->num_rows > 0) {
    while ($row = $stationResult->fetch_assoc()) {
        $stations[] = $row['stationName'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seat Selection - NexRail</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/seat.css">
    <style>
        #trainResults {
    margin-top: 20px;
}

#trainTable {
    width: 100%;
    border-collapse: collapse;
}

#trainTable th, #trainTable td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

#trainTable th {
    background-color: #333;
    color: white;
}

#trainTable tr:nth-child(even) {
    background-color: #444;
}

#trainTable tr:hover {
    background-color: #555}

#trainTable th, #trainTable td {
    padding: 12px 15px;
}

#trainTable th {
    background-color: #4CAF50;
    color: white;
}

#trainTable td button {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
}

#trainTable td button:hover {
    background-color: #45a049;
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
            <span class="current-page">Seat Selection</span>
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
            <span class="current-page">Seat Selection</span>
            <a href="price.php">Pricing</a>
            <a href="customersupport.php">Customer Support</a>
        </div>
    </div>

    <h2>Train Ticket Booking</h2>
    <!-- Form for selecting origin, destination, and departure date -->
    <div class="search-section">
    <form id="searchForm" method="POST" action="">
    <label for="origin">Origin:</label>
    <select id="origin" name="origin" required>
        <option value="">Select Origin</option>
        <?php foreach ($stations as $station): ?>
            <option value="<?php echo $station; ?>"><?php echo $station; ?></option>
        <?php endforeach; ?>
    </select>

    <label for="destination">Destination:</label>
    <select id="destination" name="destination" required>
        <option value="">Select Destination</option>
        <?php foreach ($stations as $station): ?>
            <option value="<?php echo $station; ?>"><?php echo $station; ?></option>
        <?php endforeach; ?>
    </select>

    <label for="departureDate">Departure Date:</label>
    <input type="date" id="departureDate" name="departureDate" min="<?php echo date('Y-m-d'); ?>" required>

    <label for="departureTime">Departure Time:</label>
    <select id="departureTime" name="departureTime" required>
        <option value="">Select Departure Time</option>
        <?php for ($i = 0; $i < 24; $i++): ?>
            <option value="<?php echo str_pad($i, 2, '0', STR_PAD_LEFT) . ':00'; ?>"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT) . ':00'; ?></option>
        <?php endfor; ?>
    </select>

    <label for="pax">Number of Passengers:</label>
    <input type="number" id="pax" name="pax" min="1" max="8" required>
    <button type="submit">Search Available Trains</button>
</form>
    </div>

    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $origin = $_POST['origin'];
    $destination = $_POST['destination'];
    $departureDate = $_POST['departureDate'];
    $departureTime = $_POST['departureTime'];
    $pax = $_POST['pax'];

    // Query to get available trains
    $trainQuery = "SELECT * FROM trainSchedule WHERE stationName = '$origin' AND arrivalTime > '$departureTime' ORDER BY scheduleId";
    $trainResult = $conn->query($trainQuery);

    $trains = [];
    if ($trainResult->num_rows > 0) {
        while ($row = $trainResult->fetch_assoc()) {
            // Check if destination exists in the same tripNo and trainType with a larger scheduleId
            $destinationQuery = "SELECT * FROM trainSchedule WHERE tripNo = '{$row['tripNo']}' AND trainNo = '{$row['trainNo']}' AND stationName = '$destination' AND scheduleId > {$row['scheduleId']}";
            $destinationResult = $conn->query($destinationQuery);
            if ($destinationResult->num_rows > 0) {
                $destinationRow = $destinationResult->fetch_assoc();
                $row['destinationArrivalTime'] = $destinationRow['arrivalTime'];
                $trains[] = $row;
            }
        }
    }
}
?>

<?php if (!empty($trains)): ?>
    <div id="trainResults">
        <h3>Available Trains</h3>
        <table id="trainTable">
            <thead>
                <tr>
                    <th>Train Service</th>
                    <th>Departure Time</th>
                    <th>Arrival Time</th>
                    <th>Available Seats</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($trains as $train): ?>
                        <tr>
                            <td><?php echo $train['trainName'] . ' - ' . $train['trainNo']; ?></td>
                            <td><?php echo $train['arrivalTime']; ?></td>
                            <td><?php echo $train['destinationArrivalTime']; ?></td>
                            <td><?php echo rand(1, 100); ?></td>
                            <td>RM13.00</td>
                            <td>
                                <form method="POST" action="seat_selection_next.php">
                                <input type="hidden" name="trainService" value="<?php echo $train['trainName'] . ' - ' . $train['trainNo']; ?>">
                                <input type="hidden" name="departureTime" value="<?php echo $train['arrivalTime']; ?>">
                                <input type="hidden" name="arrivalTime" value="<?php echo $train['destinationArrivalTime']; ?>">
                                <input type="hidden" name="pax" value="<?php echo $pax; ?>">
                                <button type="submit">Pick Seat</button>
                                </form>
                            </td>
                        </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
    <div id="noResults">
        <h3>No Available Trains</h3>
        <p>Sorry, there are no available trains for the selected criteria.</p>
    </div>
<?php endif; ?>

    <script src="javascript/script.js"></script>
    <script>
        document.getElementById('origin').addEventListener('change', function() {
        var origin = this.value;
        var destinationOptions = document.getElementById('destination').options;
        for (var i = 0; i < destinationOptions.length; i++) {
            destinationOptions[i].disabled = destinationOptions[i].value === origin;
        }
    });
    </script>
</body>
</html>
