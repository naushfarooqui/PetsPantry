<?php
include("database.php");
session_start();

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // ✅ Admin Login Handling
    if ($email === 'admin@gmail.com' && $password === 'admin') {
        header("Location: try.php"); // Redirect to Admin Panel
        exit();
    }

    // ✅ Fetch user record securely
    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    $user = null;
    $login_success = false;

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $login_success = true;
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "No account found!";
    }

    // ✅ If Login is Successful
    if ($login_success) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['fullname'] = $user['fullname'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['phone'] = $user['phone'];
        $_SESSION['address'] = $user['address'];

        // ✅ Generate and update user token
        $token = bin2hex(random_bytes(16));
        $update_sql = "UPDATE user SET token = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("si", $token, $_SESSION['user_id']);
        $update_stmt->execute();

        $_SESSION['token'] = $token; // ✅ Store token in session

        // ✅ Redirect to Home Page
        header("Location: prod.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Heebo', sans-serif;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url('photo/dogloginbgggg.jpg') no-repeat center center/cover;
            color: #fff;
        }
        .login-container {
            background: rgb(245, 183, 102);
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            padding: 20px 30px;
            color: #333;
        }
        .login-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .login-header h1 {
            font-size: 24px;
            font-weight: 500;
        }
        .login-form {
            display: flex;
            flex-direction: column;
        }
        .login-form input {
            margin-bottom: 15px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            outline: none;
            transition: all 0.3s ease;
        }
        .login-form input:focus {
            border-color: rgb(84, 58, 20);
            box-shadow: 0 0 4px rgb(19, 16, 16);
        }
        .login-form button {
            background-color: rgb(86, 52, 8);
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .login-form button:hover {
            background-color: rgb(19, 16, 16);
        }
        .signup-link {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }
        .signup-link a {
            color: rgb(80, 49, 8);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .signup-link a:hover {
            color: rgb(19, 16, 16);
        }
    </style>
</head>
<body>
 


    <div class="login-container">
        <div class="login-header">
            <h1>Login</h1>
        </div>
        <form action="dog_login.php" method="post" class="login-form">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="submit">Sign In</button>
        </form>
        <div class="signup-link">
            <p>New here? <a href="signup.php">Create an account</a></p>
        </div>
    </div>
</body>
</html>
