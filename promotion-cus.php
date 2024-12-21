<?php include 'connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promotions - The Gallery Café</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-image: url('prooo.avif'); /* Make sure the image path is correct */
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
            background-color: rgba(0, 0, 0, 0.9); /* Black background color */
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
            justify-content: flex-end; /* Aligns items to the right */
            align-items: center;
            padding-right: 50px; /* Adds some space to the right */
        }
        header nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            gap: 20px; /* Adjusts space between navigation items */
        }
        header nav ul li {
            margin: 0;
        }
        header nav ul li a {
            color: #d4a373;
            text-decoration: none;
            font-size: 1em; /* Larger font size */
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
            backdrop-filter: blur(10px); /* Optional: add a blur effect */
            animation: slideIn 1s ease-in-out;
            position: relative;
        }
        @keyframes slideIn {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        footer {
            background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent background */
            color: #d4a373;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        /* Promotions styles */
        .promotions {
            margin-top: 40px;
            text-align: center;
        }
        .promotions h2 {
            color: #d4a373;
            margin-bottom: 20px;
            animation: fadeInLeft 1s ease-in-out;
        }
        @keyframes fadeInLeft {
            from { transform: translateX(-20px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        .promotions .promotion {
            background-color: rgba(84, 45, 4, 0.227);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            animation: fadeInUp 1s ease-in-out;
        }
        @keyframes fadeInUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .promotions .promotion img {
            width: 100%;
            max-width: 150px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            margin-right: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .promotions .promotion img:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        }
        .promotions .promotion p {
            color: #d4a373;
            margin: 0;
        }
        .promotions .promotion:hover p {
            color: #4CAF50;
        }
        .promotions .promotion a {
            color: #d4a373;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }
        .promotions .promotion a:hover {
            color: #4CAF50;
        }

        /* Order Button Styles */
        .order-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #d4a373;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
        }
        .order-button a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }
        .order-button:hover {
            background-color: #bfa06a;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }
        .order-button i {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="customer.php">Home</a></li>
                <li><a href="menu-cus.php">Menu</a></li>
                <li><a href="cus-aboutus.php">About Us</a></li>
                <li><a href="cus-contactus.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <!-- Promotions section -->
        <div class="promotions">
            <h2>Special Promotions</h2>
            <?php
            // Fetch promotions from the database
            $query = "SELECT * FROM promotions ORDER BY created_at DESC";
            $result = mysqli_query($conn, $query);

            // Check if there are any promotions
            $promotions = mysqli_fetch_all($result, MYSQLI_ASSOC);

            if ($promotions):
                foreach ($promotions as $promotion): ?>
                    <div class="promotion">
                        <img src="uploads/<?php echo htmlspecialchars($promotion['image']); ?>" alt="Promotion Image">
                        <div>
                            <h3><?php echo htmlspecialchars($promotion['title']); ?></h3>
                            <p><?php echo htmlspecialchars($promotion['description']); ?></p>
                            <?php if (!empty($promotion['link'])): ?>
                                <a href="<?php echo htmlspecialchars($promotion['link']); ?>" target="_blank">Learn More</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach;
            else: ?>
                <p>No promotions available at the moment.</p>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
