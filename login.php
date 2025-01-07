<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* General Styles */
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #4CAF50; 
            color: #ffffff;
        }

        .navbar {
            background-color: #1c1c1c;
            padding: 15px 0;
            color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .navbar .logo a {
            color: #fff;
            text-decoration: none;
            font-size: 26px;
            font-weight: bold;
            padding-left: 20px;
        }

        .nav-links {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: flex-end;
            padding-right: 20px;
        }

        .nav-links li {
            margin-left: 25px;
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

        /* Login Form Styles */
        .form-container {
            max-width: 400px;
            margin: 80px auto;
            background: linear-gradient(135deg, #2c2c2c, #424242); /* Dark gradient background */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5); /* Depth effect */
            color: #ffffff;
        }

        .form-container h2 {
            font-size: 30px;
            margin-bottom: 20px;
            text-align: center;
            color: #ff5722;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
            font-size: 16px;
        }

        input[type="text"],
        input[type="password"] {
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            margin-bottom: 20px;
            background-color: #222;
            color: #ffffff;
            box-sizing: border-box;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            border: 2px solid #90caf9; /* Highlight input on focus */
        }

        button {
            padding: 12px;
            background-color: #ff5722; /* Bright green */
            color: #ffffff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        button:hover {
            background-color: #1e8a1e; /* Darker green hover effect */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.4);
        }

        .form-footer {
            text-align: center;
            margin-top: 20px;
        }

        .form-footer a {
            color: #90caf9;
            text-decoration: none;
            font-weight: bold;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .form-container {
                padding: 20px;
            }

            .form-container h2 {
                font-size: 26px;
            }

            button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

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

    <main>
        <div class="form-container">
            <h2>Login</h2>
            <form action="login_process.php" method="POST">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Login</button>
            </form>
            <div class="form-footer">
                <p>Don't have an account? <a href="register.php">Register here</a></p>
            </div>
        </div>
    </main>

</body>
</html>
