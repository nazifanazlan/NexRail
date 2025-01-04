<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $trainService = $_POST['trainService'];
    $departureTime = $_POST['departureTime'];
    $arrivalTime = $_POST['arrivalTime'];
    $pax = $_POST['pax'];

    // Example available seats, replace with dynamic content from the database if needed
    $availableSeats = ['A10', 'B30', 'C20', 'D15', 'E25'];
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
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #333;
            color: white;
        }

        .header .brand {
            font-size: 24px;
            font-weight: bold;
        }

        .nav-links {
            display: flex;
            justify-content: flex-end;
            flex-grow: 1;
        }

        .nav-links a, .nav-links span {
            margin: 0 10px;
            text-decoration: none;
            color: white;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container h2 {
            margin-top: 0;
        }

        .available-seats button, .selected-seats button {
            margin: 5px;
            padding: 10px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
        }

        .available-seats button:hover, .selected-seats button:hover {
            background-color: #45a049;
        }

        
        .selected-seats div {
            display: inline-block;
            margin: 5px;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border-radius: 3px;
        }

        .confirm-button, .booking-button {
            display: none;
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 3px;
        }

        .confirm-button:hover, .booking-button:hover {
            background-color: #45a049;
        }

        .selected-seats {
            margin-top: 20px;
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
    </div>

    <div class="container">
    <h2>Seat Selection for <?php echo $trainService; ?></h2>
    <div class="available-seats">
        <h3>Available Seats</h3>
        <div id="availableSeats">
            <?php foreach ($availableSeats as $seat): ?>
                <button onclick="selectSeat(this)"><?php echo $seat; ?></button>
            <?php endforeach; ?>
        </div>
        <button class="confirm-button" onclick="confirmSeat()">Confirm</button>
        <button class="cancel-button" onclick="cancelSelection()">Cancel</button>
    </div>
    <div class="selected-seats">
        <h3>Selected Seats</h3>
        <div id="selectedSeats"></div>
        <button class="Booking-button" onclick="proceedToBooking()">Proceed to Booking</button>
    </div>

    <script>
        let selectedSeats = [];
        let paxCount = <?php echo $pax; ?>;

        function selectSeat(button) {
            if (button.classList.contains('selected')) {
                button.classList.remove('selected');
                selectedSeats = selectedSeats.filter(seat => seat !== button.textContent);
            } else {
                if (selectedSeats.length < paxCount) {
                    button.classList.add('selected');
                    selectedSeats.push(button.textContent);
                }
            }
            updateSelectedSeats();
        }

        function confirmSeat() {
            if (selectedSeats.length >= paxCount) {
                document.querySelector('.confirm-button').style.display = 'none';
                document.querySelector('.booking-button').style.display = 'block';
            }
        }

        function updateSelectedSeats() {
            const selectedSeatsContainer = document.getElementById('selectedSeats');
            selectedSeatsContainer.innerHTML = '';
            selectedSeats.forEach(seat => {
                const seatElement = document.createElement('div');
                seatElement.textContent = seat;
                selectedSeatsContainer.appendChild(seatElement);
            });
            document.querySelector('.confirm-button').style.display = selectedSeats.length >= paxCount ? 'none' : 'block';
            document.querySelector('.booking-button').style.display = selectedSeats.length >= paxCount ? 'block' : 'none';
        }

        function cancelSelection() {
            window.location.href = 'seat_selection.php';
        }

        function proceedToBooking() {
            alert('Booking...');
            // Implement booking logic here
        }
    </script>
</body>
</html>