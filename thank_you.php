<?php
// Start the session
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <style>
        /* Reset some default styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        /* Basic page setup */
        body {
            font-family: Arial, sans-serif;
            background-color:  #F5F5DC;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column; /* Stacks the sections vertically */
            text-align: center;
            margin: 0;
        }

        header {
            background-color:rgb(224, 139, 27);
            color: white;
            padding: 20px 0;
            width: 100%;
        }

        h1 {
            font-size: 2.5em;
        }

        .section {
            background-color: white;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            margin: 20px 0;
        }

        p {
            font-size: 1.2em;
            margin-bottom: 20px;
        }

        button {
            padding: 10px 20px;
            font-size: 1.1em;
            background-color:rgb(84, 58, 20);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: rgb(137, 105, 55);
        }

        a {
            text-decoration: none;
        }
    </style>
</head>
<body>

<!-- nav -->
<div class="navbar" style="display: flex; justify-content: center; align-items: center; background-color: #F5F5DC; padding: 15px 20px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
    <div class="navbar-left" style="display: flex; align-items: center; margin-right: auto;">
        <img src="photo/logo.png" alt="Pets Pantry Logo" class="logo" style="height: 50px; margin-right: 10px;">
        <span class="brand-name" style="font-size: 24px; font-weight: bold; color: #4B3C2A;">Pets Pantry</span>
    </div>
    <div class="navbar-center" style="display: flex; justify-content: center; align-items: center; width: 100%;">
        <a href="home.php" class="nav-link" style="text-decoration: none; font-size: 18px; color: #4B3C2A; margin: 0 20px; font-weight: 600;">Home</a>
        <a href="prod.php" class="nav-link" style="text-decoration: none; font-size: 18px; color: #4B3C2A; margin: 0 20px; font-weight: 600;">Continue Shopping</a>
    </div>
</div>
<!-- nav -->



    <header>
        <h1>Thank You!</h1>
    </header>

    <div class="section">
        <p>Your order has been placed successfully!</p>
    </div>

    <div class="section">
        <p>Order IDs: <?php echo htmlspecialchars($order_ids ?: 'No orders found'); ?></p>
        <p>Total Amount Paid: ₹<?php echo htmlspecialchars($total_sum ?: '0.00'); ?></p>

        <?php if ($orders && $order_ids !== 'No orders found') { ?>
    <!-- Button for downloading the bill -->
    <form action="generate_png.php" method="GET">
        <input type="hidden" name="order_id" value="<?php echo $orders[0]['order_id']; ?>">
        <button type="submit" class="download-button">Download Bill</button>
    </form>
<?php } ?>

    </div>
</body>
</html>
