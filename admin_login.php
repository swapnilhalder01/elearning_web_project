<?php
session_start();
include 'db_connection.php'; // Include database connection

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Simple login logic
    $sql = "SELECT * FROM admins WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $error = 'Invalid username or password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background: #4CAF50;
        }

        .navbar {
            background-color: #1c1c1c;
            padding: 15px 0;
            color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .navbar .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar .logo a {
            color: #fff;
            text-decoration: none;
            font-size: 26px;
            font-weight: bold;
        }

        .navbar .nav-links {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
        }

        .navbar .nav-links li {
            margin-left: 25px;
        }

        .navbar .nav-links a {
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            padding: 8px 15px;
            border-radius: 4px;
            transition: background 0.3s ease, color 0.3s ease;
        }

        .navbar .nav-links a:hover {
            background-color: #ff5722;
            color: #fff;
        }

        /* Login Form Styles */
        .login-container {
            max-width: 450px;
            margin: 80px auto;
            background: #2e2e2e;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        h1 {
            text-align: center;
            color: #fff;
            font-size: 32px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            color: #fff;
            font-size: 18px;
            margin-bottom: 8px;
            display: block;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            background-color: #333;
            color: #fff;
            margin-bottom: 12px;
            box-sizing: border-box;
        }

        input[type="text"]:focus, input[type="password"]:focus {
            outline: none;
            border: 2px solid #ff5722;
        }

        button {
            width: 100%;
            padding: 14px;
            background-color: #ff5722;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #e64a19;
        }

        .error-message {
            color: #f44336;
            text-align: center;
            margin-bottom: 20px;
        }

        .footer {
            background-color: #1c1c1c;
            padding: 10px 0;
            text-align: center;
            color: #fff;
        }

        @media (max-width: 768px) {
            .login-container {
                padding: 20px;
                width: 80%;
            }

            h1 {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="container">
            <div class="logo">
                <a href="index.php">E-Learning</a>
            </div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="courses_viewer.php">Courses</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
                <li><a href="admin_login.php">Admin</a></li>
            </ul>
        </div>
    </nav>
    <!-- Login Form -->
    <div class="login-container">
        <h1>Admin Login</h1>

        <?php if ($error): ?>
            <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form method="POST" action="admin_login.php">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">Login</button>
        </form>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 E-Learning. All rights reserved.</p>
    </footer>
</body>
</html>
