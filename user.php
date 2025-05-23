<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("User not logged in! Please login first.");
}

// Fetch user details from session
$fullname = $_SESSION['fullname'] ?? "Guest";
$email = $_SESSION['email'] ?? "Not available";
$phone = $_SESSION['phone'] ?? "Not available";
$address = $_SESSION['address'] ?? "Not available";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Sidebar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f4;
        }
        
        /* Sidebar Styling */
        .sidebar {
            width: 250px;
            background: #2C3E50;
            color: #ECF0F1;
            padding: 20px;
            position: fixed;
            top: 50px;
            right: -270px; /* Initially hidden */
            transition: right 0.3s ease-in-out;
            box-shadow: -3px 0 8px rgba(0, 0, 0, 0.3);
            border-radius: 10px 0 0 10px;
            border: 2px solid #1ABC9C;
        }
        
        .sidebar h2 {
            text-align: center;
            margin-bottom: 15px;
            font-size: 18px;
            border-bottom: 1px solid #ECF0F1;
            padding-bottom: 10px;
        }

        .user-info {
            font-size: 14px;
            margin-bottom: 10px;
        }

        /* Small 'User' Badge */
        .user-badge {
            position: fixed;
            top: 60px;
            right: 10px;
            background: #1ABC9C;
            color: white;
            border: 2px solid #fff;
            padding: 10px 15px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 20px;
            transition: background 0.3s ease;
            display: flex;
            align-items: center;
            gap: 5px;
            box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.2);
        }

        .user-badge:hover {
            background: #16A085;
        }

        .user-badge i {
            font-size: 18px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h2>User Info</h2>
        <div class="user-info"><strong>Name:</strong> <?php echo htmlspecialchars($fullname); ?></div>
        <div class="user-info"><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></div>
        <div class="user-info"><strong>Phone:</strong> <?php echo htmlspecialchars($phone); ?></div>
        <div class="user-info"><strong>Address:</strong> <?php echo htmlspecialchars($address); ?></div>
    </div>

    <!-- Small 'User' Badge -->
    <div class="user-badge" id="userBadge">
        <i>👤</i> User
    </div>

    <script>
        const sidebar = document.getElementById("sidebar");
        const userBadge = document.getElementById("userBadge");

        userBadge.addEventListener("click", function () {
            if (sidebar.style.right === "0px") {
                sidebar.style.right = "-270px";
            } else {
                sidebar.style.right = "0px";
            }
        });
    </script>

</body>
</html>
