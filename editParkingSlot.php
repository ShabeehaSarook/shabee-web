<?php
include 'connection.php';

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
            header('Location: parking-admin management.php');
            exit();
        } else {
            echo "<p>Error: " . $stmt->error . "</p>";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}

// Retrieve parking slot data for editing
$id = $_GET['id'];
$sql = "SELECT * FROM parking_slots WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$slot = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Parking Slot</title>
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

        .container {
            width: 50%;
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        h2 {
            color: #0e0701;
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Parking Slot</h2>
        <form method="post" action="">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($slot['id']); ?>">
            <input type="text" name="slot_id" value="<?php echo htmlspecialchars($slot['slot_id']); ?>" required>
            <select name="status" required>
                <option value="Empty" <?php echo $slot['status'] == 'Empty' ? 'selected' : ''; ?>>Empty</option>
                <option value="Occupied" <?php echo $slot['status'] == 'Occupied' ? 'selected' : ''; ?>>Occupied</option>
            </select>
            <select name="type" required>
                <option value="Car" <?php echo $slot['type'] == 'Car' ? 'selected' : ''; ?>>Car</option>
                <option value="Bike" <?php echo $slot['type'] == 'Bike' ? 'selected' : ''; ?>>Bike</option>
                <option value="Truck" <?php echo $slot['type'] == 'Truck' ? 'selected' : ''; ?>>Truck</option>
            </select>
            <button type="submit" class="confirm-btn">Update Slot</button>
        </form>
    </div>
</body>
</html>
