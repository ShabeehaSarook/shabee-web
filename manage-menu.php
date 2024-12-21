<?php
include 'connection.php';

// Handle form submission for adding a new menu item
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    // Handle the image upload
    $image = $_FILES['image']['name'];
    $target = "uploads/" . basename($image);

    // Prepare and bind parameters
    $stmt = $conn->prepare("INSERT INTO menu_items (name, price, category, image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdss", $name, $price, $category, $image);

    // Execute the statement
    if ($stmt->execute()) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $message = 'Menu item added successfully!';
        } else {
            $message = 'Failed to upload image.';
        }
    } else {
        $message = 'Failed to add menu item.';
    }

    $stmt->close();
}

// Handle deletion of a menu item
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);

    // Prepare and execute delete statement
    $stmt = $conn->prepare("DELETE FROM menu_items WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $message = 'Menu item deleted successfully!';
    } else {
        $message = 'Failed to delete menu item.';
    }

    $stmt->close();
}

// Handle editing of a menu item
if (isset($_POST['edit'])) {
    $id = intval($_POST['id']);
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    if ($_FILES['image']['name']) {
        // Handle the image upload
        $image = $_FILES['image']['name'];
        $target = "uploads/" . basename($image);
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $imageQuery = ", images = ?";
            $imageParam = $image;
        } else {
            $message = 'Failed to upload image.';
            $imageQuery = '';
            $imageParam = '';
        }
    } else {
        $imageQuery = '';
        $imageParam = '';
    }

    // Prepare and bind parameters
    $stmt = $conn->prepare("UPDATE menu_items SET name = ?, price = ?, category = ? $imageQuery WHERE id = ?");
    if ($imageQuery) {
        $stmt->bind_param("sdssi", $name, $price, $category, $imageParam, $id);
    } else {
        $stmt->bind_param("sdsi", $name, $price, $category, $id);
    }

    // Execute the statement
    if ($stmt->execute()) {
        $message = 'Menu item updated successfully!';
    } else {
        $message = 'Failed to update menu item.';
    }

    $stmt->close();
}

// Fetch menu items from the database
$query = "SELECT * FROM menu_items";
$result = $conn->query($query);

// Check for query errors
if (!$result) {
    die("Query failed: " . $conn->error);
}

$menuItems = $result->fetch_all(MYSQLI_ASSOC);
$result->free();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Menu Management - The Gallery Café</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background: url('admin1.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #d4a373;
            background-color: rgba(0, 0, 0, 0.5);
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        header {
            background-color: rgba(0, 0, 0, 0.7);
            color: #d4a373;
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
            max-width: 900px;
            margin: 20px auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            animation: slideIn 1s ease-in-out;
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

        /* Admin Form Styles */
        .admin-form {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        .admin-form h2 {
            color: #333;
            margin-bottom: 20px;
        }
        .admin-form label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
        .admin-form input, .admin-form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }
        .admin-form button {
            background-color: #d4a373;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .admin-form button:hover {
            background-color: #bfa06a;
        }

        /* Menu Table Styles */
        .menu-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .menu-table th, .menu-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        .menu-table th {
            background-color: #d4a373;
            color: #fff;
        }
        .menu-table img {
            max-width: 100px;
            height: auto;
        }
        .menu-table button {
            background-color: #d4a373;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .menu-table button:hover {
            background-color: #bfa06a;
        }

        /* Popup Styles */
        .popup {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .popup-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border-radius: 5px;
            width: 80%;
            max-width: 600px;
        }

        .popup .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .popup .close:hover,
        .popup .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="admin-dashboard.php">Home</a></li>
                <li><a href="manage-menu.php">Manage Menu</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Admin Menu Management</h1>

        <?php if (isset($message)) echo "<p>$message</p>"; ?>

        <!-- Add Menu Item Form -->
        <div class="admin-form">
            <h2>Add New Menu Item</h2>
            <form method="post" enctype="multipart/form-data">
                <label for="name">Menu Item Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="price">Price:</label>
                <input type="text" id="price" name="price" required>

                <label for="category">Category:</label>
                <select id="category" name="category" required>
                    <option value="Cake Items">Cake item</option>
                    <option value="Hot Drink ">Hot drink</option>
                    <option value="Dessert">Dessert</option>
                    <option value="Dinner">Dinner</option>
                </select>

                <label for="image">Image:</label>
                <input type="file" id="image" name="image" accept="image/*">

                <button type="submit" name="add">Add Menu Item</button>
            </form>
        </div>

        <!-- Menu Table -->
        <table class="menu-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($menuItems as $item): ?>
                <tr>
                    <td><?php echo $item['id']; ?></td>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                    <td><?php echo htmlspecialchars($item['price']); ?></td>
                    <td><?php echo htmlspecialchars($item['category']); ?></td>
                    <td><img src="uploads/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>"></td>
                    <td>
                        <a href="#" class="edit-btn" 
                           data-id="<?php echo $item['id']; ?>" 
                           data-name="<?php echo htmlspecialchars($item['name']); ?>" 
                           data-price="<?php echo htmlspecialchars($item['price']); ?>" 
                           data-category="<?php echo htmlspecialchars($item['category']); ?>" 
                           data-image="<?php echo htmlspecialchars($item['image']); ?>">
                            <button>Edit</button>
                        </a>
                        <a href="?delete=<?php echo $item['id']; ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                            <button>Delete</button>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Edit Menu Item Popup Form -->
        <div id="editPopup" class="popup">
            <div class="popup-content">
                <span class="close">&times;</span>
                <h2>Edit Menu Item</h2>
                <form id="editForm" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="editId" name="id">
                    <label for="editName">Menu Item Name:</label>
                    <input type="text" id="editName" name="name" required>

                    <label for="editPrice">Price:</label>
                    <input type="text" id="editPrice" name="price" required>

                    <label for="editCategory">Category:</label>
                    <select id="editCategory" name="category" required>
                        <option value="starter">Cake item</option>
                        <option value="main">Hot drink</option>
                        <option value="dessert">Dessert</option>
                        <option value="beverage">dinner</option>
                    </select>

                    <label for="editImage">Image:</label>
                    <input type="file" id="editImage" name="image" accept="image/*">

                    <button type="submit" name="edit">Update Menu Item</button>
                </form>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 The Gallery Café</p>
    </footer>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var popup = document.getElementById('editPopup');
        var closeBtn = document.querySelector('.popup .close');

        document.querySelectorAll('a.edit-btn').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                var id = this.getAttribute('data-id');
                var name = this.getAttribute('data-name');
                var price = this.getAttribute('data-price');
                var category = this.getAttribute('data-category');
                var image = this.getAttribute('data-image');

                document.getElementById('editId').value = id;
                document.getElementById('editName').value = name;
                document.getElementById('editPrice').value = price;
                document.getElementById('editCategory').value = category;

                popup.style.display = 'block';
            });
        });

        closeBtn.addEventListener('click', function() {
            popup.style.display = 'none';
        });

        window.addEventListener('click', function(e) {
            if (e.target === popup) {
                popup.style.display = 'none';
            }
        });
    });
    </script>
</body>
</html>
