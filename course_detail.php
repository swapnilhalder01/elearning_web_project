<?php
session_start();

// Database connection
include 'db_connection.php';

// Check if course ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid course ID.");
}

$course_id = intval($_GET['id']);

// Fetch course details
$query = "SELECT * FROM courses WHERE id='$course_id'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$course = mysqli_fetch_assoc($result);

// Handle case where course data is not found
if (!$course) {
    die("Course not found.");
}

// Function to extract YouTube video ID from URL
function getYouTubeVideoId($url) {
    $patterns = [
        '/youtu\.be\/([a-zA-Z0-9_-]+)/', // Short URL format
        '/youtube\.com\/(?:embed|v|watch\?v=)([a-zA-Z0-9_-]+)/' // Long URL formats
    ];
    foreach ($patterns as $pattern) {
        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }
    }
    return false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($course['title']); ?> - Course Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #4CAF50;
            color: #000;
            margin: 0;
            padding: 0;
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

        .course-header {
            background-color: #333;
            padding: 40px 20px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .course-header h1 {
            font-size: 36px;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        .course-header p {
            font-size: 18px;
            line-height: 1.6;
            color: #eaeaea;
        }

        .course-container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background-color: #2c2c2c;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }

        .course-description, .course-video, .course-pdf {
            margin-bottom: 40px;
            padding: 20px;
            background-color: #333;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
        }

        .course-description h2, .course-video h2, .course-pdf h2 {
            font-size: 28px;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        .course-description p, .course-video p, .course-pdf p {
            font-size: 16px;
            color: #ddd;
        }

        .course-video iframe {
            max-width: 100%;
            border: none;
            width: 100%;
            height: 500px;
        }

        .download-pdf {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .download-pdf:hover {
            background-color: #45a049;
        }

        footer {
            background-color: #1e1e1e;
            color: #a0a0a0;
            text-align: center;
            padding: 20px;
            margin-top: 40px;
        }

        footer p {
            margin: 0;
            font-size: 14px;
        }
    
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container">
        <div class="logo"><a href="student_dashboard.php">Student Dashboard</a></div>
            <ul class="nav-links">
                <li><a href="courses.php">My Courses</a></li>
                <?php if (isset($_SESSION['username'])): ?>
                    <?php if ($_SESSION['role'] === 'admin'): ?>
                        <li><a href="admin_dashboard.php">Admin Dashboard</a></li>
                    <?php else: ?>
                        <li><a href="student_dashboard.php">Student Dashboard</a></li>
                    <?php endif; ?>
                <?php endif; ?>
                <li><a href="student_logout.php" class="logout-btn">Logout</a></li>
            </ul>
        </div>
    </nav>

    <header class="course-header">
        <div class="container">
            <h1><?php echo htmlspecialchars($course['title']); ?></h1>
            
        </div>
    </header>

    <!-- Course Container -->
    <div class="course-container">

        <!-- Course Description -->
        <section class="course-description">
            <h2>Course Overview</h2>
            <p><?php echo htmlspecialchars($course['description']); ?></p>
        </section>

        <!-- Course Video -->
        <section class="course-video">
            <h2>Watch the Course Video</h2>
            <?php
            $youtube_url = htmlspecialchars($course['youtube_link']);
            $video_id = getYouTubeVideoId($youtube_url);

            if ($video_id) {
                echo '<iframe src="https://www.youtube.com/embed/' . $video_id . '" allowfullscreen></iframe>';
            } else {
                echo '<p>No video available or invalid YouTube URL format.</p>';
            }
            ?>
        </section>

        <!-- PDF Download Section -->
        <section class="course-pdf">
            <?php
            if (!empty($course['pdf_file'])) {
                echo '<a href="uploads/' . htmlspecialchars($course['pdf_file']) . '" class="download-pdf" download>Download Course PDF</a>';
            } else {
                echo '<p>No PDF file available for this course.</p>';
            }
            ?>
        </section>
    </div>

    <footer>
        <p>&copy; 2024 E-Learning Platform. All Rights Reserved.</p>
    </footer>
</body>
</html>
