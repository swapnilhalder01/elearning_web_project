<?php
session_start();

// Include database connection
include 'db_connection.php'; // Adjust the path if needed

// Initialize variables
$success = false;
$error = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $course_title = isset($_POST['course_title']) ? htmlspecialchars(trim($_POST['course_title'])) : '';
    $description = isset($_POST['description']) ? htmlspecialchars(trim($_POST['description'])) : '';
    $youtube_link = isset($_POST['youtube_link']) ? htmlspecialchars(trim($_POST['youtube_link'])) : '';
    $pdf_file = '';

    // Check if fields are not empty
    if ($course_title && $description) {
        // Handle PDF upload
        if (isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] == UPLOAD_ERR_OK) {
            $upload_dir = 'uploads/'; // Directory to store uploaded files
            $pdf_filename = basename($_FILES['pdf_file']['name']);
            $upload_path = $upload_dir . $pdf_filename;

            if (move_uploaded_file($_FILES['pdf_file']['tmp_name'], $upload_path)) {
                $pdf_file = $pdf_filename;
            } else {
                $error = 'Failed to upload PDF file.';
            }
        }

        // Prepare and execute the SQL statement
        $sql = "INSERT INTO courses (title, description, youtube_link, pdf_file) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'ssss', $course_title, $description, $youtube_link, $pdf_file);

            if (mysqli_stmt_execute($stmt)) {
                $success = true;
            } else {
                $error = 'There was a problem adding the course: ' . mysqli_stmt_error($stmt);
            }

            mysqli_stmt_close($stmt);
        } else {
            $error = 'Failed to prepare SQL statement: ' . mysqli_error($conn);
        }
    } else {
        $error = 'Please fill in all fields.';
    }
}

mysqli_close($conn); // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
    <style>
       
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
            max-width: 1000px;
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

.container1 {
    max-width: 800px;
    margin: 50px auto;
    padding: 20px;
    background-color: #2c2c2c;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
    text-align: center;
}

h1 {
    color: #4CAF50; /* Green color for the heading */
    margin-bottom: 20px;
    font-size: 32px;
}

form {
    text-align: left;
    max-width: 800px;
    margin: 0 auto;
}

label {
    display: block;
    margin: 10px 0 5px;
    font-size: 16px;
    color: #eaeaea;
}

input[type="text"],
textarea {
    width: 100%;
    padding: 12px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    margin-bottom: 20px;
    background-color: #333; /* Dark background for input fields */
    color: #eaeaea; /* Light text color */
}

textarea {
    resize: vertical;
    min-height: 150px;
}

button {
    display: inline-block;
    padding: 12px 24px;
    font-size: 16px;
    color: #000;
    background-color: #fff; /* Green color matching the navbar */
    border: none;
    border-radius: 5px;
    text-align: center;
    text-decoration: none;
    transition: background-color 0.3s ease;
    cursor: pointer;
}

button:hover {
    background-color: #45a049; /* Slightly darker green on hover */
}

.success-message {
    color: #4CAF50; /* Green for success messages */
    margin-bottom: 20px;
}

.error-message {
    color: #f44336; /* Red for error messages */
    margin-bottom: 20px;
}

footer {
    text-align: center;
    padding: 20px;
    background-color: #1e1e1e;
    color: #a0a0a0;
    font-size: 14px;
    margin-top: 40px;
}

    </style>
   
</head>
<body>
    <header>
        <!-- Navigation bar -->
        <nav class="navbar">
            <div class="container">
                <div class="logo"><a href="admin_dashboard.php">Admin Dashboard</a></div>
                <ul class="nav-links">
                    <li><a href="courses_admin.php">Courses</a></li>
                    <li><a href="admin_dashboard.php">Admin Dashboard</a></li>
                    <li><a href="admin_logout.php" class="logout-btn">Logout</a></li> <!-- Logout Button -->
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <div class="container1">
            <h1>Add New Course</h1>

            <?php if ($success): ?>
                <p class="success-message">Course added successfully!</p>
            <?php elseif ($error): ?>
                <p class="error-message"><?php echo $error; ?></p>
            <?php endif; ?>

            <form action="add_course.php" method="POST" enctype="multipart/form-data" class="course-form">
                <label for="course_title">Course Title</label>
                <input type="text" id="course_title" name="course_title" required>

                <label for="description">Course Description</label>
                <textarea id="description" name="description" rows="5" required></textarea>

                <label for="youtube_link">YouTube Video Link</label>
                <input type="text" id="youtube_link" name="youtube_link" placeholder="Enter YouTube video link here">

                <label for="pdf_file">Upload Course PDF</label>
                <input type="file" id="pdf_file" name="pdf_file" accept=".pdf">

                <button type="submit">Add Course</button>
            </form>
        </div>
    </main>

    <footer>
        <!-- Footer content -->
        <p>&copy; 2024 E-Learning Platform. All rights reserved.</p>
    </footer>
</body>
</html>
