<?php   include 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Promotion - The Gallery Café</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-image: url('prooo.avif');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #ec7c0c;
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        header {
            background-color: rgba(0, 0, 0, 0.9);
            color: #d4a373;
            padding: 20px 0;
            text-align: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: background-color 0.3s ease;
        }
        header nav {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding-right: 50px;
        }
        header nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            gap: 20px;
        }
        header nav ul li {
            margin: 0;
        }
        header nav ul li a {
            color: #d4a373;
            text-decoration: none;
            font-size: 1em;
            font-weight: bold;
            padding: 10px 20px;
            transition: background-color 0.3s ease, color 0.3s ease;
            border-radius: 5px;
        }
        header nav ul li a:hover {
            background-color: #555;
            color: #54dd22;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.7);
        }
        main {
            padding: 20px;
            max-width: 900px;
            margin: 20px auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            animation: slideIn 1s ease-in-out;
            position: relative;
           
        }
        @keyframes slideIn {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        footer {
            background-color: rgba(0, 0, 0, 0.7);
            color: #d4a373;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .order-form {
            margin-top: 40px;
            text-align: center;
        }
        .order-form h2 {
            color: #d4a373;
            margin-bottom: 20px;
            animation: fadeInLeft 1s ease-in-out;
        }
        @keyframes fadeInLeft {
            from { transform: translateX(-20px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        .order-form form {
            background-color: rgba(115, 97, 81, 0.8);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            animation: fadeInUp 1s ease-in-out;
        }
        @keyframes fadeInUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .order-form input, .order-form select {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #d4a373;
            font-size: 1em;
        }
        .order-form button {
            background-color: #d4a373;
        
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .order-form button:hover {
            background-color: #bfa06a;
        }
        .nav-buttons {
            display: flex;
            justify-content: space-between;
            width: calc(100% - 40px);
            padding: 0 20px;
            margin-bottom: 20px;
        }
        .nav-buttons a {
            color: #fff;
            background-color: #d4a373;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .nav-buttons a:hover {
            background-color: #bfa06a;
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

    <main>
        <!-- Order Promotion section -->
        <div class="order-form">
            <h2>Order Your Promotion</h2>
            <form action="promotion-order.php" method="POST">
                <label for="promotion">Select Promotion:</label>
                <select name="promotion" id="promotion" required>
                    <option value="">Select a Promotion</option>
                    <option value="dinner_delight">Dinner Delight - 20% off desserts</option>
                    <option value="delightful_desserts">Delightful Desserts - Discount on dinner items</option>
                    <option value="beverage_bonanza">Beverage Bonanza - Buy one get one free drinks</option>
                </select>
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <input type="tel" name="phone" placeholder="Your Phone" required>
                <input type="number" name="quantity" placeholder="Quantity" min="1" required>
                <button type="submit"><i class="fas fa-shopping-cart"></i> Order Now</button>
            </form>
        </div>

        <div class="nav-buttons">
            <a href="promotion.php">Promotion</a>
            <a href="menu.php">Menu</a>
        </div>
    </main>
</body>
</html>
