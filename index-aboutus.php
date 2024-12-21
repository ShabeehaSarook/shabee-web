<?php   include 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - The Gallery Café</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #d4a373;
            background: url('abouttt.avif') no-repeat center center/cover;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        header {
            background: url('black.jpeg') no-repeat center center/cover;
            color: #fff;
            padding: 20px 0;
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
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo img {
            height: 80px;
            transition: transform 0.3s ease-in-out;
        }

        .logo img:hover {
            transform: scale(1.1);
        }

        nav {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            background-color: transparent;
            padding: 10px 0;
        }

        nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            margin: 0;
        }

        nav ul li {
            margin-left: 20px;
        }

        nav ul li a {
            color: #d4a373;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease-in-out;
            font-size: 16px;
        }

        nav ul li a:hover {
            color: #c4956b;
        }

        .section-container {
            background: rgba(0, 0, 0, 0.7);
            padding: 50px;
            margin: 30px auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            text-align: center;
            animation: fadeInUp 1s ease-in-out;
        }

        .about-section h1,
        .team-section h2,
        .values-section h2,
        .timeline-section h2 {
            color: #d4a373;
            font-size: 36px;
            margin-bottom: 20px;
            font-family: 'Georgia', serif;
            font-weight: bold;
        }

        .about-section p,
        .team-member p,
        .values-section ul,
        .timeline-section ul {
            color: #d4a373;
            font-size: 18px;
            line-height: 1.6;
        }

        .team-section {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .team-member {
            margin: 20px;
            text-align: center;
        }

        .team-member img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
            margin-bottom: 15px;
            border: 4px solid #d4a373;
            transition: transform 0.3s ease-in-out;
        }

        .team-member img:hover {
            transform: scale(1.05);
        }

        .team-member h3 {
            color: #d4a373;
            font-size: 22px;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .values-section ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .values-section ul li {
            margin-bottom: 10px;
        }

        .timeline-section {
            text-align: left;
        }

        .timeline-section ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .timeline-section ul li {
            margin-bottom: 15px;
            font-size: 16px;
        }

        footer {
            background: 0 4px 8px rgba(0, 0, 0, 0.1);
            color: #fff;
            padding: 40px 0;
            font-size: 14px;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .footer-section {
            flex: 1;
            margin: 10px;
            padding: 20px;
        }

        .footer-section h3 {
            margin-bottom: 15px;
            color: #d4a373;
        }

        .footer-section p,
        .footer-section ul {
            margin: 0;
            color: #d4a373;
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
        }

        .footer-section ul li {
            margin-bottom: 10px;
        }

        .footer-section ul li a {
            color: #d4a373;
            text-decoration: none;
            transition: color 0.3s ease-in-out;
        }

        .footer-section ul li a:hover {
            color: #c4956b;
        }

        .socials a {
            color: #d4a373;
            font-size: 18px;
            margin-right: 10px;
            transition: color 0.3s ease-in-out;
        }

        .socials a:hover {
            color: #c4956b;
        }

        .footer-bottom {
            text-align: center;
            padding: 10px;
            background: #010f1d;
            border-top: 1px solid #d4a373;
            color: #d4a373;
            font-size: 12px;
        }

        @media (max-width: 768px) {
            .footer-content {
                flex-direction: column;
                text-align: center;
            }

            nav ul {
                flex-direction: column;
                align-items: center;
            }

            nav ul li {
                margin: 10px 0;
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
                    <li><a href="index.php">Home</a></li>
                    <li><a href="index-aboutus.php">About Us</a></li>
                    <li><a href="index-contact.php">Contact Us</a></li>
                    <li><a href="menu.php">Menu</a></li>
                   
                </ul>
            </nav>
        </div>
    </header>

    <div class="section-container about-section">
        <h1>About Us</h1>
        <p>Welcome to The Gallery Café, where we blend art, culture, and cuisine into a unique dining experience. Our café is dedicated to providing an inviting atmosphere where every guest feels like family.</p>
        <p>Founded in [Year], our mission is to serve delicious coffee and meals while creating a space where creativity and community can thrive. From our carefully crafted menu to our vibrant events, we strive to make every visit a memorable one.</p>
        <p>Join us and experience the perfect combination of great food, delightful ambiance, and exceptional service.</p>
    </div>

    <div class="section-container team-section">
        <h2>Meet Our Team</h2>
        <div class="team-member">
            <img src="ow2.jpeg" alt="Team Member 1">
            <h3>SHABEEHA</h3>
            <p>Founder & CEO - Shabeeha leads our team with passion and dedication, ensuring every detail reflects our café's values.</p>
        </div>
        <div class="team-member">
            <img src="ow1.jpeg" alt="Team Member 2">
            <h3>SHALIHA</h3>
            <p>Head Barista - Shaliha is a master of coffee, crafting each cup with skill and creativity.</p>
        </div>
        <!-- Add more team members as needed -->
    </div>

    <div class="section-container values-section">
        <h2>Our Values</h2>
        <ul>
            <li>Quality: We prioritize the highest quality ingredients and craftsmanship in everything we serve.</li>
            <li>Community: We are committed to creating a welcoming space where everyone feels like part of our family.</li>
            <li>Creativity: Our café is a hub for artistic expression, from our décor to our events.</li>
            <li>Sustainability: We strive to operate sustainably, reducing our environmental footprint wherever possible.</li>
        </ul>
    </div>

    <div class="section-container timeline-section">
        <h2>Our Journey</h2>
        <ul>
            <li><strong>[Year]</strong> - The Gallery Café was founded with the vision of creating a unique cultural and culinary space.</li>
            <li><strong>[Year]</strong> - Introduced our signature blend of coffee, quickly becoming a local favorite.</li>
            <li><strong>[Year]</strong> - Expanded our menu to include a variety of international dishes, catering to diverse tastes.</li>
            <li><strong>[Year]</strong> - Launched our community art events, showcasing local artists and performers.</li>
            <li><strong>[Year]</strong> - Opened our second location, bringing The Gallery Café experience to a new neighborhood.</li>
        </ul>
    </div>

   
    <script>
        window.addEventListener('scroll', function() {
            var header = document.getElementById('header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>