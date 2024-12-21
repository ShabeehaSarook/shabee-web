<?php   include 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - The Gallery Café</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        header {
            background-color: #333;
            color: #d4a373;
            padding: 15px 0;
            text-align: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        header nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        header nav ul li {
            display: inline;
            margin: 0 15px;
        }
        header nav ul li a {
            color: #d4a373;
            text-decoration: none;
            padding: 5px 10px;
            transition: color 0.3s, border-bottom 0.3s;
            font-weight: bold;
        }
        header nav ul li a:hover, header nav ul li a.active {
            color: #fff;
            border-bottom: 2px solid #d4a373;
        }
        main {
            padding: 20px;
            max-width: 1200px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            color: #d4a373;
        }
        .admin-actions {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }
        .admin-actions button {
            background-color: #d4a373;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, box-shadow 0.3s;
            font-size: 16px;
        }
        .admin-actions button:hover {
            background-color: #bfa06a;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .btn-edit, .btn-delete {
            background-color: #d4a373;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        .btn-edit:hover, .btn-delete:hover {
            background-color: #bfa06a;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        .btn-delete {
            background-color: #e74c3c;
        }
        .btn-delete:hover {
            background-color: #c0392b;
        }
        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .popup-content {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            max-width: 500px;
            position: relative;
        }
        .popup-content button.close {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #e74c3c;
            color: #fff;
            border: none;
            border-radius: 50%;
            padding: 10px;
            cursor: pointer;
        }
        .popup-content button.close:hover {
            background: #c0392b;
        }
        .popup-content input, .popup-content select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="menu.php">Menu</a></li>
                <li><a href="admin-dashboard.php" class="active">Admin Dashboard</a></li>
                <li><a href="login.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>food order information</h1>
        <div class="admin-actions">
            <button onclick="openPopup('add')">Add Menu Item</button>
            <button onclick="openPopup('edit')">Edit Menu Item</button>
            <button onclick="openPopup('delete')">Delete Menu Item</button>
            <button onclick="openPopup('promotions')">Manage Promotions</button>
        </div>

        <h2>Menu Items</h2>
        <table id="menu-table">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="menu-table-body">
                <!-- Menu items will be dynamically added here -->
            </tbody>
        </table>

        <h2>Promotion Orders</h2>
        <table id="promotion-table">
            <thead>
                <tr>
                    <th>Order Date</th>
                    <th>Item Name</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody id="promotion-table-body">
                <!-- Promotion orders will be dynamically added here -->
            </tbody>
        </table>

        <!-- Add/Edit/Delete Popup -->
        <div id="popup-add" class="popup">
            <div class="popup-content">
                <button class="close" onclick="closePopup('add')">&times;</button>
                <h2>Add Menu Item</h2>
                <form id="add-form">
                    <input type="text" id="item-name" placeholder="Item Name" required>
                    <input type="text" id="item-description" placeholder="Description" required>
                    <input type="number" id="item-price" placeholder="Price" required>
                    <button type="submit">Add Item</button>
                </form>
            </div>
        </div>

        <div id="popup-edit" class="popup">
            <div class="popup-content">
                <button class="close" onclick="closePopup('edit')">&times;</button>
                <h2>Edit Menu Item</h2>
                <form id="edit-form">
                    <select id="edit-item-select" required>
                        <option value="">Select Item</option>
                        <!-- Options will be dynamically added here -->
                    </select>
                    <input type="text" id="edit-item-name" placeholder="New Item Name" required>
                    <input type="text" id="edit-item-description" placeholder="New Description" required>
                    <input type="number" id="edit-item-price" placeholder="New Price" required>
                    <button type="submit">Update Item</button>
                </form>
            </div>
        </div>

        <div id="popup-delete" class="popup">
            <div class="popup-content">
                <button class="close" onclick="closePopup('delete')">&times;</button>
                <h2>Delete Menu Item</h2>
                <form id="delete-form">
                    <select id="delete-item-select" required>
                        <option value="">Select Item</option>
                        <!-- Options will be dynamically added here -->
                    </select>
                    <button type="submit">Delete Item</button>
                </form>
            </div>
        </div>

        <div id="popup-promotions" class="popup">
            <div class="popup-content">
                <button class="close" onclick="closePopup('promotions')">&times;</button>
                <h2>Manage Promotions</h2>
                <form id="promotions-form">
                    <input type="text" id="promotion-name" placeholder="Promotion Name" required>
                    <input type="text" id="promotion-details" placeholder="Promotion Details" required>
                    <input type="number" id="promotion-discount" placeholder="Discount Percentage" required>
                    <button type="submit">Add Promotion</button>
                </form>
            </div>
        </div>

    </main>

    <script>
        // Sample data for menu items
        const menuItems = [
            { id: 1, name: "Spaghetti Carbonara", description: "Creamy pasta with pancetta.", price: 12.99 },
            { id: 2, name: "Margherita Pizza", description: "Classic pizza with tomatoes and mozzarella.", price: 10.99 }
        ];

        // Sample data for promotions
        const promotionOrders = [
            { orderDate: "2024-08-01", itemName: "beverage", customerName: "shabeeha", email: "shabeehazarook@gmail.com", phone: "1234567890", quantity: 2 },
            { orderDate: "2024-08-02", itemName: "cake item", customerName: "shaliha", email: "shalihazarook@gmail.com", phone: "0987654321", quantity: 1 }
        ];

        // Function to display menu items in the table
        function displayMenuItems() {
            const tableBody = document.getElementById('menu-table-body');
            tableBody.innerHTML = ''; // Clear existing rows

            menuItems.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.name}</td>
                    <td>${item.description}</td>
                    <td>$${item.price.toFixed(2)}</td>
                    <td>
                        <button class="btn-edit" onclick="openEditPopup(${item.id})">Edit</button>
                        <button class="btn-delete" onclick="deleteMenuItem(${item.id})">Delete</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }

        // Function to display promotion orders in the table
        function displayPromotionOrders() {
            const tableBody = document.getElementById('promotion-table-body');
            tableBody.innerHTML = ''; // Clear existing rows

            promotionOrders.forEach(order => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${order.orderDate}</td>
                    <td>${order.itemName}</td>
                    <td>${order.customerName}</td>
                    <td>${order.email}</td>
                    <td>${order.phone}</td>
                    <td>${order.quantity}</td>
                `;
                tableBody.appendChild(row);
            });
        }

        // Popup management
        function openPopup(popupId) {
            document.getElementById(`popup-${popupId}`).style.display = 'flex';
        }

        function closePopup(popupId) {
            document.getElementById(`popup-${popupId}`).style.display = 'none';
        }

        // Initial function calls
        displayMenuItems();
        displayPromotionOrders();
    </script>
</body>
</html>
