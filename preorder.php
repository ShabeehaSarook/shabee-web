<?php
include 'connection.php'; // Ensure this file sets up your $conn variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $pickup_date = mysqli_real_escape_string($conn, $_POST['pickup_date']);
    $pickup_time = mysqli_real_escape_string($conn, $_POST['pickup_time']);
    $order_details = mysqli_real_escape_string($conn, $_POST['order']);
    
    // Prepare SQL statement to insert data into the orders table
    $sql = "INSERT INTO orders (name, email, phone, pickup_date, pickup_time, order_details) 
            VALUES ('$name', '$email', '$phone', '$pickup_date', '$pickup_time', '$order_details')";
    
    // Execute the query
    if (mysqli_query($conn, $sql)) {
        // Redirect to a thank you or confirmation page
        header("Location:admin-preorder.php");
        exit();
    } else {
        // Redirect back to the form with an error message
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
    // Close the database connection
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pre-order - The Gallery Café</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #d4a373; /* Changed text color */
            background-image: url('Green And Brown Photo Coffee Inspirational Instagram Post.png'); /* Ensure image path is correct */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        header {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 10px 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            text-align: center;
            display: flex;
            justify-content: center;
            animation: slideIn 1s ease-in-out;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            text-decoration: none;
            color: #d4a373; /* Changed text color */
            font-weight: bold;
            position: relative;
            padding: 10px;
            transition: color 0.3s ease;
        }

        nav ul li a::before {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: #d4a373; /* Changed border color */
            transition: width 0.3s ease;
        }

        nav ul li a:hover::before {
            width: 100%;
        }

        nav ul li a:hover {
            color: #ddd; /* Lightened hover color for contrast */
        }

        .preorder-container {
            padding: 20px;
            margin: 40px auto;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            animation: fadeIn 1.5s ease-in-out;
        }

        .preorder-container h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #d4a373; /* Changed header color */
        }

        .preorder-form {
            max-width: 600px;
            margin: 0 auto;
        }

        .preorder-form label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #d4a373; /* Changed label color */
        }

        .preorder-form input[type="text"],
        .preorder-form input[type="email"],
        .preorder-form input[type="tel"],
        .preorder-form input[type="date"],
        .preorder-form input[type="time"],
        .preorder-form textarea,
        .preorder-form button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #d4a373; /* Changed border color */
            border-radius: 3px;
            font-size: 16px;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
            background-color: rgba(250, 133, 9, 0.227); /* Kept background white for inputs */
            color: #333; /* Kept input text color for readability */
        }

        .preorder-form textarea {
            resize: vertical;
        }

        .preorder-form button {
            background-color: rgba(250, 133, 9, 0.227); /* Changed button background color */
            color: #c09359;
            cursor: pointer;
            border: none;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        .preorder-form button:hover {
            background-color: #c09359; /* Slightly darker shade on hover */
        }

        .order-button {
            display: block;
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 5px;
            background-color: #89653e; /* Button color */
            color: #fff;
            font-size: 18px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }

        .order-button:hover {
            background-color: #4fa910; /* Darker shade on hover */
        }

        footer {
            background-color: rgba(0, 0, 0, 0.7);
            color: #d4a373; /* Changed footer text color */
            text-align: center;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
        }

        footer p {
            margin: 0;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
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
                <li><a href="index.html">Home</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="preorder-container">
            <h1>Pre-order</h1>
            <form class="preorder-form" action="preorder.php" method="post">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                
                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone" required>
                
                <label for="pickup_date">Pickup Date:</label>
                <input type="date" id="pickup_date" name="pickup_date" required>
                
                <label for="pickup_time">Pickup Time:</label>
                <input type="time" id="pickup_time" name="pickup_time" required>
                
                <label for="order">Order Details:</label>
                <textarea id="order" name="order" rows="4" required></textarea>
                
                <button type="submit">Place Order</button>
            </form>
            <a href="dashboard.php" class="order-button">Go to Dashboard</a>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 The Gallery Café. All rights reserved.</p>
    </footer>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Your JavaScript code here if needed
    });
    </script>
</body>
</html>
