<?php
// Start the session to access the cart and user data
session_start();

// Database connection (replace with your actual database credentials)
$host = 'localhost';
$dbname = 'pwc';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Fetch users whose IDs exist in the `orders` table along with their order details
$query = "
    SELECT u.id AS user_id, u.fullname, u.email, u.phone, u.address, o.order_id, o.product_name, o.order_date
    FROM user u
    JOIN orders o ON u.id = o.user_id
    JOIN product p ON o.product_id = p.id
    WHERE u.id IN (SELECT DISTINCT user_id FROM orders)
";
$stmt = $pdo->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer List - Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f8f9fa;
            color: #333;
        }
        h2 {
            color: #543A14;   
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color:rgb(205, 119, 6);
            color: #fff;
            text-transform: uppercase;
            font-size: 14px;
        }
        tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
        }
        tbody tr:hover {
            background-color: #FFF0DC;
            cursor: pointer;
        }
        td {
            font-size: 14px;
        }
    </style>
</head>
<body>
        <!-- navbar -->
         
<!-- sidebar -->
<?php include("sidebar_admin.php"); ?>

    <h2>Customer List</h2>

    <!-- Table to display filtered users with order details -->
    <table>
        <thead>
            <tr>
                <th>Customer ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Order ID</th>
                <th>Product Name</th>
                <th>Order Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['user_id']); ?></td>
                    <td><?php echo htmlspecialchars($user['fullname']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo htmlspecialchars($user['phone']); ?></td>
                    <td><?php echo htmlspecialchars($user['address']); ?></td>
                    <td><?php echo htmlspecialchars($user['order_id']); ?></td>
                    <td><?php echo htmlspecialchars($user['product_name']); ?></td>
                    <td><?php echo htmlspecialchars($user['order_date']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
