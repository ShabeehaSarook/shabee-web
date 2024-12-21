<?php   include 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Profile - The Gallery Café</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #d4a373;
        }

        .navbar {
            overflow: hidden;
            background-color: #333;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .navbar a {
            float: left;
            display: block;
            color: #d4a373;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
            font-size: 17px;
            transition: background-color 0.3s;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        .content {
            padding: 80px 20px 20px;
            max-width: 900px;
            margin: auto;
        }

        h1 {
            color: #d4a373;
            text-align: center;
        }

        .profile-info,
        .reservation-history,
        .order-history,
        .order-food {
            background-color: rgba(84, 45, 4, 0.227);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .profile-info h2,
        .reservation-history h2,
        .order-history h2,
        .order-food h2 {
            color: #d4a373;
            margin-bottom: 20px;
        }

        .profile-info label,
        .reservation-history label,
        .order-history label,
        .order-food label {
            display: block;
            margin-bottom: 10px;
            color: #d4a373;
        }

        .profile-info input,
        .profile-info button,
        .reservation-history table,
        .order-food select,
        .order-food input[type="number"],
        .order-food button {
            width: 100%;
            margin-bottom: 20px;
        }

        .profile-info input,
        .profile-info button,
        .order-food select,
        .order-food input[type="number"],
        .order-food button {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .profile-info input[type="text"],
        .profile-info input[type="email"],
        .profile-info input[type="tel"] {
            width: calc(100% - 22px);
            margin-bottom: 10px;
        }

        .profile-info button {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .profile-info button:hover {
            background-color: #45a049;
        }

        .order-food select,
        .order-food input[type="number"],
        .order-food button {
            margin-bottom: 10px;
        }

        .order-food button {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .order-food button:hover {
            background-color: #45a049;
        }

        .reservation-history table,
        .order-history table {
            border-collapse: collapse;
            background-color: rgba(84, 45, 4, 0.3);
            border-radius: 5px;
        }

        .reservation-history th,
        .reservation-history td,
        .order-history th,
        .order-history td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
            color: #d4a373;
        }

        .reservation-history th,
        .order-history th {
            background-color: rgba(247, 130, 5, 0.227);
        }

        footer {
            background-color: #333;
            color: #d4a373;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        footer a {
            color: #d4a373;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        .order-link a {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
            transition: background-color 0.3s;
        }

        .order-link a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <div class="navbar">
        <a href="index.php">Home</a>
       
    </div>

    <!-- Profile Page Content -->
    <div class="content">
        <h1>Customer Profile</h1>
        <!-- Order Link in Customer Profile -->


        <!-- Profile Information Section -->
        <div class="profile-info">
            <h2>Profile Information</h2>
            <form id="profile-form">
                <label for="name">Name:</label>
                <input type="text" id="name" placeholder="John Doe" required>
                
                <label for="email">Email:</label>
                <input type="email" id="email" placeholder="john@example.com" required>
                
                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" placeholder="123-456-7890" required>
                
                <button type="submit">Update Profile</button>
            </form>
        </div>

        <div class="order-link">
            <a href="menu.php">Order Food</a>
        </div>
        <!-- Order Food Section -->
        <div class="order-food">
            <h2>Order Food</h2>
          
            <form id="order-form">
                <label for="category">Category:</label>
                <select id="category" required>
                    <option value="" disabled selected>Select Category</option>
                    <option value="Breakfast">Breakfast</option>
                    <option value="Lunch">Lunch</option>
                    <option value="Dinner">Dinner</option>
                    <option value="Dessert">Dessert</option>
                </select>

                <label for="item">Item:</label>
                <input type="text" id="item" placeholder="Enter food item" required>

                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" min="1" placeholder="1" required>

                <button type="submit">Place Order</button>
            </form>
        </div>

        <!-- Reservation History Section -->
        <div class="order-link">
            <a href="make-reservation.php">reservation history</a>
        <div class="order-history">
        <div class="reservation-history">
            <h2>Reservation History</h2>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Number of Guests</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody id="reservation-list">
                    <!-- Reservation details will be inserted here -->
                </tbody>
            </table>
        </div>

        <!-- Order History Section -->
        <div class="order-link">
            <a href="menu.php">food order history</a>
        <div class="order-history">
            
            <h2>Order History</h2>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Category</th>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="order-list">
                    <!-- Order details will be inserted here -->
                </tbody>
            </table>
        </div>
    </div>

    

    <!-- JavaScript to handle reservation and order history -->
    <script>
        // Sample reservations data
        const reservations = [
            { date: '2024-07-20', time: '19:00', guests: 2, details: 'Table by the window' },
            { date: '2024-07-22', time: '13:00', guests: 4, details: 'Near the bar area' },
        ];

        const reservationList = document.getElementById('reservation-list');

        reservations.forEach(reservation => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${reservation.date}</td>
                <td>${reservation.time}</td>
                <td>${reservation.guests}</td>
                <td>${reservation.details}</td>
            `;
            reservationList.appendChild(row);
        });

        // Sample orders data
        const orders = [
            { date: '2024-07-18', category: 'Lunch', item: 'Caesar Salad', quantity: 1, status: 'Delivered' },
            { date: '2024-07-20', category: 'Dinner', item: 'Margherita Pizza', quantity: 2, status: 'Preparing' },
        ];

        const orderList = document.getElementById('order-list');

        orders.forEach(order => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${order.date}</td>
                <td>${order.category}</td>
                <td>${order.item}</td>
                <td>${order.quantity}</td>
                <td>${order.status}</td>
            `;
            orderList.appendChild(row);
        });
    </script>
</body>
</html>
