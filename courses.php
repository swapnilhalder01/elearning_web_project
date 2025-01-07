<?php
// Connect to the database
include 'db_connection.php'; // Ensure this file contains your database connection

// Fetch courses from the database
$sql = "SELECT * FROM courses"; // Adjust this query based on your table structure
$result = mysqli_query($conn, $sql);

// Check if there are courses
if (mysqli_num_rows($result) > 0) {
    $courses = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $courses = [];
}

mysqli_close($conn); // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Courses</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #4CAF50;
            color: #4CAF50;
        }

        /* Navbar Styles */
        .navbar {
            background-color: #1c1c1c;
            padding: 15px 0;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .navbar .container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo a {
            color: #fff;
            text-decoration: none;
            font-size: 26px;
            font-weight: bold;
        }

        .nav-links {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: flex-end;
        }

        .nav-links li {
            margin-left: 20px;
        }

        .nav-links a {
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            padding: 8px 15px;
            border-radius: 4px;
            transition: background 0.3s ease, color 0.3s ease;
        }

        .nav-links a:hover {
            background-color: #ff5722;
            color: #fff;
        }

        .logout-btn {
            background-color: #f44336;
        }

        .logout-btn:hover {
            background-color: #e57373;
        }

        /* Body padding to prevent navbar from overlapping content */
        body {
            padding-top: 80px;
        }

        .container1 {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #000;
            margin-bottom: 40px;
            font-size: 36px;
        }

        .course-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            padding: 0 10px;
        }

        .course-item {
            background: linear-gradient(135deg, #2c2c2c, #424242);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            padding: 20px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
            color: #fff;
        }

        .course-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5);
        }

        .course-item h2 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        .course-item p {
            font-size: 16px;
            color: #bdbdbd;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #4CAF50;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #45a049;
        }

        footer {
            text-align: center;
            padding: 20px;
            background: #1c1c1c;
            color: #ffffff;
            margin-top: 40px;
        }

        @media (max-width: 768px) {
            .course-item {
                padding: 15px;
            }
        }

        @media (max-width: 480px) {
            .course-item {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="container">
                <div class="logo">
                <a href="student_dashboard.php">Student Dashboard</a>
                </div>
                <ul class="nav-links">
                    <li><a href="student_dashboard.php">Student Dashboard</a></li>
                    <li><a href="student_logout.php" class="logout-btn">Logout</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <div class="container1">
            <h1>Available Courses</h1>
            <div class="course-list">
                <?php if (!empty($courses)): ?>
                    <?php foreach ($courses as $course): ?>
                        <div class="course-item">
                            <h2><?php echo htmlspecialchars($course['title']); ?></h2>
                            <p><?php echo htmlspecialchars($course['description']); ?></p>
                            <a href="course_detail.php?id=<?php echo $course['id']; ?>" class="btn">View Details</a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No courses available at the moment.</p>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 E-Learning Platform. All rights reserved.</p>
    </footer>
</body>
</html>
