<?php
include 'connection.php';

// Handle form submission for placing a new order
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['id'])) {
    $order_date = mysqli_real_escape_string($conn, $_POST['order-date']);
    $order_time = mysqli_real_escape_string($conn, $_POST['order-time']);
    $customer_name = mysqli_real_escape_string($conn, $_POST['order-name']);
    $order_items = mysqli_real_escape_string($conn, $_POST['order-items']);

    $query = "INSERT INTO adminorders (order_date, order_time, customer_name, order_items, order_status) 
              VALUES ('$order_date', '$order_time', '$customer_name', '$order_items', 'new')";

    if (mysqli_query($conn, $query)) {
        header("Location: admin-preorder.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Handle form submission for updating an order
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $order_date = mysqli_real_escape_string($conn, $_POST['order-date']);
    $order_time = mysqli_real_escape_string($conn, $_POST['order-time']);
    $customer_name = mysqli_real_escape_string($conn, $_POST['order-name']);
    $order_items = mysqli_real_escape_string($conn, $_POST['order-items']);

    $query = "UPDATE adminorders SET order_date='$order_date', order_time='$order_time', customer_name='$customer_name', order_items='$order_items' WHERE id=$id";
    if (mysqli_query($conn, $query)) {
        header("Location: admin-preorder.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Handle delete action
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $query = "DELETE FROM adminorders WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        header("Location: reservation-management.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Fetch orders from the database
$query = "SELECT * FROM adminorders";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Basic reset and layout */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f4f4;
            padding: 20px;
            background: url('admin1.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        section#orders {
            max-width: 1200px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        header {
            background-color: #070400;
            color: white;
            padding: 10px 0;
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 15px;
        }

        nav a {
            color: #d4a373;
            text-decoration: none;
            font-size: 18px;
            padding: 14px 20px;
            display: inline-block;
            transition: background-color 0.3s, color 0.3s;
        }

        nav a:hover {
            background-color: #e8d9ce;
            color: #070400;
        }

        .search-container {
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="date"],
        input[type="time"],
        textarea {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        textarea {
            resize: vertical;
        }

        button {
            background-color: #d4a373;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #b38b5f;
        }

        select {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f4f4f4;
        }

        table td.actions {
            text-align: center;
        }

        table td button.edit-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            margin-right: 5px;
        }

        table td button.edit-button:hover {
            background-color: #45a049;
        }

        table td a.delete-button {
            background-color: #f44336;
            color: white;
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        table td a.delete-button:hover {
            background-color: #e53935;
        }

        form {
            margin-top: 20px;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 8px;
        }

        .modal-header, .modal-body, .modal-footer {
            padding: 10px;
        }

        .modal-header {
            border-bottom: 1px solid #ddd;
        }

        .modal-footer {
            border-top: 1px solid #ddd;
            text-align: right;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-button {
            background-color: #d4a373;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
        }

        .modal-button:hover {
            background-color: #b38b5f;
        }

        .modal-button.cancel {
            background-color: #f44336;
        }

        .modal-button.cancel:hover {
            background-color: #e53935;
        }

        .modal-button.confirm {
            background-color: #4CAF50;
        }

        .modal-button.confirm:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <h1>The Gallery Café | Pre-order Management System</h1>
    </header>
    <nav>
        <ul>
            <li><a href="staff.php">Staff Dashboard</a></li>
            <!-- Add more navigation items as needed -->
        </ul>
    </nav>
    
    <section id="orders">
        <h2>Pre-orders</h2>
        <div class="search-container">
            <input type="text" placeholder="Search Orders" id="order-search">
            <select id="order-filter">
                <option value="">All</option>
                <option value="new">New</option>
                <option value="confirmed">Confirmed</option>
                <option value="modified">Modified</option>
                <option value="canceled">Canceled</option>
            </select>
        </div>
        <table id="order-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Customer Name</th>
                    <th>Items</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['order_date']); ?></td>
                    <td><?php echo htmlspecialchars($row['order_time']); ?></td>
                    <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['order_items']); ?></td>
                    <td><?php echo htmlspecialchars($row['order_status']); ?></td>
                    <td class="actions">
                        <button class="edit-button" data-id="<?php echo $row['id']; ?>">Edit</button>
                        <a href="?delete=<?php echo $row['id']; ?>" class="delete-button" onclick="return confirm('Are you sure you want to delete this order?');">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <h2>Place an Order</h2>
        <form id="order-form" method="post" action="">
    <label for="order-date">Date:</label>
    <input type="date" id="order-date" name="order-date" required>

    <label for="order-time">Time:</label>
    <input type="time" id="order-time" name="order-time" required>

    <label for="order-name">Name:</label>
    <input type="text" id="order-name" name="order-name" required>

    <label for="order-items">Items:</label>
    <textarea id="order-items" name="order-items" rows="3" required></textarea>

    <button type="submit">Submit Order</button>
</form>

    </section>

    <!-- Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
                <h2>Edit Order</h2>
            </div>
            <div class="modal-body">
                <form id="edit-form" method="post">
                    <input type="hidden" id="edit-id" name="id">
                    <label for="edit-order-date">Date:</label>
                    <input type="date" id="edit-order-date" name="order-date" required>
                    
                    <label for="edit-order-time">Time:</label>
                    <input type="time" id="edit-order-time" name="order-time" required>
                    
                    <label for="edit-order-name">Name:</label>
                    <input type="text" id="edit-order-name" name="order-name" required>
                    
                    <label for="edit-order-items">Items:</label>
                    <textarea id="edit-order-items" name="order-items" rows="3" required></textarea>
                    
                    <button type="submit" class="modal-button confirm">Update Order</button>
                    <button type="button" class="modal-button cancel" id="modal-cancel">Cancel</button>
                </form>
            </div>
        </div>
    </div>

    <script>
       document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('editModal');
    var closeModal = document.querySelector('.close');
    var editButtons = document.querySelectorAll('.edit-button');
    var cancelModal = document.getElementById('modal-cancel');

    editButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var orderId = this.getAttribute('data-id');
            fetch('get_order.php?id=' + orderId)
                .then(response => response.json())
                .then(order => {
                    console.log(order); // Debugging: Check the returned order data
                    if (order.error) {
                        alert(order.error);
                    } else {
                        document.getElementById('edit-id').value = order.id;
                        document.getElementById('edit-order-date').value = order.order_date;
                        document.getElementById('edit-order-time').value = order.order_time;
                        document.getElementById('edit-order-name').value = order.customer_name;
                        document.getElementById('edit-order-items').value = order.order_items;
                        modal.style.display = 'block';
                    }
                })
                .catch(error => console.error('Error fetching order:', error)); // Debugging: Catch and log any errors
        });
    });

    closeModal.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    cancelModal.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    };
});

    </script>
</body>
</html>
