<?php
session_start();

// Enable error reporting for mysqli
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pwc";

try {
    $conn = new mysqli($servername, $username, $password, $dbname);
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Validate and fetch user_id (assumed to be passed via session or GET request)
$user_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : (isset($_GET['user_id']) ? intval($_GET['user_id']) : 0);

if ($user_id <= 0) {
    die("Invalid user ID.");
}

// Fetch all orders for this user
$stmt = $conn->prepare("SELECT order_id, product_name, price, quantity, (price * quantity) AS total FROM orders WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$order_details = $result->fetch_all(MYSQLI_ASSOC);

if (empty($order_details)) {
    die("No orders found for this user.");
}

// Calculate total price
$total_price = array_sum(array_column($order_details, 'total'));

// Set image dimensions dynamically
$image_width = 700;
$image_height = 150 + (count($order_details) * 40); // Adjust height based on number of items
$image = imagecreatetruecolor($image_width, $image_height);

// Define colors
$white = imagecolorallocate($image, 255, 255, 255);
$black = imagecolorallocate($image, 0, 0, 0);
$gray = imagecolorallocate($image, 200, 200, 200);
$blue = imagecolorallocate($image, 0, 0, 255);

// Fill the background
imagefill($image, 0, 0, $white);

// Font settings
$font = 5;
$text_x = 20;
$text_y = 20;

// Bill Header (Centered)
$header_text = "Invoice - User #$user_id";
imagestring($image, $font + 2, ($image_width - (strlen($header_text) * 9)) / 2, $text_y, $header_text, $blue);
$text_y += 30;

// Column headers
imagestring($image, $font, $text_x, $text_y, "Product Name", $black);
imagestring($image, $font, $text_x + 250, $text_y, "Price (₹)", $black);
imagestring($image, $font, $text_x + 350, $text_y, "Quantity", $black);
imagestring($image, $font, $text_x + 450, $text_y, "Total (₹)", $black);
$text_y += 15;

// Separator line
imageline($image, 10, $text_y, $image_width - 10, $text_y, $gray);
$text_y += 10;

// Product details
foreach ($order_details as $order) {
    imagestring($image, $font, $text_x, $text_y, $order['product_name'], $black);
    imagestring($image, $font, $text_x + 250, $text_y, "₹" . number_format($order['price'], 2), $black);
    imagestring($image, $font, $text_x + 350, $text_y, $order['quantity'], $black);
    imagestring($image, $font, $text_x + 450, $text_y, "₹" . number_format($order['total'], 2), $black);
    $text_y += 25;
}

// Separator before total
$text_y += 5;
imageline($image, 10, $text_y, $image_width - 10, $text_y, $gray);
$text_y += 10;

// Total price
imagestring($image, $font + 1, $text_x, $text_y, "Grand Total:", $black);
imagestring($image, $font + 1, $text_x + 450, $text_y, "₹" . number_format($total_price, 2), $black);

// Output image to browser
header('Content-Type: image/png');
header('Content-Disposition: attachment; filename="Bill_User_' . $user_id . '.png"');
imagepng($image);

// Free resources
imagedestroy($image);
$conn->close();
?>
