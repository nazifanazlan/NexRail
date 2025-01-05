<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'railsys');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update price if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['product_id'];
    $new_price = $_POST['price_' . $id];  // Changed to use unique price field name
    
    // Update the price in the database
    $stmt = $conn->prepare("UPDATE products SET price = ? WHERE id = ?");
    $stmt->bind_param("di", $new_price, $id);
    $stmt->execute();
    $stmt->close();
    
    header("Location: modifyprice.php");
    exit;
}

// Fetch all products
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Prices</title>
</head>
<body>
    <h1>Modify Product Prices</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Product</th>
                <th>Current Price</th>
                <th>New Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['price']); ?></td>
                    <td>
                        <!-- Each product has its own form -->
                        <form method="post" action="">
                            <input type="number" 
                                   step="0.01" 
                                   name="price_<?php echo $row['id']; ?>" 
                                   value="<?php echo htmlspecialchars($row['price']); ?>">
                            <input type="hidden" 
                                   name="product_id" 
                                   value="<?php echo $row['id']; ?>">
                            <button type="submit">Save</button>
                        </form>
                    </td>
                    <td>
                        Current ID: <?php echo $row['id']; ?> 
                        <!-- Added for debugging -->
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="price.php">View Prices</a>
</body>
</html>
<?php $conn->close(); ?>