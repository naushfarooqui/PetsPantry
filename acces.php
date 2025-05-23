<?php
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

// Handle Add to Cart form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_photo = $_POST['product_photo']; // Retrieve the photo URL

    // Ensure the cart is initialized
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Add or update the product in the cart
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] += 1;
    } else {
        $_SESSION['cart'][$product_id] = [
            'name' => $product_name,
            'price' => $product_price,
            'photo' => $product_photo, // Add the photo URL
            'quantity' => 1,
        ];
    }

    // Set a success message for cart addition
    $_SESSION['message'] = "Product added to cart successfully!";
    // Redirect to the cart page
    header("Location: cart.php");
    exit;
}

// Fetch products in the "Cat Food" category
$category = 'accessory';
$sql = "SELECT * FROM product WHERE category = '$category'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Accesories</title>
    <link rel="stylesheet" href="food.css">
    <style>
        .out-of-stock {
            color: red;
            font-weight: bold;
        }
    </style>

</head>
<body>

<?php include("nav.php"); ?>
<br><br>
 

<h1>Our Accessories</h1>

<?php
// Display success or error message
if (isset($_SESSION['message'])) {
    echo '<div class="message">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']);
}
?>

<div class="product-container">
<?php if ($result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="product">
            <img src="<?php echo htmlspecialchars($row['photo']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
            <div class="product-info">
                <h2><?php echo htmlspecialchars($row['name']); ?></h2>
                <p><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
                <p class="price">Price: ₹<?php echo htmlspecialchars($row['price']); ?></p>

                <?php if ($row['quantity'] > 0): ?>
                <form action="cat_page.php" method="POST" onsubmit="return checkLogin();">
                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                    <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($row['name']); ?>">
                    <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($row['price']); ?>">
                    <input type="hidden" name="product_photo" value="<?php echo htmlspecialchars($row['photo']); ?>"> <!-- Include product image URL -->
                    <button type="submit" class="add-to-cart-btn">Add to Cart</button>
                </form>
                <?php else: ?>
                    <p class="out-of-stock">Out of Stock</p>
                <?php endif; ?>
            </div>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p>No products found in the Accessory category.</p>
<?php endif; ?>
</div>

<script>
function checkLogin() {
    let isLoggedIn = <?php echo isset($_SESSION['user_id']) || isset($_COOKIE['user_logged_in']) ? 'true' : 'false'; ?>;
    if (!isLoggedIn) {
        alert("Please log in or sign up to add items to your cart.");
        window.location.href = "signup.php";
        return false;
    }
    return true;
}
</script>

<?php include("footer.php"); ?>
</body>
</html>
<?php
$conn->close();
?>
