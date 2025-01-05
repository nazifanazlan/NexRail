<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data passed from seat_selection_next.php
    $trainService = $_POST['trainService'] ?? '';
    $departureTime = $_POST['departureTime'] ?? '';
    $arrivalTime = $_POST['arrivalTime'] ?? '';
    $origin = $_POST['origin'] ?? '';
    $destination = $_POST['destination'] ?? '';
    $pax = $_POST['pax'] ?? 1;
    $totalPrice = $_POST['totalPrice'] ?? 0;
    $selectedSeats = $_POST['selectedSeats'] ?? '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - NexRail</title>
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
            <a href="arrival_depart.php">Arrival/Depart</a>
            <span class="current-page">Payment</span>
            <a href="price.php">Pricing</a>
            <a href="customersupport.php">Customer Support</a>
        </div>
    </div>

    <h2>Payment Summary</h2>
    <div>
        <p><strong>Train Service:</strong> <?php echo htmlspecialchars($trainService); ?></p>
        <p><strong>Departure Time:</strong> <?php echo htmlspecialchars($departureTime); ?></p>
        <p><strong>Arrival Time:</strong> <?php echo htmlspecialchars($arrivalTime); ?></p>
        <p><strong>Number of Passengers:</strong> <?php echo htmlspecialchars($pax); ?></p>
        <p><strong>Selected Seats:</strong> <?php echo htmlspecialchars($selectedSeats); ?></p>
        <p><strong>Total Price:</strong> RM<?php echo htmlspecialchars($totalPrice); ?></p>
    </div>

    <form method="POST" action="finalize_payment.php">
        <input type="hidden" name="trainService" value="<?php echo htmlspecialchars($trainService); ?>">
        <input type="hidden" name="departureTime" value="<?php echo htmlspecialchars($departureTime); ?>">
        <input type="hidden" name="arrivalTime" value="<?php echo htmlspecialchars($arrivalTime); ?>">
        <input type="hidden" name="origin" value="<?php echo htmlspecialchars($origin); ?>">
        <input type="hidden" name="destination" value="<?php echo htmlspecialchars($destination); ?>">
        <input type="hidden" name="pax" value="<?php echo htmlspecialchars($pax); ?>">
        <input type="hidden" name="totalPrice" value="<?php echo htmlspecialchars($totalPrice); ?>">
        <input type="hidden" name="selectedSeats" value="<?php echo htmlspecialchars($selectedSeats); ?>">

        <button type="submit">Confirm Payment</button>
    </form>
</body>
</html>
