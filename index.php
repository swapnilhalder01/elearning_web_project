<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Learning Platform</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
       body {
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    background: url('images/neub.png') no-repeat center center fixed;
    background-size: 500px 500px;
}


        .navbar {
            background-color: #1c1c1c;
            padding: 15px 0;
            color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo a {
    display: flex;
    align-items: center;
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

        /* Hero Section */
        .hero {
            background: #4CAF50;
            color: #000;
            text-align: center;
            padding: 100px 20px;
        }

        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .hero p {
            font-size: 20px;
            margin-bottom: 30px;
            color: #000;
        }

        .hero .btn {
            background: #ff5722;
            color: #fff;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .hero .btn:hover {
            background: #e64a19;
            transform: translateY(-3px);
        }

        /* Slider Section */
        .slider {
            position: relative;
            max-width: 800px;
            margin: 50px auto;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .slides {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .slide {
            min-width: 100%;
            transition: opacity 0.5s ease-in-out;
        }

        .slide img {
            width: 100%;
            display: block;
        }

        .slider-controls {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
        }

        .prev, .next {
            background: rgba(0, 0, 0, 0.5);
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 50%;
            font-size: 14px;
            transition: background 0.3s ease;
        }

        .prev:hover, .next:hover {
            background: #e64a19;;
        }

        .slider-indicators {
            text-align: center;
            margin-top: 10px;
        }

        .indicator {
            display: inline-block;
            width: 8px;
            height: 10px;
            margin: 5px;
            background: #ddd;
            border-radius: 50%;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .indicator.active {
            background: #ff5722;
        }
         /* Features Section */
         .features {
            padding: 60px 20px;
            text-align: center;
            background: #f9f9f9;
        }

        .features h2 {
            font-size: 36px;
            margin-bottom: 40px;
            color: #333;
        }

        .feature-list {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .feature-item {
            flex: 0 1 calc(33% - 20px);
            margin-bottom: 40px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 20px;
        }

        .feature-item img {
            max-width: 100%;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .feature-item h3 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #333;
        }

        .feature-item p {
            font-size: 16px;
            color: #666;
        }

        /* Call to Action Section */
        .cta {
            background: #4CAF50;
            color: #000;
            padding: 50px 20px;
            text-align: center;
        }

        .cta h2 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .cta p {
            font-size: 18px;
            margin-bottom: 30px;
            color: #000;
        }

        .cta .btn {
            background: #ff5722;
            color: #fff;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
        }

        /* Footer */
        footer {
            background: #1c1c1c;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }

        footer .social-links {
            margin-bottom: 10px;
        }

        footer .social-links a {
            color: #fff;
            margin: 0 10px;
            font-size: 20px;
            transition: color 0.3s ease;
        }

        footer .social-links a:hover {
            color: #ff5722;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .feature-item {
                flex: 0 1 calc(50% - 20px);
            }
        }

        @media (max-width: 480px) {
            .feature-item {
                flex: 0 1 100%;
            }
        }
    </style>
</head>
<body>
  <!-- Navigation Bar -->
<nav class="navbar">
    <div class="container">
        <div class="logo">
            <a href="index.php">
                E-Learning
            </a>
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


    <!-- Hero Section -->
    <header class="hero">
        <div class="container">
            <h1>Discover Your Learning Journey</h1>
            <p>Join the NEUB Free E-Learning Platform and start learning today. Unlimited courses at your fingertips.</p>
            <a href="courses_viewer.php" class="btn">Explore Now</a>
        </div>
    </header>

    <!-- Slider Section -->
    <section class="slider">
        <div class="slides">
            
            <div class="slide"><img src="images/Learn Anywhere.jpg" alt="Slide 2"></div>
            <div class="slide"><img src="images/Expert Tutors.jpg" alt="Slide 3"></div>
            <div class="slide"><img src="images/Special Care.jpg" alt="Slide 4"></div>
        </div>
        <div class="slider-controls">
            <button class="prev">&#10094;</button>
            <button class="next">&#10095;</button>
        </div>
        <div class="slider-indicators">
            <span class="indicator active" data-slide="0"></span>
            <span class="indicator" data-slide="1"></span>
            <span class="indicator" data-slide="2"></span>
            
        </div>
    </section>

    <script>
        const slides = document.querySelector('.slides');
        const slidesCount = document.querySelectorAll('.slide').length;
        const indicators = document.querySelectorAll('.indicator');
        let currentSlide = 0;

        document.querySelector('.prev').addEventListener('click', () => {
            currentSlide = (currentSlide === 0) ? slidesCount - 1 : currentSlide - 1;
            updateSlider();
        });

        document.querySelector('.next').addEventListener('click', () => {
            currentSlide = (currentSlide === slidesCount - 1) ? 0 : currentSlide + 1;
            updateSlider();
        });

        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                currentSlide = index;
                updateSlider();
            });
        });

        function updateSlider() {
            slides.style.transform = `translateX(-${currentSlide * 100}%)`;
            indicators.forEach(indicator => indicator.classList.remove('active'));
            indicators[currentSlide].classList.add('active');
        }
    </script>
    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <h2>Our Features</h2>
            <div class="feature-list">
                <div class="feature-item">
                    <img src="images/Extensive Courses.jpg" alt="Courses">
                    <h3>Extensive Courses</h3>
                    <p>Choose from a wide variety of courses designed by top instructors.</p>
                </div>
                <div class="feature-item">
                    <img src="images/Learn Anywhere.jpg" alt="Convenience">
                    <h3>Learn Anywhere</h3>
                    <p>Access your lessons anytime, anywhere with ease.</p>
                </div>
                <div class="feature-item">
                    <img src="images/Expert Tutors.jpg" alt="Experts">
                    <h3>Expert Tutors</h3>
                    <p>Learn from the best with hands-on experience and support.</p>
                </div>
                <div class="feature-item">
                    <img src="images/Special Care.jpg" alt="Experts">
                    <h3>Special Care</h3>
                    <p>Learn from the best with hands-on experience and support.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="cta">
        <div class="container">
            <h2>Ready to Start?</h2>
            <p>Join thousands of learners and enhance your skills with NEUB's E-Learning Platform.</p>
            <a href="register.php" class="btn">Sign Up Now</a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        
            <p>&copy; 2024 E-Learning Platform. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>
