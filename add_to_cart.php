<?php
session_start(); // Start the session

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get product data from the POST request
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_photo = $_POST['product_photo'];

    // Check if the cart session exists
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array(); // Initialize cart if it doesn't exist
    }

    // Add the product to the cart (can modify to prevent duplicates, if necessary)
    $product = array(
        'id' => $product_id,
        'name' => $product_name,
        'price' => $product_price,
        'photo' => $product_photo,
        'quantity' => 1 // Default quantity to 1
    );

    $_SESSION['cart'][] = $product; // Add product to cart

    // Optionally redirect to cart page after adding
    header("Location: cart.php"); // Modify with your actual cart page URL
    exit();
}
?>
