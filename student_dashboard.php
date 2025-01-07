<?php
// Include database connection
include 'db_connection.php'; // Adjust path if needed

// Initialize variables
$student_id = 1; // Replace with dynamic session or user-specific ID

// Fetch enrolled courses for the student
$sql = "SELECT courses.id, courses.title, courses.description
        FROM enrollments
        JOIN courses ON enrollments.course_id = courses.id
        WHERE enrollments.student_id = ?";

$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, 'i', $student_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
} else {
    die("Failed to prepare SQL statement: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Ensure this path is correct -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #4CAF50;
            color: #eaeaea;
            margin: 0;
            padding: 0;
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


        .container1 {
            max-width: 1000px;
            margin: 50px auto;
            padding: 20px;
            background-color: #2c2c2c;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            text-align: center;
        }

        h1 {
            color: #4CAF50;
            margin-bottom: 20px;
            font-size: 32px;
        }

        p {
            color: #a0a0a0;
            font-size: 18px;
            margin-bottom: 40px;
        }
         .btn-group {
            display: flex;
            justify-content: center;
            gap: 20px;
            
        }

         .btn {
            display: inline-block;
            background-color: #fff;
            color: #000;
            padding: 12px 30px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            text-decoration: None;
            transition: background 0.3s ease, transform 0.3s ease;
        }

         .btn:hover {
            background-color: #388e3c;
            transform: translateY(-3px);
        }


        footer {
            text-align: center;
            padding: 20px;
            background-color: #1e1e1e;
            color: #a0a0a0;
            font-size: 14px;
            margin-top: 220px;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="container">
                <div class="logo"><a href="student_dashboard.php">Student Dashboard</a></div>
                <ul class="nav-links">
                    <li><a href="courses.php">My Courses</a></li>
                    <li><a href="student_logout.php" class="logout-btn">Logout</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <div class="container1">
            <h1>Student Dashboard</h1>
            
                <p>Here You Can Learn Everything You Want.</p>
                <div class="btn-group">
                <a href="courses.php" class="btn">My Courses</a>
                <a href="student_logout.php" class="btn">Logout</a>
               
            </div>
            
        </div>
    </main>

    <footer>
        <p>&copy; 2024 E-Learning Platform. All rights reserved.</p>
    </footer>
</body>
</html>
