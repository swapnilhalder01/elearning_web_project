<?php
// Include database connection
include 'db_connection.php'; // Adjust the path if needed

// Initialize variables
$success = false;
$error = '';
$course_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$existing_pdf_file = '';

// Fetch course details if a valid ID is provided
if ($course_id) {
    $query = "SELECT * FROM courses WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'i', $course_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $course = mysqli_fetch_assoc($result);
        $existing_pdf_file = $course['pdf_file'];
        mysqli_stmt_close($stmt);
    } else {
        $error = 'Failed to prepare SQL statement: ' . mysqli_error($conn);
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && $course_id) {
    // Sanitize and validate input
    $course_title = isset($_POST['course_title']) ? htmlspecialchars(trim($_POST['course_title'])) : '';
    $description = isset($_POST['description']) ? htmlspecialchars(trim($_POST['description'])) : '';
    $youtube_link = isset($_POST['youtube_link']) ? htmlspecialchars(trim($_POST['youtube_link'])) : '';
    $pdf_file = $existing_pdf_file;

    // Check if fields are not empty
    if ($course_title && $description && $youtube_link) {
        // Handle PDF file upload
        if (isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] == UPLOAD_ERR_OK) {
            $file_tmp_path = $_FILES['pdf_file']['tmp_name'];
            $file_name = $_FILES['pdf_file']['name'];
            $file_size = $_FILES['pdf_file']['size'];
            $file_type = $_FILES['pdf_file']['type'];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

            $allowed_ext = array('pdf');
            if (in_array($file_ext, $allowed_ext)) {
                $upload_dir = 'uploads/';
                $new_file_name = $course_id . '_' . time() . '.' . $file_ext;
                $dest_path = $upload_dir . $new_file_name;

                if (move_uploaded_file($file_tmp_path, $dest_path)) {
                    $pdf_file = $new_file_name;

                    // Delete the old PDF file if a new one is uploaded
                    if ($existing_pdf_file && file_exists($upload_dir . $existing_pdf_file)) {
                        unlink($upload_dir . $existing_pdf_file);
                    }
                } else {
                    $error = 'There was an error uploading the PDF file.';
                }
            } else {
                $error = 'Invalid file type. Only PDF files are allowed.';
            }
        }

        // Prepare and execute the SQL statement
        if (!$error) {
            $sql = "UPDATE courses SET title = ?, description = ?, youtube_link = ?, pdf_file = ? WHERE id = ?";
            $stmt = mysqli_prepare($conn, $sql);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, 'ssssi', $course_title, $description, $youtube_link, $pdf_file, $course_id);

                if (mysqli_stmt_execute($stmt)) {
                    $success = true;
                    header('Location: courses_admin.php');
                    exit();
                } else {
                    $error = 'There was a problem updating the course: ' . mysqli_stmt_error($stmt);
                }

                mysqli_stmt_close($stmt);
            } else {
                $error = 'Failed to prepare SQL statement: ' . mysqli_error($conn);
            }
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
    <title>Edit Course</title>
    <style>
        body {
    font-family: 'Roboto', sans-serif;
    background-color: #f4f4f4;
    color: #333;
    margin: 0;
    padding: 0;
    line-height: 1.6;
}

.container {
    width: 80%;
    margin: auto;
    overflow: hidden;
}

        
/* Navigation Bar */
.navbar {
    background: #333;
    color: #fff;
    padding: 10px 0;
}

.navbar .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.navbar .logo a {
    color: #fff;
    text-decoration: none;
    font-size: 24px;
    font-weight: bold;
}

.navbar .nav-links {
    list-style: none;
    margin: 0;
    padding: 0;
}

.navbar .nav-links li {
    display: inline;
    margin-left: 15px;
}

.navbar .nav-links a {
    color: #fff;
    text-decoration: none;
    font-weight: bold;
}

.navbar .nav-links a:hover {
    color: #ddd;
    text-decoration: underline;
}



    </style>
</head>
<body style="font-family: Arial, sans-serif;">

   
    <nav class="navbar">
        <div class="container">
            <div> <h1>Edit Course</h1></div>
            <ul class="nav-links">
            <li><a href="courses_admin.php">Courses</a></li>
                <li><a href="add_course.php">Add Course</a></li>
                <li><a href="manage_courses.php">Manage Courses</a></li>
                <li><a href="admin_logout.php" class="logout-btn">Logout</a></li> <!-- Logout Button -->
            </ul>
        </div>
    </nav>

    <main style="padding: 20px;">
        <div style="max-width: 600px; margin: 0 auto;">
            <?php if ($success): ?>
                <p style="color: green; font-weight: bold;">Course updated successfully!</p>
            <?php elseif ($error): ?>
                <p style="color: red; font-weight: bold;"><?php echo $error; ?></p>
            <?php endif; ?>

            <form action="edit_course.php?id=<?php echo $course_id; ?>" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 15px;">
                <label for="course_title" style="font-weight: bold;">Course Title</label>
                <input type="text" id="course_title" name="course_title" value="<?php echo htmlspecialchars($course['title']); ?>" required style="padding: 10px; border: 1px solid #ccc; border-radius: 4px;">

                <label for="description" style="font-weight: bold;">Course Description</label>
                <textarea id="description" name="description" rows="5" required style="padding: 10px; border: 1px solid #ccc; border-radius: 4px;"><?php echo htmlspecialchars($course['description']); ?></textarea>

                <label for="youtube_link" style="font-weight: bold;">YouTube Video Link</label>
                <input type="text" id="youtube_link" name="youtube_link" value="<?php echo htmlspecialchars($course['youtube_link']); ?>" required style="padding: 10px; border: 1px solid #ccc; border-radius: 4px;">

                <label for="pdf_file" style="font-weight: bold;">Course PDF File</label>
                <input type="file" id="pdf_file" name="pdf_file" accept=".pdf" style="padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                
                <?php if ($existing_pdf_file): ?>
                    <p>Current PDF: <a href="uploads/<?php echo htmlspecialchars($existing_pdf_file); ?>" target="_blank"><?php echo htmlspecialchars($existing_pdf_file); ?></a></p>
                <?php endif; ?>

                <button type="submit" style="padding: 10px 15px; background-color: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">Update Course</button>
            </form>
        </div>
    </main>

    <footer style="background-color: #333; color: #fff; text-align: center; padding: 10px;">
        <p style="margin: 0;">&copy; 2024 E-Learning Platform. All rights reserved.</p>
    </footer>

</body>
</html>
