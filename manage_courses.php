<?php
// Include database connection
include 'db_connection.php'; // Adjust path if needed

// Delete course if delete request is made
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $sql = "DELETE FROM courses WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);

    if (mysqli_stmt_execute($stmt)) {
        $message = 'Course deleted successfully!';
    } else {
        $message = 'Failed to delete the course. Please try again.';
    }

    mysqli_stmt_close($stmt);
}

// Fetch courses from the database
$sql = "SELECT * FROM courses";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Courses</title>
    
   
    <style>
        body {
    font-family: 'Arial', sans-serif;
    background-color: #4CAF50; 
    color: #4CAF50; /* Light text color for readability */
    margin: 0;
    padding: 0;
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
    max-width: 1200px;
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

.message {
    color: #4CAF50; /* Green color for success messages */
    font-size: 16px;
    margin-bottom: 20px;
}

.courses-table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
}

.courses-table th,
.courses-table td {
    padding: 12px;
    border: 1px solid #444;
}

.courses-table th {
    background-color: #333;
    color: #eaeaea;
    font-size: 18px;
}

.courses-table td {
    background-color: #2c2c2c;
    color: #eaeaea;
    font-size: 16px;
}

.courses-table tr:nth-child(even) {
    background-color: #333;
}

.courses-table tr:hover {
    background-color: #444;
}

.btn {
    display: inline-block;
    padding: 8px 16px;
    font-size: 16px;
    color: #fff;
    background-color: #4CAF50; /* Green color matching the navbar */
    border: none;
    border-radius: 5px;
    text-align: center;
    text-decoration: none;
    transition: background-color 0.3s ease;
    cursor: pointer;
    margin: auto;
}

.btn:hover {
    background-color: #45a049; /* Slightly darker green on hover */
}

.delete-btn {
    background-color: #f44336; /* Red color for delete buttons */
}

.delete-btn:hover {
    background-color: #e57373; /* Lighter red on hover */
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
                    <li><a href="admin_dashboard.php">Admin Dashboard</a></li>
                    <li><a href="add_course.php">Add Course</a></li>
                    <li><a href="manage_courses.php">Manage Courses</a></li>
                    <li><a href="admin_logout.php" class="logout-btn">Logout</a></li> <!-- Logout Button -->
                    <!-- Add other admin links here -->
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <div class="container1">
            <h1>Manage Courses</h1>

            <?php if (isset($message)): ?>
                <p class="message"><?php echo $message; ?></p>
            <?php endif; ?>

            <table class="courses-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo htmlspecialchars($row['title']); ?></td>
                                <td><?php echo htmlspecialchars(substr($row['description'], 0, 100)); ?>...</td>
                                <td>
                                    <a href="edit_course.php?id=<?php echo $row['id']; ?>" class="btn">Edit</a>
                                    <a href="manage_courses.php?delete=<?php echo $row['id']; ?>" class="btn delete-btn" onclick="return confirm('Are you sure you want to delete this course?')">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">No courses found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

    <footer>
        <!-- Footer content -->
        <p>&copy; 2024 E-Learning Platform. All rights reserved.</p>
    </footer>

    <script>
        // Optional: JavaScript for confirmation on delete action
        document.querySelectorAll('.delete-btn').forEach(function(button) {
            button.addEventListener('click', function(event) {
                if (!confirm('Are you sure you want to delete this course?')) {
                    event.preventDefault();
                }
            });
        });
    </script>
</body>
</html>

<?php
mysqli_close($conn); // Close the database connection
?>
