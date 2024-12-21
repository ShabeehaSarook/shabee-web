<?php   include 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard - The Gallery Café</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Basic reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        header {
            background: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        nav ul {
            list-style: none;
            padding: 0;
            text-align: center;
        }

        nav ul li {
            display: inline;
            margin: 0 15px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s;
        }

        nav ul li a.active, nav ul li a:hover {
            color: #d4a373;
        }

        section {
            background: #fff;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h2 {
            margin-bottom: 20px;
        }

        .dashboard-section {
            margin-bottom: 30px;
        }

        .dashboard-section h3 {
            margin-bottom: 15px;
            color: #333;
        }

        .dashboard-section p {
            margin-bottom: 10px;
        }

        .dashboard-section button {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 1rem;
            transition: background-color 0.3s, transform 0.3s;
            margin-right: 10px;
        }

        .dashboard-section button:hover {
            background-color: #555;
            transform: translateY(-2px);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 1rem;
        }

        table thead tr {
            background-color: #333;
            color: #fff;
        }

        table th, table td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tbody tr:hover {
            background-color: #ddd;
        }

        footer {
            text-align: center;
            margin-top: 20px;
        }

        .edit-profile-btn {
            background-color: #4caf50;
        }

        .edit-profile-btn:hover {
            background-color: #45a049;
        }

        .new-reservation-btn, .new-order-btn {
            background-color: #007bff;
        }

        .new-reservation-btn:hover, .new-order-btn:hover {
            background-color: #0056b3;
        }

        .notification {
            background-color: #e7f4e4;
            border-left: 6px solid #4caf50;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .notification p {
            margin: 0;
            color: #333;
        }

        .admin-link {
            display: inline-block;
            background-color: #d4a373;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 1rem;
            text-decoration: none;
            margin-top: 20px;
        }

        .admin-link:hover {
            background-color: #c88f5e;
        }
    </style>
</head>
<body>
    <header>
        <h1>Customer Dashboard</h1>
        <nav>
            <ul>
                <li><a href="customer-dashboard.php" class="active">Customer Dashboard</a></li>
                <li><a href="make-reservation.php">Make a Reservation</a></li>
                <li><a href="order.php">Order Food</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
                <!-- Admin Dashboard Link -->
                <li><a href="admin-dashboard.php" class="admin-link">Admin Dashboard</a></li>
            </ul>
        </nav>
    </header>
    <section>
        <div class="notification">
            <p>Welcome, <span id="customerName">[Customer Name]</span>! You have <span id="upcomingReservationsCount">0</span> upcoming reservations and <span id="pendingOrdersCount">0</span> pending orders.</p>
        </div>

        <h2>Dashboard</h2>
        <p>Here you can manage your reservations, view your order history, and update your profile information.</p>

        <div class="dashboard-section">
            <h3>Profile</h3>
            <button class="edit-profile-btn" onclick="editProfile()">Edit Profile</button>
        </div>

        <div class="dashboard-section">
            <h3>Upcoming Reservations</h3>
            <table id="reservationsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Table</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Reservations rows will be dynamically inserted here -->
                </tbody>
            </table>
            <button id="refreshReservationsBtn" onclick="loadReservations()">Refresh Reservations</button>
            <button class="new-reservation-btn" onclick="makeNewReservation()">New Reservation</button>
        </div>

        <div class="dashboard-section">
            <h3>Order History</h3>
            <table id="ordersTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Order Details</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Orders rows will be dynamically inserted here -->
                </tbody>
            </table>
            <button id="refreshOrdersBtn" onclick="loadOrders()">Refresh Orders</button>
            <button class="new-order-btn" onclick="makeNewOrder()">New Order</button>
        </div>
    </section>
    <footer>
        <p>&copy; 2024 The Gallery Café. All rights reserved.</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Example data
            const reservations = [
                { id: 1, date: '2024-07-25', time: '18:00', table: 5, status: 'Confirmed' },
                { id: 2, date: '2024-07-26', time: '19:00', table: 3, status: 'Pending' }
            ];

            const orders = [
                { id: 1, date: '2024-07-20', details: '2x Burger, 1x Fries', total: '$20', status: 'Completed' },
                { id: 2, date: '2024-07-21', details: '1x Salad, 1x Water', total: '$15', status: 'Pending' }
            ];

            const reservationsTable = document.getElementById('reservationsTable').getElementsByTagName('tbody')[0];
            const ordersTable = document.getElementById('ordersTable').getElementsByTagName('tbody')[0];

            function loadReservations() {
                reservationsTable.innerHTML = '';
                reservations.forEach(reservation => {
                    const row = reservationsTable.insertRow();
                    row.insertCell(0).textContent = reservation.id;
                    row.insertCell(1).textContent = reservation.date;
                    row.insertCell(2).textContent = reservation.time;
                    row.insertCell(3).textContent = reservation.table;
                    row.insertCell(4).textContent = reservation.status;
                });
                document.getElementById('upcomingReservationsCount').textContent = reservations.length;
            }

            function loadOrders() {
                ordersTable.innerHTML = '';
                orders.forEach(order => {
                    const row = ordersTable.insertRow();
                    row.insertCell(0).textContent = order.id;
                    row.insertCell(1).textContent = order.date;
                    row.insertCell(2).textContent = order.details;
                    row.insertCell(3).textContent = order.total;
                    row.insertCell(4).textContent = order.status;
                });
                document.getElementById('pendingOrdersCount').textContent = orders.length;
            }

            window.loadReservations = loadReservations;
            window.loadOrders = loadOrders;

            // Initial load
            loadReservations();
            loadOrders();
        });

        function editProfile() {
            alert('Edit profile functionality');
        }

        function makeNewReservation() {
            alert('New reservation functionality');
        }

        function makeNewOrder() {
            alert('New order functionality');
        }
    </script>
</body>
</html>
