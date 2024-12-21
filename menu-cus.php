<?php   include 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - The Gallery Café</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-image: url('menu.png'); /* Make sure the image path is correct */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-color: rgba(0, 0, 0, 0.5); /* Added a fallback color for better visibility */
            color: #d4a373; /* Changed text color */
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        header {
            background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent background */
            color: #d4a373; /* Changed text color */
            padding: 10px 0;
            text-align: center;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        header nav ul {
            list-style-type: none;
            padding: 0;
        }
        header nav ul li {
            display: inline;
            margin: 0 10px;
        }
        header nav ul li a {
            color: #d4a373; /* Changed text color */
            text-decoration: none;
            padding: 5px 10px;
            transition: background-color 0.3s ease;
        }
        header nav ul li a:hover {
            background-color: #555;
        }
        main {
            padding: 20px;
            max-width: 900px;
            margin: 20px auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.2); /* Slightly transparent background for better readability */
            backdrop-filter: blur(10px); /* Optional: add a blur effect */
            animation: slideIn 1s ease-in-out;
            position: relative; /* Ensure the order button is positioned correctly */
        }
        @keyframes slideIn {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        footer {
            background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent background */
            color: #d4a373; /* Changed text color */
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        /* Category styles */
        .category {
            background-color: rgba(84, 45, 4, 0.227);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            animation: fadeInUp 1s ease-in-out;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around; /* Center align items with space around */
        }
        @keyframes fadeInUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .category h2 {
            color: #d4a373; /* Changed text color */
            border-bottom: 2px solid #ccc;
            padding-bottom: 10px;
            margin-bottom: 15px;
            animation: fadeInLeft 1s ease-in-out;
            width: 100%;
            text-align: center;
        }
        @keyframes fadeInLeft {
            from { transform: translateX(-20px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        .item {
            background-color: rgba(255, 255, 255, 0.8); /* Added background for better readability */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 10px;
            margin: 10px;
            display: flex;
            align-items: center;
            max-width: 300px; /* Limit width for better horizontal display */
            width: 100%;
        }
        .item img {
            width: 100px; /* Set a fixed width for images */
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            margin-right: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .item-details {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .item-name {
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }
        .item-price {
            color: #d4a373;
        }
        .item img:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        }

        /* Order Button Styles */
        .order-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #d4a373; /* Button color */
            color: #fff;
            padding: 15px 30px; /* Increased padding for a more prominent button */
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            font-size: 16px; /* Larger font size for better readability */
            text-align: center; /* Center-align the text */
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .order-button i {
            margin-right: 10px; /* Add some space between the icon and the text */
        }
        .order-button:hover {
            background-color: #bfa06a; /* Slightly darker on hover */
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }

        /* Promotion Button Styles */
        .promotion-button {
            position: fixed;
            bottom: 20px;
            left: 20px; /* Positioned to the left corner */
            background-color: #d4a373; /* Button color */
            color: #fff;
            padding: 15px 30px; /* Increased padding for a more prominent button */
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            font-size: 16px; /* Larger font size for better readability */
            text-align: center; /* Center-align the text */
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .promotion-button i {
            margin-right: 10px; /* Add some space between the icon and the text */
        }
        .promotion-button:hover {
            background-color: #bfa06a; /* Slightly darker on hover */
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
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

    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="customer.php">Home</a></li>
                <li><a href="menu-cus.php">Menu</a></li>
                <li><a href="cus-aboutus.php">About Us</a></li>
                <li><a href="cus-contactus.php">Contact Us</a></li>
                
                
            </ul>
        </nav>
    </header>

    <main>
        <h1 style="text-align:center; color: #fff;">Our Menu</h1>
        <?php
        $sql = "SELECT * FROM menu_items";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $categories = array(
                "Cake item" => array(),
                "Hot Beverage" => array(),
                "Dessert" => array()
            );

            while ($row = $result->fetch_assoc()) {
                $categories[$row["category"]][] = $row;
            }

            foreach ($categories as $category => $items) {
                if (!empty($items)) {
                    echo '<div class="category">';
                    echo '<h2>' . $category . '</h2>';
                    echo '<div class="grid">';
                    foreach ($items as $item) {
                        echo '<div class="item">';
                        if (!empty($item["image"])) {
                            echo '<img src="images/' . $item["image"] . '" alt="' . $item["name"] . '">';
                        }
                        echo '<div class="item-details">';
                        echo '<p class="item-name">' . $item["name"] . '</p>';
                        echo '<p class="item-price">Rs ' . $item["price"] . '</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                    echo '</div>';
                    echo '</div>';
                }
            }
        } else {
            echo "<p>No menu items found.</p>";
        }

        $conn->close();
        ?>

    </main>

    
     <!-- Promotion Button -->
     <div class="promotion-button">
        <i class="fas fa-bullhorn"></i> Promotions
    </div>

    <script>
        document.querySelector('.promotion-button').addEventListener('click', function() {
            window.location.href = 'promotion-cus.php';
        });
    </script>
</body>
</html>
