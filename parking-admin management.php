<?php
include 'connection.php';

// Handle the form submission for adding a new parking slot
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'add') {
    // Retrieve form data
    $slot_id = $_POST['slot_id'];
    $status = $_POST['status'];
    $type = $_POST['type'];

    // Prepare the SQL query
    $sql = "INSERT INTO parking_slots (slot_id, status, type) VALUES (?, ?, ?)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters to the query
        $stmt->bind_param('sss', $slot_id, $status, $type);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<p>New parking slot added successfully!</p>";
        } else {
            echo "<p>Error: " . $stmt->error . "</p>";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}

// Handle the form submission for editing a parking slot
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'edit') {
    // Retrieve form data
    $id = $_POST['id'];
    $slot_id = $_POST['slot_id'];
    $status = $_POST['status'];
    $type = $_POST['type'];

    // Prepare the SQL query
    $sql = "UPDATE parking_slots SET slot_id = ?, status = ?, type = ? WHERE id = ?";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters to the query
        $stmt->bind_param('sssi', $slot_id, $status, $type, $id);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<p>Parking slot updated successfully!</p>";
        } else {
            echo "<p>Error: " . $stmt->error . "</p>";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}

// Handle the deletion of a parking slot
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];

    // Prepare the SQL query
    $sql = "DELETE FROM parking_slots WHERE id = ?";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters to the query
        $stmt->bind_param('i', $id);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<p>Parking slot deleted successfully!</p>";
        } else {
            echo "<p>Error: " . $stmt->error . "</p>";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}

// Retrieve parking slots from the database
$slots_result = $conn->query("SELECT * FROM parking_slots");

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parking Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('admin1.jpg');
            background-size: cover;
            background-attachment: fixed;
            color: #333;
        }

        header {
            background-color: #070400;
            color: white;
            padding: 10px 0;
            text-align: center;
        }

        header h1 {
            margin: 0;
            font-size: 2em;
        }

        nav {
            background-color: #0e0701;
            overflow: hidden;
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

        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        h2 {
            color: #0e0701;
        }

        .form-section {
            margin-bottom: 20px;
        }

        input[type="text"], select {
            margin-bottom: 10px;
            width: calc(100% - 16px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        .confirm-btn {
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            border-radius: 3px;
            transition: background-color 0.3s;
        }

        .confirm-btn:hover {
            background-color: #218838;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #070400;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .action-btns {
            display: flex;
            gap: 5px;
        }

        .edit-btn, .delete-btn {
            border: none;
            color: white;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
            font-size: 14px;
        }

        .edit-btn {
            background-color: #007bff;
        }

        .edit-btn:hover {
            background-color: #0056b3;
        }

        .delete-btn {
            background-color: #dc3545;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <header>
        <h1>The Gallery Café | Parking Management System</h1>
    </header>
    <nav>
        <a href="admin-dashboard.php">staff Dashboard</a>
    </nav>
    <div class="container">
        <h2>Add New Parking Slot</h2>
        <div class="form-section">
            <form method="post" action="">
                <input type="hidden" name="action" value="add">
                <input type="text" name="slot_id" placeholder="Slot ID" required>
                <select name="status" required>
                    <option value="Empty">Empty</option>
                    <option value="Occupied">Occupied</option>
                </select>
                <select name="type" required>
                    <option value="Car">Car</option>
                    <option value="Bike">Bike</option>
                    <option value="Truck">Truck</option>
                </select>
                <button type="submit" class="confirm-btn">Add Slot</button>
            </form>
        </div>

        <h2>Existing Parking Slots</h2>
        <table>
            <tr>
                <th>Slot ID</th>
                <th>Status</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
            <?php while($row = $slots_result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['slot_id']); ?></td>
                <td><?php echo htmlspecialchars($row['status']); ?></td>
                <td><?php echo htmlspecialchars($row['type']); ?></td>
                <td class="action-btns">
                    <a href="editParkingSlot.php?id=<?php echo $row['id']; ?>" class="edit-btn">Edit</a>
                    <a href="?action=delete&id=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this slot?')">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
