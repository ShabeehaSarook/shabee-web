<?php   include 'connection.php'; 
?>
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
            
            color: #d4a373;
            background: url('Black good morning coffee instagram story.png') no-repeat center center/cover;
            background-attachment: fixed;
        }

        header {
            background: url('black.jpeg') no-repeat center center/cover;
            color: #fff;
            padding: 5px 0;
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
            color: #d4a373;
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
    height: 800px; /* Increased height for more space */
    color: #d4a373;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    position: relative;
    padding: 0 20px; /* Added padding for better content positioning */
}

.hero-content {
    background: rgba(0, 0, 0, 0.7); /* Darker background for better text contrast */
    padding: 60px 40px; /* Increased padding for spacious feel */
    border-radius: 15px;
    max-width: 700px; /* Wider content area */
    text-align: center;
    animation: fadeIn 1.5s ease-in-out;
}

.hero-content h1 {
    font-size: 4em; /* Larger font size for prominence */
    margin: 0 0 20px;
    animation: textAnimation 2s ease-in-out forwards;
}

.hero-content p {
    font-size: 1.5em; /* Larger font size for better readability */
    margin: 20px 0;
    animation: textAnimation 2.5s ease-in-out forwards;
}

.hero-content .btn {
    background: #d4a373;
    color: #fff;
    padding: 15px 30px; /* Increased padding for a more substantial look */
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    font-size: 1.2em; /* Increased font size for emphasis */
    transition: background 0.3s ease-in-out;
    animation: textAnimation 3s ease-in-out forwards;
}

.hero-content .btn:hover {
    background: #c4956b; /* Slightly darker hover effect */
}



        .specials {
            padding: 50px 0;
            background: #f4f4f4;
            animation: fadeInUp 1s ease-in-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .specials .container h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 2.5em;
            color: #333;
        }

        .special-items {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 20px;
        }

        .special-item {
            text-align: center;
            width: 30%;
            margin-bottom: 20px;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            overflow: hidden;
        }

        .special-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease-in-out;
        }

        .special-item h3 {
            font-size: 1.5em;
            margin: 10px 0;
            color: #333;
        }

        .special-item p {
            font-size: 1em;
            color: #666;
        }

        .special-item:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        .special-item:hover img {
            transform: scale(1.1);
        }

        .about {
            padding: 50px 0;
            text-align: center;
            position: relative;
        }

        .about .container {
            width: 80%;
            max-width: 800px;
            margin: 0 auto;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 1s ease-in-out forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .about h2 {
            font-size: 2.5em;
            margin-bottom: 20px;
        }

        .about p {
            font-size: 1.2em;
            line-height: 1.5;
        }

        .about img {
            width: 100%;
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
    <form action="index.html" method="post">
        <!-- form fields -->
    </form>
    
    <header id="header">
        <div class="container">
            <div class="logo">
                <img src="Brown Retro and Vintage Coffee Shop Badge Logo.png" alt="The Gallery Café Logo">
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="index-aboutus.php">About Us</a></li>
                    <li><a href="index-contact.php">Contact Us</a></li>
                    <li><a href="menu.php">Menu</a></li>
                   
  

                </ul>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h1>Welcome to The Gallery Café</h1>
            <p>Experience the best coffee and ambiance in town.</p>
            <a href="menu.php" class="btn">Explore Menu</a>
        </div>
    </section>

    <section class="specials">
        <div class="container">
            <h2>Our Specials</h2>
            <div class="special-items">
                <div class="special-item">
                    <img src="specialitems1.jpeg" alt="Special Item 1">
                    <h3>Special bun</h3>
                    <p>Try our exclusive bun.</p>
                </div>
                <div class="special-item">
                    <img src="specialitems2.jpeg" alt="Special Item 2">
                    <h3>Delicious cake</h3>
                    <p>Freshly baked every day to perfection.</p>
                </div>
                <div class="special-item">
                    <img src="specialitems3.jpeg" alt="Special Item 3">
                    <h3>Gourmet coffees</h3>
                    <p>Perfect for a quick and tasty coffee.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="about">
        <div class="container">
            <h2>About Us</h2>
            <p>The Gallery Café offers a unique and cozy atmosphere for coffee lovers. Our mission is to provide high-quality coffee and delicious food with exceptional service. Whether you're here for a quick coffee break or a relaxing meal, we strive to make every visit memorable.</p>
            <img src="Home.png" alt="About The Gallery Café">
        </div>
    </section>

    <footer>
        <div class="container footer-content">
            <div class="footer-section contact-us">
                <h3>Contact Us</h3>
                <p>123 Coffee Lane<br>Latte City, CA 94000</p>
                <p>Email: info@thegallerycafe.com</p>
                <p>Phone: (123) 456-7890</p>
            </div>

            <div class="footer-section follow-us">
                <h3>Follow Us</h3>
                <div class="socials">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="https://youtu.be/fS8Rc2DqMJA?si=kcWse3yl-LCKb-kB"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <div class="footer-section about-us">
                <h3>About Us</h3>
                <p>Learn more about our story, mission, and values. At The Gallery Café, we are dedicated to creating a welcoming atmosphere where every visit feels special.</p>
            </div>
        </div>

    
    </footer>

    <script>
        window.addEventListener('scroll', function () {
            const header = document.getElementById('header');
            header.classList.toggle('scrolled', window.scrollY > 50);
        });
    </script>
</body>

</html>
