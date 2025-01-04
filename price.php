<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Train Service Pricing</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .back-button {
            display: block;
            margin: 20px 0;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            width: fit-content;
        }
        .back-button:hover {
        background-color: #45a049;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        header {
            background-color: #333;
            color: white;
            padding: 20px;
            text-align: center;<!DOCTYPE html>

        }
        .pricing-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }
        .pricing-card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 15px;
            width: 300px;
            padding: 20px;
            text-align: center;
        }
        .pricing-card h2 {
            color: #333;
            margin-bottom: 10px;
        }
        .pricing-card p {
            margin: 10px 0;
            color: #555;
        }
        .pricing-card .price {
            font-size: 1.5em;
            color: #007BFF;
            margin: 20px 0;
        }
        .pricing-card .distance {
            font-size: 1em;
            color: #333;
            margin: 10px 0;
        }
        .pricing-card .cta {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
        }
        .pricing-card .cta:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <h1>Train Service Pricing</h1>
        <p>Affordable and Convenient Travel Options</p>
    </header>
    
    <a href="index.php" class="back-button">Back to Homepage</a>

    <div class="pricing-container">
        <div class="pricing-card">
            <h2>Economy Class</h2>
            <p>Comfortable seating at an affordable price.</p>
            <div class="distance">Distance: 50 km</div>
            <div class="price">Fare: RM10</div>
            <a href="#" class="cta">Book Now</a>
        </div>

        <div class="pricing-card">
            <h2>Business Class</h2>
            <p>Extra space and added comfort for your journey.</p>
            <div class="distance">Distance: 50 km</div>
            <div class="price">Fare: RM20</div>
            <a href="#" class="cta">Book Now</a>
        </div>

        <div class="pricing-card">
            <h2>First Class</h2>
            <p>Luxury travel with premium services.</p>
            <div class="distance">Distance: 50 km</div>
            <div class="price">Fare: RM50</div>
            <a href="#" class="cta">Book Now</a>
        </div>
    </div>
    <div class="footer">
        <p>&copy; 2024 NexRail. All rights reserved.</p>
    </div>
    <script src="javascript/script.js"></script>
</body>
</html>
