<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seat Selection - NexRail</title>
    <link rel="stylesheet" href="css/seat.css">
    <script>
        // Function to extract URL parameters
        function getQueryParameter(name) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(name);
        }

        // Validate seat selection
        function validateSeatSelection() {
            const pax = parseInt(getQueryParameter('pax')); // Get pax from URL query
            let selectedSeats = 0;

            // Check selected seats
            if (document.querySelector('select[name="seat_a"]').value) selectedSeats++;
            if (document.querySelector('select[name="seat_b"]').value) selectedSeats++;
            if (document.querySelector('select[name="seat_c"]').value) selectedSeats++;

            // Validate if the selected seats match the number of passengers
            if (selectedSeats !== pax) {
                alert("The number of seats selected does not match the number of passengers. Please select the correct number of seats.");
                return false; // Prevent form submission
            }
            return true; // Allow form submission
        }
    </script>
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

    <h1>Seat Selection</h1>
    <div class="search-section">
        <form action="seat_selection.php" method="GET">
            <label for="origin">Origin:</label>
            <select id="origin" name="origin">
                <option value="Penang Sentral">Penang Sentral</option>
                <option value="KL Sentral">KL Sentral</option>
                <option value="JB Sentral">JB Sentral</option>
            </select>

            <label for="destination">Destination:</label>
            <select id="destination" name="destination">
                <option value="Penang Sentral">Penang Sentral</option>
                <option value="KL Sentral">KL Sentral</option>
                <option value="JB Sentral">JB Sentral</option>
            </select>

            <label for="train-type">Train Type:</label>
            <select id="train-type" name="train_type">
                <option value="Komuter">Komuter</option>
                <option value="ETS">ETS</option>
                <option value="Intercity">Intercity</option>
            </select>

            <label for="pax">Number of Pax:</label>
            <input type="number" id="pax" name="pax" min="1" max="10" placeholder="1">

            <label for="date">Date:</label>
            <input type="date" id="date" name="date">

            <!-- New Time Picker -->
            <label for="time">Time:</label>
            <input type="time" id="time" name="time">
        </form>
    </div>

    <div class="content">

        <!-- Seat Selection Section -->
        <div class="seat-selection">
            <form action="confirm_seat.php" method="POST" onsubmit="return validateSeatSelection()">
                <table class="train-table">
                    <thead>
                        <tr>
                            <th>Coach</th>
                            <th>Price</th>
                            <th>Available Seats</th>
                            <th>Select Seat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>A</td>
                            <td>RM30</td>
                            <td>5</td>
                            <td>
                                <select name="seat_a">
                                    <option value="">Choose a seat</option>
                                    <option value="A1">A1</option>
                                    <option value="A2">A2</option>
                                    <option value="A3">A3</option>
                                    <option value="A7">A7</option>
                                    <option value="A9">A9</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>B</td>
                            <td>RM15</td>
                            <td>3</td>
                            <td>
                                <select name="seat_b">
                                    <option value="">Choose a seat</option>
                                    <option value="B1">B1</option>
                                    <option value="B2">B2</option>
                                    <option value="B3">B3</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>C</td>
                            <td>RM10</td>
                            <td>5</td>
                            <td>
                                <select name="seat_c">
                                    <option value="">Choose a seat</option>
                                    <option value="C1">C1</option>
                                    <option value="C2">C2</option>
                                    <option value="C3">C3</option>
                                    <option value="C7">C7</option>
                                    <option value="C8">C8</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- Hidden input to store pax value -->
                <input type="hidden" name="pax" value="" id="pax-value">

                <button type="submit">Confirm Selection</button>
            </form>
        </div>

    </div>

    <div class="footer">
        <p>&copy; 2024 NexRail. All rights reserved.</p>
    </div>

    <script src="javascript/script.js"></script>
</body>
</html>
