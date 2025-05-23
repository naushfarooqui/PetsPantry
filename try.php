<?php include("database.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Food Shop - Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
        }
        .sidebar {
            width: 250px;
            background-color: #f0bb78;
            color: #543a14;
            height: 100vh;
            position: fixed;
            display: flex;
            flex-direction: column;
        }
        .sidebar h2 {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #fff0dc;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .sidebar ul li {
            padding: 15px;
            border-bottom: 1px solid #fff0dc;
        }
        .sidebar ul li a {
            color: #543a14;
            text-decoration: none;
            display: flex;
            align-items: center;
        }
        .sidebar ul li a:hover {
            border-radius: 6px;
            background-color:rgb(244, 221, 191);
        }
        .sidebar ul li a i {
            margin-right: 10px;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #ecf0f1;
            border-bottom: 1px solid #bdc3c7;
        }
        .header .search-bar {
            width: 300px;
        }
        .header .search-bar input {
            width: 100%;
            padding: 8px;
        }
        .header .user-profile {
            display: flex;
            align-items: center;
        }
        .header .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .dashboard-content {
            margin-top: 20px;
        }
        .dashboard-content .card {
            background-color:rgb(240, 188, 136);
            padding: 20px;
            margin: 10px 0;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .dashboard-content .card h3 {
            margin: 0 0 10px 0;
        }
        .dashboard-content .card table {
            width: 100%;
            border-collapse: collapse;
        }
        .dashboard-content .card table th, .dashboard-content .card table td {
            border: 1px solid rgb(2, 43, 70);
            padding: 10px;
            text-align: left;
        }
        .dashboard-content .card table th {
            background-color:rgb(226, 197, 207);
        }
        .feedback-list {
            margin-top: 20px;
        }
        .feedback-item {
            background-color:rgb(244, 203, 121);
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(240, 89, 89, 0.1);
        }
        .feedback-item h4 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }
        .feedback-item h4 span {
            font-size: 14px;
            color: #777;
        }
        .feedback-item p {
            margin-top: 10px;
            font-size: 16px;
            color: #333;
        }
        .feedback-item:hover {
            background-color: #f1f1f1;
            cursor: pointer;
        }
        .card h3 {
            color: #7f5539; /* Choose your desired color */
        }

        #topSellingChart {
            width: 50% !important;
            height: 350px !important;
            margin: 0 auto;
            display: block;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Admin Panel</h2>
    <ul>
        <li><a href="admin_dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
        <li><a href="order_details.php"><i class="fas fa-shopping-cart"></i> Orders</a></li>
        <li><a href="customer_list.php"><i class="fas fa-users"></i> Customers</a></li>
        <li><a href="sales_report.php"><i class="fas fa-chart-line"></i> Sales Report</a></li>
        <li><a href="admin_add_product.php"><i class="fas fa-box"></i> Add Food</a></li>
        <li><a href="user_feedback.php"><i class="fas fa-solid fa-comment"></i> User Feedbacks</a></li>

        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
</div>

<div class="main-content">
    <div class="header">
        <div class="search-bar">
            <form method="GET" action="">
                <input type="text" name="search_query" placeholder="Search by Product ID or Name..." value="<?php echo isset($_GET['search_query']) ? $_GET['search_query'] : ''; ?>">
                <button type="submit">Search</button>
            </form>
        </div>
        <div class="user-profile">
            <img src="admin.png" alt="Admin Profile">
            <span>adminadmin</span>
        </div>
    </div>

    <?php 
    // Search functionality
    $searchResults = [];
    if (isset($_GET['search_query'])) {
        $searchQuery = $_GET['search_query'];
        $sql = "SELECT id, name FROM product WHERE id LIKE ? OR name LIKE ?";
        $stmt = $conn->prepare($sql);
        $searchTerm = "%" . $searchQuery . "%";
        $stmt->bind_param("ss", $searchTerm, $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $searchResults[] = $row;
        }
        $stmt->close();
    }
    ?>

    <!-- Search Results -->
    <?php if (isset($_GET['search_query'])): ?>
        <div class="dashboard-content">
            <div class="card">
                <h3>Search Results</h3>
                <?php if (!empty($searchResults)): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Product Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($searchResults as $product): ?>
                            <tr>
                                <td><?php echo $product['id']; ?></td>
                                <td><?php echo $product['name']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No products found matching your search query.</p>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="dashboard-content">
        <div class="card">
            <h3>Overview</h3>
            <p>Total Products: <span id="product-count">
                <?php
                $product_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM product"));
                echo $product_count['total'];
                ?>
            </span></p>
            
            <p>Total Orders: <span id="order-count">
                <?php
                $order_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM orders"));
                echo $order_count['total'];
                ?>
            </span></p>
            <p>Total Customers: <span id="customer-count">
                <?php
                $customer_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM user"));
                echo $customer_count['total'];
                ?>
            </span></p>
        </div>
    </div>

    <div class="card">
        <h3>Top Selling Product Categories</h3>
        <canvas id="topSellingChart"></canvas>
        <?php
        $sql = "SELECT p.category, SUM(oi.quantity) AS total_sales
                FROM orders oi
                JOIN product p ON oi.product_id = p.id
                GROUP BY p.category
                ORDER BY total_sales DESC";
        $result = mysqli_query($conn, $sql);

        $categories = [];
        $sales = [];
        
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $categories[] = $row['category'];
                $sales[] = $row['total_sales'];
            }
        }
        ?>
        <script>
            const categories = <?php echo json_encode($categories); ?>;
            const sales = <?php echo json_encode($sales); ?>;

            var ctx = document.getElementById('topSellingChart').getContext('2d');
            var devicePixelRatio = window.devicePixelRatio || 1;
            var width = 500;
            var height = 300;

            document.getElementById('topSellingChart').width = width * devicePixelRatio;
            document.getElementById('topSellingChart').height = height * devicePixelRatio;
            ctx.scale(devicePixelRatio, devicePixelRatio);

            var topSellingChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: categories,
                    datasets: [{
                        label: 'Top Selling Categories',
                        data: sales,
                        backgroundColor: [
                            '#FF6347', '#4CAF50', '#FF9800', '#3F51B5', '#009688', '#E91E63', '#8E44AD'
                        ],
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.label + ': ' + tooltipItem.raw + ' items';
                                }
                            }
                        }
                    }
                }
            });
        </script>
    </div>

    <!-- User Feedback Section -->
    <div class="card">
        <h3>User Feedback</h3>
        <div class="feedback-list">
            <?php
            // Fetch feedback data from the database
            $sql_feedback = "SELECT fullname, email, opinion FROM feedback ORDER BY created_at DESC LIMIT 3";

            $feedback_result = mysqli_query($conn, $sql_feedback);

            if ($feedback_result && mysqli_num_rows($feedback_result) > 0) {
                while ($row = mysqli_fetch_assoc($feedback_result)) {
                    echo "<div class='feedback-item'>";
                    echo "<h4>" . $row['fullname'] . " <span>(" . $row['email'] . ")</span></h4>";
                    echo "<p>" . $row['opinion'] . "</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>No feedback available yet.</p>";
            }
            ?>
        </div>
    </div>
</div>

</body>
</html>
