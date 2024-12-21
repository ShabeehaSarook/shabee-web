<?php   include 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - The Gallery Café</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('about.avif') no-repeat center center fixed;
            background-size: cover;
            color: #64e315;
        }

        header {
            background-color: rgba(0, 0, 0, 0.8);
            padding: 30px 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        nav {
            display: flex;
            justify-content: flex-end; /* Aligns items to the right */
            align-items: center;
            padding-right: 50px; /* Adds some space to the right */
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            animation: fadeIn 1.5s ease-in-out;
        }

        nav ul li {
            margin: 0 30px; /* Adjusted margin for larger space between items */
        }

        nav ul li a {
            text-decoration: none;
            color: #d4a373;
            font-size: 1em; /* Increased font size */
            font-weight: bold;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        nav ul li a:hover {
            color: #54dd22;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.7);
            transform: scale(1.1);
        }

        .container {
            width: 80%;
            max-width: 900px;
            margin: 150px auto 60px;
            padding: 40px;
            border-radius: 10px;
            background: rgba(0, 0, 0, 0.6);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 1s ease;
        }

        h1 {
            text-align: center;
            color: #d4a373;
            margin-bottom: 30px;
            font-size: 2.5em;
            font-weight: bold;
            animation: fadeIn 1.5s ease-in-out;
        }

        .contact-info {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
        }

        .contact-info div {
            flex: 1;
            min-width: 250px;
            padding: 20px;
            border-radius: 10px;
            background-color: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(0, 0, 0, 0.1);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            animation: fadeInUp 1s ease;
        }

        .contact-info h2 {
            color: #d4a373;
            margin-bottom: 15px;
            font-size: 1.3em;
            font-weight: bold;
        }

        .contact-info p {
            margin: 0;
            font-size: 1.1em;
        }

        .footer-section {
            text-align: center;
            margin-top: 40px;
        }

        .footer-section h3 {
            color: #d4a373;
            margin-bottom: 20px;
            font-size: 1.5em;
        }

        .socials {
            display: flex;
            justify-content: center;
            gap: 15px;
            animation: fadeIn 1.5s ease-in-out;
        }

        .socials a {
            color: #54dd22;
            font-size: 1.5em;
            text-decoration: none;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .socials a:hover {
            color: #1d72da;
            transform: scale(1.2);
        }

        @media (max-width: 768px) {
            nav ul {
                flex-direction: column;
                align-items: center;
            }

            nav ul li {
                margin: 10px 0;
            }

            .container {
                margin: 180px auto 60px;
                padding: 20px;
            }

            .contact-info div {
                padding: 10px;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translate3d(0, 40px, 0);
            }
            to {
                opacity: 1;
                transform: none;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="index-aboutus.php">About Us</a></li>
                <li><a href="index-contact.php">Contact Us</a></li>
                <li><a href="menu.php">Menu</a></li>
               
                
            </ul>
        </nav>
    </header>
    <div class="container">
        <h1>Contact Us</h1>
        <div class="contact-info">
            <div>
                <h2>Our Location</h2>
                <p>Gallery Café<br>Sri Lanka</p>
            </div>
            <div>
                <h2>Phone</h2>
                <p>+94 123 456 789</p>
            </div>
            <div>
                <h2>Email</h2>
                <p>shabeehazarook@gmail.com</p>
            </div>
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
    </div>
</body>
</html>
