<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
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
    <title>Navbar with User Info Sidebar</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="navv.css">
    <script src="nav.js"></script>
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
            background: rgb(240, 187, 120);
            color: #ECF0F1;
            padding: 20px;
            position: fixed;
            top: 50px;
            right: -270px; /* Initially hidden */
            transition: right 0.3s ease-in-out;
            box-shadow: -3px 0 8px rgba(0, 0, 0, 0.3);
            border-radius: 10px 0 0 10px;
            border: 2px solid rgb(246, 141, 4);
        
        }
        
        .sidebar h2 {
            text-align: center;
            margin-bottom: 15px;
            font-size: 18px;
            border-bottom: 1px solid #ECF0F1;
            padding-bottom: 10px;
            color: rgb(63, 41, 8)
        }

        .user-info {
            font-size: 14px;
            margin-bottom: 10px;
            color: rgb(84, 58, 20);
        }

        /* Small 'User' Badge */
        .user-badge {
            position: relative;
            top: 4px;
            right: 10px;
            background: rgb(240, 187, 120);
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

        /* rgb(240, 187, 120)
            rgb(84, 58, 20) */
        .user-badge:hover {
            background: rgb(243, 177, 90);
        }

        .user-badge i {
            font-size: 18px;
            margin-right: 5px; /* Adjust icon's position if needed */
        }
        .logout-link {
    text-decoration: none;
    font-size: 12px;
    color: white;
    background-color:rgb(189, 99, 93);
    padding: 10px 20px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
  }

  .logout-link:hover {
    background-color: #d32f2f;
  }

  .logout-link:active {
    background-color: #c62828;
  }
    </style>
</head>
<body>

    <!-- Navbar starts -->
    <div class="navbarnew">
        <div class="logonew">
            <img src="photo/logo.png" alt="Logo">
            <span>Pets Pantry</span>
        </div>

        <div class="nav-linksnew">
            
            <a href="home.php"><i class="fas fa-home"></i> Home</a>
            <a href="about.php"><i class="fas fa-info-circle"></i> About</a>
            <a href="review.php"><i class="fas fa-comments"></i> Review</a>
            <a href="prod.php"><i class="fas fa-box"></i> Products</a>
            <a href="acces.php"><i class="fas fa-cogs"></i> Accessories</a>
            

            <div class="dropdownnew">
                <a href="#shop"><i class="fas fa-shopping-cart"></i> Shop <i class="fas fa-chevron-down"></i></a>
                <div class="dropdown-menunew">
                    <a href="cat_page.php">Cat</a>
                    <a href="dog_page.php">Dog</a>
                    <a href="bird_page.php">Bird</a>
                    <a href="turtle_page.php">Turtle</a>
                    <a href="rabbit_page.php">Rabbit</a>
                    <a href="fish_page.php">Fish</a>
                </div>
            </div>
        </div>








        <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h2>User Info</h2>
        <div class="user-info"><strong>Name:</strong> <?php echo htmlspecialchars($fullname); ?></div>
        <div class="user-info"><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></div>
        <div class="user-info"><strong>Phone:</strong> <?php echo htmlspecialchars($phone); ?></div>
        <div class="user-info"><strong>Address:</strong> <?php echo htmlspecialchars($address); ?></div>
        <a href="logout.php" class="logout-link">Logout</a>
    </div>

    <!-- Small 'User' Badge -->
    <div class="user-badge" id="userBadge">
        <i>👤</i> User
    </div>




    </div>
    <!-- Navbar ends -->

    

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
