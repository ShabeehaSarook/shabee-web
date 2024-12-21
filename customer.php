<?php   include 'connection.php';   ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery Café</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #d4a373;
            background: url('Black good morning coffee instagram story.png') no-repeat center center/cover;
            background-attachment: fixed;
        }

        header {
            background: url('black.jpeg') no-repeat center center/cover;
            color: #fff;
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: background 0.3s ease-in-out;
        }

        header.scrolled {
            background: rgba(0, 0, 0, 0.8);
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo img {
            height: 80px;
            transition: transform 0.3s ease-in-out;
        }

        .logo img:hover {
            transform: scale(1.1);
        }

        nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: flex-end;
        }

        nav ul li {
            margin-left: 20px;
        }

        nav ul li a {
            color: #d4a373;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease-in-out;
        }

        nav ul li a:hover {
            color: #c4956b;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes textAnimation {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .hero {
            background: url('bc.avif') no-repeat center center/cover;
            height: 800px;
            color: #d4a373;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            padding: 0 20px;
        }

        .hero-content {
            background: rgba(0, 0, 0, 0.7);
            padding: 60px 40px;
            border-radius: 15px;
            max-width: 700px;
            text-align: center;
            animation: fadeIn 1.5s ease-in-out;
        }

        .hero-content h1 {
            font-size: 4em;
            margin: 0 0 20px;
            animation: textAnimation 2s ease-in-out forwards;
        }

        .hero-content p {
            font-size: 1.5em;
            margin: 20px 0;
            animation: textAnimation 2.5s ease-in-out forwards;
        }

        .hero-content .btn {
            background: #d4a373;
            color: #fff;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            font-size: 1.2em;
            transition: background 0.3s ease-in-out;
            animation: textAnimation 3s ease-in-out forwards;
        }

        .hero-content .btn:hover {
            background: #c4956b;
        }

        .intro {
            padding: 50px 0;
            text-align: center;
            background: rgba(0, 0, 0, 0.5);
            color: #fff;
        }

        .intro h2 {
            font-size: 2.5em;
            margin-bottom: 20px;
        }

        .intro p {
            font-size: 1.2em;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .intro img {
            width: 100%;
            max-width: 600px;
            border-radius: 10px;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        footer {
            background: #333;
            color: #fff;
            padding: 40px 0;
            font-size: 0.9em;
            position: relative;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-section {
            width: 30%;
            margin-bottom: 30px;
        }

        .footer-section h3 {
            font-size: 1.8em;
            margin-bottom: 20px;
            color: #d4a373;
            border-bottom: 2px solid #d4a373;
            padding-bottom: 10px;
        }

        .footer-section p,
        .footer-section ul {
            margin: 0;
            color: #ccc;
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
        }

        .footer-section ul li {
            margin-bottom: 10px;
        }

        .footer-section ul li a {
            color: #ccc;
            text-decoration: none;
            transition: color 0.3s ease-in-out;
        }

        .footer-section ul li a:hover {
            color: #fff;
        }

        .socials {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .socials a {
            margin: 0 10px;
            color: #53ae1f;
            font-size: 1.5em;
            transition: color 0.3s ease-in-out;
        }

        .socials a:hover {
            color: #d4a373;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #555;
            color: #ccc;
            font-size: 0.8em;
            background: #222;
        }

        @media (max-width: 1024px) {
            .footer-section {
                width: 45%;
            }
        }

        @media (max-width: 768px) {
            .footer-section {
                width: 100%;
                text-align: center;
            }
            
        }
    </style>
</head>

<body>
    <header id="header">
        <div class="container">
            <div class="logo">
                <img src="Brown Retro and Vintage Coffee Shop Badge Logo.png" alt="The Gallery Café Logo">
            </div>
            <nav>
                <ul>
                    <li><a href="customer.php">Home</a></li>
                    <li><a href="menu-cus.php">Menu</a></li>
                    <li><a href="cus-aboutus.php">About us</a></li>
                    <li><a href="cus-contactus.php">Contact</a></li>
                  
                   
                </ul>
            </nav>
        </div>
    </header>

    <div class="hero" id="home">
        <div class="hero-content">
            <h1>Welcome to The Gallery Café</h1>
            <p>Experience the finest cuisine and ambiance in town.</p>
            <a href="login.php" class="btn">Login</a>
        </div>
    </div>

    <section class="intro">
        <div class="container">
            <h2>Discover The Gallery Café</h2>
            <p>At The Gallery Café, we offer a delightful array of dishes including cakes, desserts, beverages, and dinner options. Our menu is crafted to provide a memorable dining experience with something for everyone.</p>
            <p>We offer convenient parking facilities, making your visit hassle-free. Whether you’re planning a reservation, taking advantage of our promotions, or using our pre-order and online ordering systems, we ensure a seamless and enjoyable experience.</p>
        </div>
    </section>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>Contact Us</h3>
                <p>123 Coffee Street, Caffeine City, CA 12345</p>
                <p>Email: info@thegallerycafe.com</p>
                <p>Phone: (123) 456-7890</p>
                <div class="socials">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="menu-cus.php">Menu</a></li>
                    <li><a href="login.php">Login</a></li>
                    
                </ul>
            </div>
            <div class="footer-section">
                <h3>About Us</h3>
                <p>The Gallery Café is dedicated to providing an exceptional dining experience with a unique atmosphere and a diverse menu. Come and enjoy a perfect meal with us.</p>
            </div>
        </div>
      
    </footer>

    <script>
        // Sticky header effect
        window.addEventListener('scroll', function () {
            const header = document.getElementById('header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>
</body>

</html>