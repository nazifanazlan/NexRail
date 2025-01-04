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

// Function to get the train number and arrival times for each station
function getScheduleData($conn, $tripNo, $scheduleIdStart, $scheduleIdEnd) {
    $scheduleData = [];
    $stationQuery = "SELECT stationName, arrivalTime FROM TrainSchedule WHERE tripNo = ? AND scheduleId BETWEEN ? AND ? ORDER BY scheduleId";
    $stmt = $conn->prepare($stationQuery);
    $stmt->bind_param("sii", $tripNo, $scheduleIdStart, $scheduleIdEnd);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $scheduleData[($row['stationName'])][] = $row['arrivalTime'];
    }
    $stmt->close();
    return $scheduleData;
}

// Query to get distinct trip numbers and their corresponding train numbers for the first schedule
$tripQuery1 = "SELECT DISTINCT tripNo, trainNo FROM TrainSchedule WHERE scheduleId BETWEEN 1 AND 1000";
$tripResult1 = $conn->query($tripQuery1);

$trips1 = [];
$trainNos1 = [];
if ($tripResult1->num_rows > 0) {
    while ($row = $tripResult1->fetch_assoc()) {
        $trips1[] = $row['tripNo'];
        $trainNos1[] = $row['trainNo'];
    }
} else {
    echo "No trips found for the first schedule.";
    exit();
}

// Get the schedule data for all trips in the first schedule
$scheduleData1 = [];
foreach ($trips1 as $tripNo) {
    $scheduleData1[$tripNo] = getScheduleData($conn, $tripNo, 1, 1000);
}

// Query to get distinct trip numbers and their corresponding train numbers for the second schedule
$tripQuery2 = "SELECT DISTINCT tripNo, trainNo FROM TrainSchedule WHERE scheduleId BETWEEN 1001 AND 2000";
$tripResult2 = $conn->query($tripQuery2);

$trips2 = [];
$trainNos2 = [];
if ($tripResult2->num_rows > 0) {
    while ($row = $tripResult2->fetch_assoc()) {
        $trips2[] = $row['tripNo'];
        $trainNos2[] = $row['trainNo'];
    }
} else {
    echo "No trips found for the second schedule.";
    exit();
}

// Get the schedule data for all trips in the second schedule
$scheduleData2 = [];
foreach ($trips2 as $tripNo) {
    $scheduleData2[$tripNo] = getScheduleData($conn, $tripNo, 1001, 2000);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KTM Komuter Schedule - NexRail</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/schedule.css">
</head>
<body>
<div class="header">
        <div class="brand">NexRail</div>
        <div class="nav-links">
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
            <a href="schedule.php">Train Schedule</span>
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
    <div class="container">
        <div class="title">
            <h1>KTM Komuter Schedule</h1>
        </div>
        <a href="schedule.php" class="back-button">Back to Train Schedule</a>
        <h2>Weekday Timetable</h2>
        <table class="schedule-table weekday">
        <thead>
                <tr>
                    <td colspan="10">Tanjung Malim - KL Central Service Timetable (Working Days) Effective 13th May 2024</td>
                </tr>
                <tr>
                    <td>Trip No</td>
                    <?php foreach ($trips1 as $index => $tripNo): ?>
                        <td><?php echo $index + 1; ?></td>
                    <?php endforeach; ?>
                </tr>
                <tr>
                    <td>Train No</td>
                    <?php foreach ($trainNos1 as $trainNo): ?>
                        <td><?php echo $trainNo; ?></td>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                // Get all station names for the first schedule
                $allStations1 = [];
                foreach ($scheduleData1 as $tripNo => $stations) {
                    foreach ($stations as $stationName => $times) {
                        if (!in_array($stationName, $allStations1)) {
                            $allStations1[] = $stationName;
                        }
                    }
                }

                // Display arrival times for each station in the first schedule
                foreach ($allStations1 as $index => $stationName): ?>
                    <tr class="weekday-row <?php echo $index >= 5 ? 'hidden-row' : ''; ?>">
                        <th><?php echo $stationName; ?></th>
                        <?php foreach ($trips1 as $tripNo): ?>
                            <td><?php echo isset($scheduleData1[$tripNo][$stationName][0]) ? $scheduleData1[$tripNo][$stationName][0] : ''; ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="javascript:void(0);" class="show-more weekday">Show More</a>
        <a href="javascript:void(0);" class="show-less weekday" style="display:none;">Show Less</a>

        <!-- Second Schedule -->
        <h3>Weekends & Public Holiday Timetable</h3>
        <table class="schedule-table weekend">
            <thead>
                <tr>
                    <td colspan="10">Tanjung Malim - KL Central Service Timetable (Weekends & Public Holidays) Effective 13th May 2024</td>
                </tr>
                <tr>
                    <td>Trip No</td>
                    <?php foreach ($trips2 as $index => $tripNo): ?>
                        <td><?php echo $index + 1; ?></td>
                    <?php endforeach; ?>
                </tr>
                <tr>
                    <td>Train No</td>
                    <?php foreach ($trainNos2 as $trainNo): ?>
                        <td><?php echo $trainNo; ?></td>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                // Get all station names for the second schedule
                $allStations2 = [];
                foreach ($scheduleData2 as $tripNo => $stations) {
                    foreach ($stations as $stationName => $times) {
                        if (!in_array($stationName, $allStations2)) {
                            $allStations2[] = $stationName;
                        }
                    }
                }

                // Display arrival times for each station in the second schedule
                foreach ($allStations2 as $index => $stationName): ?>
                    <tr class="weekend-row <?php echo $index >= 5 ? 'hidden-row' : ''; ?>">
                        <th><?php echo $stationName; ?></th>
                        <?php foreach ($trips2 as $tripNo): ?>
                            <td><?php echo isset($scheduleData2[$tripNo][$stationName][0]) ? $scheduleData2[$tripNo][$stationName][0] : ''; ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="javascript:void(0);" class="show-more weekend">Show More</a>
        <a href="javascript:void(0);" class="show-less weekend" style="display:none;">Show Less</a>
                 
    </div>
    <script src="javascript/script.js"></script>
    <script>
// Function for xxx_schedule.php to expand the table
function showMore(scheduleClass) {
    var rows = document.querySelectorAll(`.${scheduleClass}-row.hidden-row`);
    rows.forEach(function(row) {
        row.style.display = 'table-row';
    });
    document.querySelector(`.show-more.${scheduleClass}`).style.display = 'none';
    document.querySelector(`.show-less.${scheduleClass}`).style.display = 'block';
}

function showLess(scheduleClass) {
    var rows = document.querySelectorAll(`.${scheduleClass}-row.hidden-row`);
    rows.forEach(function(row) {
        row.style.display = 'none';
    });
    document.querySelector(`.show-more.${scheduleClass}`).style.display = 'block';
    document.querySelector(`.show-less.${scheduleClass}`).style.display = 'none';
}

// Ensure the script runs after the DOM is fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Add event listeners for show more/less buttons
    var showMoreButtons = document.querySelectorAll('.show-more');
    var showLessButtons = document.querySelectorAll('.show-less');

    showMoreButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            showMore(button.classList.contains('weekday') ? 'weekday' : 'weekend');
        });
    });

    showLessButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            showLess(button.classList.contains('weekday') ? 'weekday' : 'weekend');
        });
    });
});
    </script>
</body>
</html>
<?php
$conn->close();
?>