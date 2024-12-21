<?php
// Include database connection
include 'connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $item = mysqli_real_escape_string($conn, $_POST['item']);
    $quantity = intval($_POST['quantity']);

    // Basic validation
    if (empty($category) || empty($item) || $quantity <= 0) {
        echo "Invalid input. Please fill out the form correctly.";
        exit;
    }

    // Prepare SQL statement
    $sql = "INSERT INTO orders (category, item, quantity) VALUES ('$category', '$item', $quantity)";

    // Execute SQL statement
    if (mysqli_query($conn, $sql)) {
        echo "Order placed successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close database connection
    mysqli_close($conn);
} else {
    // If form is not submitted
    echo "Form submission error.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Food - The Gallery Café</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-image: url('White Minimalist Good Morning Quote Coffee Instagram Story.png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-color: rgba(247, 130, 5, 0.227);
            color: #d4a373;
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
            color: #d4a373;
            text-decoration: none;
            padding: 5px 10px;
            transition: background-color 0.3s ease;
        }
        header nav ul li a:hover {
            background-color: #555;
        }
        main {
            padding: 20px;
            max-width: 800px;
            margin: 20px auto;
            border-radius: 10px;
            box-shadow: rgba(247, 130, 5, 0.227);
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
        form {
            display: flex;
            flex-direction: column;
            background-color: rgba(15, 8, 1, 0.227);
            padding: 20px;
            border-radius: 10px;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 8px;
        }
        label {
            margin: 10px 0 5px;
            color: #d4a373;
            font-size: 18px;
        }
        select, input[type="number"], input[type="submit"] {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-bottom: 10px;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: #d4a373;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #bfa06a;
        }
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
                
                <li><a href="index-aboutus.html">About Us</a></li>
                <li><a href="index-contact.html">Contact Us</a></li>
                <li><a href="menu.html">Menu</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Order Food</h1>
        <form action="order.php" method="POST">
            <label for="category">Select Category:</label>
            <select id="category" name="category" required>
                <option value="" disabled selected>Select a category</option>
                <option value="cake">Cake Items</option>
                <option value="beverage">Beverages</option>
                <option value="dessert">Desserts</option>
                <option value="dinner">Dinner</option>
            </select>

            <label for="item">Select Item:</label>
            <select id="item" name="item" required>
                <option value="" disabled selected>Select an item</option>
            </select>

            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" min="1" value="1" required>

            <input type="submit" value="Place Order">
        </form>

        <div class="order-button">
            <a href="make-reservation.php"><i class="fas fa-shopping-cart"></i> Reservation Now</a>
        </div>
    </main>

    <script>
        document.getElementById('category').addEventListener('change', function() {
            var category = this.value;
            var itemSelect = document.getElementById('item');
            var options = {
                'cake': ['Chocolate Cake', 'Vanilla Cake', 'Red Velvet Cake'],
                'beverage': ['Coffee', 'Tea', 'Juice'],
                'dessert': ['Ice Cream', 'Brownie', 'Fruit Salad'],
                'dinner': ['Pasta', 'Pizza', 'Burger']
            };

            // Clear previous options
            itemSelect.innerHTML = '<option value="" disabled selected>Select an item</option>';

            // Add new options based on category
            if (options[category]) {
                options[category].forEach(function(item) {
                    var option = document.createElement('option');
                    option.value = item;
                    option.textContent = item;
                    itemSelect.appendChild(option);
                });
            }
        });
    </script>
</body>
</html>
