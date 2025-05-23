<?php
include 'database.php'; // Database connection

// Query to count products
$product_result = mysqli_query($conn, "SELECT COUNT(*) AS total_products FROM product");
$product_data = mysqli_fetch_assoc($product_result);

// Query to count orders
$order_result = mysqli_query($conn, "SELECT COUNT(*) AS total_orders FROM orders");
$order_data = mysqli_fetch_assoc($order_result);

$customer_result = mysqli_query($conn, "SELECT COUNT(*) AS total_customers FROM user");
$customer_data = mysqli_fetch_assoc($customer_result);

// Return JSON response
echo json_encode([
    'total_products' => $product_data['total_products'],
    'total_orders' => $order_data['total_orders'],
    'total_customers' => $customer_data['total_customers']
]);
?>
