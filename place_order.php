<?php
session_start();

// Database connection (update with your DB credentials)
$host = 'localhost';
$dbname = 'pwc';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Check if user_id is available in the session
$user_id = $_SESSION['user_id'] ?? null;

if ($user_id) {
    // Fetch order details for the specific user
    $stmt = $pdo->prepare("SELECT order_id, price FROM orders WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $orders = $stmt->fetchAll();

    // Initialize variables
    $order_ids = [];
    $total_sum = 0;

    // Process orders if found
    if ($orders) {
        foreach ($orders as $order) {
            $order_ids[] = $order['order_id']; // Collect order IDs
            $total_sum += $order['price']; // Sum up the total prices
        }
        $order_ids = implode(', ', $order_ids); // Join order IDs with commas
        $total_sum = number_format($total_sum, 2); // Format total
    } else {
        // No orders found for this user
        $order_ids = 'No orders found';
        $total_sum = '0.00';
    }
} else {
    // If user_id is not in session, show a message
    $order_ids = 'User not logged in';
    $total_sum = '0.00';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_payment'])) {
    header('Location: thank_you.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #F0BB78;
            padding: 50px;
        }
        .container {
            background: white;
            padding: 50px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: inline-block;
        }
        img {
            width: 150px;
            margin: 50px 1;
        }
        button {
            background-color: rgb(125, 87, 31);
            color: white;
            padding: 12px 20px;
            font-size: 18px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: 0.3s;
        }
        button:hover {
            background-color: #005f73;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Scan to Pay</h2>
        <img src="photo/QR_CODE.png" alt="QR Code for Payment">
        
        <p>Total Amount Paid: ₹<?php echo htmlspecialchars($total_sum ?: '0.00'); ?></p>

        <form method="POST">
            <button type="submit" name="confirm_payment">Pay Now</button>
        </form>
    </div>

</body>
</html>
