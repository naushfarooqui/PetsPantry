<?php
// Start the session
session_start();

// Database connection (replace with actual connection details)
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

// Fetch total sales for each day of the week (Monday to Sunday)
$query = "
    SELECT DAYOFWEEK(order_date) AS day_of_week, SUM(price) AS total_sales
    FROM orders
    GROUP BY DAYOFWEEK(order_date)
    ORDER BY day_of_week";
$stmt = $pdo->prepare($query);
$stmt->execute();
$data = $stmt->fetchAll();

// Prepare data for daily sales chart
$sales = [0, 0, 0, 0, 0, 0, 0];  // Array to hold sales data for Sunday to Saturday
foreach ($data as $row) {
    $sales[$row['day_of_week'] - 1] = $row['total_sales'];  // Map sales to correct day
}

// Prepare labels for days of the week
$labels = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

// Fetch low stock products (threshold: 10)
$sql = "SELECT name, quantity FROM product WHERE quantity < 10";
$result = $pdo->query($sql);
$productNames = [];
$productQuantities = [];

if ($result->rowCount() > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $productNames[] = $row['name'];
        $productQuantities[] = $row['quantity'];
    }
}

// Fetch recent orders using PDO
$sql = "SELECT * FROM orders ORDER BY order_date DESC LIMIT 3";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #F0BB78;
            text-align: center;
        }
        h1, h2 {
            color: #543A14;
            margin-bottom: 20px;
        }
        .chart-container {
            width: 70%;
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        /* Styling for Recent Orders section */
        .recent-orders {
            background-color:rgb(237, 215, 208);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        /* Heading for Recent Orders */
        .recent-orders h3 {
            margin-bottom: 15px;
            font-size: 20px;
            font-weight: bold;
            color: #2c3e50;
        }

        /* Table Styling */
        .recent-orders table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
        }

        .recent-orders table thead {
            background-color: #f2a65f;  /* Light orange background */
            color: white;
        }

        .recent-orders table th, .recent-orders table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 14px;  /* Smaller font size for readability */
        }

        .recent-orders table th {
            font-weight: bold;
        }

        .recent-orders table tbody tr:hover {
            background-color: #f1f1f1;  /* Light grey background on hover */
            transition: background-color 0.3s ease;
        }

        /* Style for the "No orders found" message */
        .recent-orders .no-orders {
            text-align: center;
            font-style: italic;
            color: #7f8c8d;
            padding: 15px;
        }

        /* Responsiveness for smaller screens */
        @media (max-width: 768px) {
            .recent-orders table th, .recent-orders table td {
                font-size: 12px;  /* Smaller font for mobile */
                padding: 8px;
            }

            .recent-orders h3 {
                font-size: 18px;  /* Smaller heading on mobile */
            }
        }
    </style>
</head>
<body>
<!-- navbar -->
 

<!-- sidebar -->
<?php include("sidebar_admin.php"); ?>




<!-- Recent Orders Section -->
<div class="card recent-orders">
    <h3>Recent Orders</h3>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer ID</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($orders && count($orders) > 0) {
                foreach ($orders as $order) {
                    echo '<tr>';
                    echo '<td>#' . $order['order_id'] . '</td>';
                    echo '<td>' . $order['user_id'] . '</td>';
                    echo '<td> ₹ ' . number_format($order['price'], 2) . '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="3" class="no-orders">No orders found.</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Your other sections (charts) -->
<h2>Daily Sales for the Week</h2>
<div class="chart-container">
    <canvas id="salesChart" width="400" height="200"></canvas>
</div>

<h2>Low Stock Products</h2>
<div class="chart-container">
    <canvas id="lowStockChart" width="400" height="200"></canvas>
</div>

<script>
    // Daily Sales Line Chart
    const ctx1 = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx1, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($labels); ?>,  // Labels for days of the week
            datasets: [{
                label: 'Total Sales',
                data: <?php echo json_encode($sales); ?>,  // Sales data for each day
                borderColor: 'hsl(46, 39.90%, 30.00%)',  // Line color
                backgroundColor: 'rgba(139, 69, 19, 0.2)',  // Background fill color
                fill: true,  // Fill area under the line
                tension: 0.1  // Line smoothness
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Low Stock Products Bar Chart
    const ctx2 = document.getElementById('lowStockChart').getContext('2d');
    const productNames = <?php echo json_encode($productNames); ?>;
    const productQuantities = <?php echo json_encode($productQuantities); ?>;

    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: productNames,
            datasets: [{
                label: 'Stock Quantity',
                data: productQuantities,
                backgroundColor: '#8A4D32',
                borderColor: 'rgb(68, 62, 63)',
                borderWidth: 1,
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    font: {
                        size: 20
                    },
                    color: '#ed8f02'
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Product Names',
                        font: {
                            size: 14
                        },
                        color: '#c9741e'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Stock Quantity',
                        font: {
                            size: 14
                        },
                        color: '#c9741e'
                    },
                    beginAtZero: true
                }
            }
        }
    });
</script>

</body>
</html>
