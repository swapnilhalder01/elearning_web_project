<?php
session_start();
// Redirect to login if not logged in as admin
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* General Styles */
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #4CAF50;
            color: #eaeaea;
        }

        a {
            text-decoration: none;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Navbar Styles */
        .navbar {
            background-color: #000;
            padding: 15px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .navbar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar .logo a {
            font-size: 24px;
            font-weight: bold;
            color: #fff;
        }

        .navbar .nav-links {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .navbar .nav-links li {
            margin-left: 20px;
        }

        .navbar .nav-links li a {
            font-size: 16px;
            color: #fff;
            padding: 8px 15px;
            border-radius: 5px;
            transition: background 0.3s ease, color 0.3s ease;
        }

        .navbar .nav-links li a:hover {
            background-color: #1565c0;
        }

        .navbar .logout-btn {
            background-color: #e53935;
            padding: 8px 15px;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .navbar .logout-btn:hover {
            background-color: #c62828;
        }

        /* Dashboard Styles */
        .dashboard {
            text-align: center;
            padding: 50px 20px;
            background-color: #1e1e1e;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            margin-top: 40px;
        }

        .dashboard h1 {
            font-size: 32px;
            color: #4caf50;
            margin-bottom: 20px;
        }

        .dashboard p {
            font-size: 18px;
            color: #b0bec5;
            margin-bottom: 30px;
        }

        .dashboard .btn-group {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .dashboard .btn {
            display: inline-block;
            background-color: #fff;
            color: #000;
            padding: 12px 30px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .dashboard .btn:hover {
            background-color: #388e3c;
            transform: translateY(-3px);
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 20px;
            margin-top: 110px;
            background-color: #000;
            color: #fff;
            font-size: 14px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar .container {
                flex-direction: column;
                align-items: flex-start;
            }

            .dashboard .btn-group {
                flex-direction: column;
                gap: 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <div class="logo"><a href="admin_dashboard.php">Admin Dashboard</a></div>
            <ul class="nav-links">
                <li><a href="courses_admin.php">Courses</a></li>
                <li><a href="add_course.php">Add Course</a></li>
                <li><a href="manage_courses.php">Manage Courses</a></li>
                <li><a href="admin_logout.php" class="logout-btn">Logout</a></li>
            </ul>
        </div>
    </nav>

    <!-- Dashboard -->
    <div class="container">
        <div class="dashboard">
            <h1>Welcome, Admin</h1>
            <p>Manage your courses, view platform  and more.</p>
            <div class="btn-group">
                <a href="add_course.php" class="btn">Add New Course</a>
                <a href="manage_courses.php" class="btn">Manage Courses</a>
               
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 E-Learning Platform. All rights reserved.</p>
    </footer>
</body>
</html>
