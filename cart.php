<?php
// Start the session to access the cart
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pwc";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// // Check if the cart is empty
// if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
//     echo "<p>Your cart is empty. <a href='prod.php'>Continue Shopping</a></p>";
//     exit;
// }


// Check if the cart is empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
  echo "<p class='empty-cart'>Your cart is empty. <a href='prod.php'>Continue Shopping</a></p>";
  echo "<style>

   
      .empty-cart {
          text-align: center;
          font-size: 30px;
          font-weight: bold;
          color:rgb(84, 58, 20);
          margin-top: 50px;
          padding: 20px;
          border: 2px solidrgb(240, 187, 120);
          border-radius: 10px;
          display: inline-block;
          background-color:rgb(240, 187, 120);
          box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
      }
      .empty-cart a {
          color: rgb(19, 16, 16);
          text-decoration: none;
          font-weight: bold;
      }
      .empty-cart a:hover {
          text-decoration: underline;
      }
      body {
          display: flex;
          justify-content: center;
          align-items: center;
          height: 100vh;
          background-color:rgb(255, 240, 220);
      }
  </style>";
  exit;
}





// Ensure all products have a default quantity set
foreach ($_SESSION['cart'] as $product_id => &$product) {
    if (!isset($product['quantity'])) {
        $product['quantity'] = 1; // Default quantity
    }
}
unset($product); // Avoid reference issues

// Calculate total price of all items in the cart
$total_price = 0;
foreach ($_SESSION['cart'] as $product_id => $product) {
    $total_price += $product['price'] * $product['quantity'];
}

// Handle quantity updates
if (isset($_POST['update_quantity'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // If quantity is greater than 0, update it in the cart
    if ($quantity > 0) {
        $_SESSION['cart'][$product_id]['quantity'] = $quantity;
    }
    header('Location: cart.php');
    exit;
}

// Handle product removal
if (isset($_POST['remove_product'])) {
    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);
    header('Location: cart.php');
    exit;
}

// Handle order placement
if (isset($_POST['place_order'])) {
  // Get the logged-in user's ID from the session
  if (!isset($_SESSION['user_id'])) {
    // Redirect to login if the user is not logged in
    header('Location: dog_login.php');
    exit;
}
$user_id = $_SESSION['user_id']; // Dynamically fetch the logged-in user's ID
$order_date = date('Y-m-d H:i:s');
$order_id = uniqid();
    foreach ($_SESSION['cart'] as $product_id => $product) {
        $subtotal = $product['price'] * $product['quantity'];

        $stmt = $conn->prepare("INSERT INTO orders (user_id, product_id, product_name, price, quantity, subtotal, order_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iisdiis", $user_id, $product_id, $product['name'], $product['price'], $product['quantity'], $subtotal, $order_date);
        $stmt->execute();

        $stmt = $conn->prepare("UPDATE product SET quantity = quantity - ? WHERE id = ?");
        $stmt->bind_param("ii", $product['quantity'], $product_id);
        $stmt->execute();
    }

    // Clear the cart after placing the order
    unset($_SESSION['cart']);  

    // Redirect to the order confirmation page
    header("Location: place_order.php?order_id=" . $_SESSION['order_id']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Cart</title>
  <link rel="stylesheet" href="carts.css">  
</head>
<body>
  <header>
    <?php
    // Include the navbar
    include("nav.php");
    ?>
  </header>
  
  <h1>Your Cart</h1>
  
  <main>
    <section id="cart-items">
      <ul>
        <?php foreach ($_SESSION['cart'] as $product_id => $product): ?>
          <li>
            <!-- Check if photo exists, if not, use a placeholder image -->
            <img src="<?php echo isset($product['photo']) ? htmlspecialchars($product['photo']) : 'images/placeholder.jpg'; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" width="100">
            <span><?php echo htmlspecialchars($product['name']); ?></span>
            <span>₹<?php echo number_format($product['price'], 2); ?></span>
            
            <div>
            <!-- Quantity input and update form -->
            <form action="cart.php" method="post" style="display:inline;">
                <input type="number" name="quantity" value="<?php echo $product['quantity']; ?>" min="1">
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                <button type="submit" name="update_quantity" class="cart-buttons update">Update Quantity</button>
            </form>

            <!-- Remove product from cart -->
            <form action="cart.php" method="post" style="display:inline;">
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                <button type="submit" name="remove_product" class="cart-buttons remove">Remove</button>
            </form>
            </div>
            <span>Total: ₹<?php echo number_format($product['price'] * $product['quantity'], 2); ?></span>
          </li>
        <?php endforeach; ?>
      </ul>

      <h3>Total Price: ₹<?php echo number_format($total_price, 2); ?></h3>

      <!-- Place Your Order button -->
      <form action="cart.php" method="post" style="margin-top: 20px;">
        <button type="submit" name="place_order" class="cart-buttons">Place Your Order</button>
      </form>
    </section>
  </main>

   
</body>
</html>

<?php
$conn->close();
?>
