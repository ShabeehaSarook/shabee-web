<?php
include 'connection.php';
// Database connection
$host = "localhost";
$username = "root";
$password = "";
$dbname = "cafe";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission for adding and editing promotions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['action'] == 'add') {
        $title = $_POST['promotionTitle'];
        $description = $_POST['promotionDescription'];
        $image = $_FILES['promotionImage']['name'];
        
        // Move uploaded file to the server
        $target = "uploads/" . basename($image);
        move_uploaded_file($_FILES['promotionImage']['tmp_name'], $target);

        // Insert into database
        $sql = "INSERT INTO promotions (title, description, image) VALUES ('$title', '$description', '$image')";
        if ($conn->query($sql) === TRUE) {
            echo "New promotion added successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    } elseif ($_POST['action'] == 'edit') {
        $id = $_POST['editPromotionId'];
        $title = $_POST['editPromotionTitle'];
        $description = $_POST['editPromotionDescription'];
        
        // Check if a new image was uploaded
        if (!empty($_FILES['editPromotionImage']['name'])) {
            $image = $_FILES['editPromotionImage']['name'];
            $target = "uploads/" . basename($image);
            move_uploaded_file($_FILES['editPromotionImage']['tmp_name'], $target);
            $sql = "UPDATE promotions SET title='$title', description='$description', image='$image' WHERE id='$id'";
        } else {
            $sql = "UPDATE promotions SET title='$title', description='$description' WHERE id='$id'";
        }

        if ($conn->query($sql) === TRUE) {
            echo "Promotion updated successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Handle deletion
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];
    $sql = "DELETE FROM promotions WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Promotion deleted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch promotions from the database
$sql = "SELECT * FROM promotions";
$result = $conn->query($sql);
$promotions = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $promotions[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Promotions</title>
    <style>
        /* Basic styles for layout */
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            background: url('admin dash1.avif') no-repeat center center fixed;
            background-size: cover;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        nav ul {
            list-style: none;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 10px;
        }

        nav ul li a {
            text-decoration: none;
            color: #333;
            background-color: #d4a373;
            padding: 10px 15px;
            border-radius: 5px;
        }

        main {
            padding: 20px;
            background-color: #ffffffa6;
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
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            max-width: 100px;
            height: auto;
        }

        /* Modal Styles */
        .modal {
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

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #ddd;
            width: 80%;
            max-width: 600px;
            border-radius: 5px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .close-modal {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close-modal:hover,
        .close-modal:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<header>
    <h1>Promotions Management - The Gallery Café</h1>
</header>

<nav>
    <ul>
        <li><a href="admin-dashboard.php">Admin Dashboard</a></li>
        <li><a href="manage-promotions.php">Manage Promotions</a></li>
    </ul>
</nav>

<main>
    <section class="promotions">
        <h2>Current Promotions</h2>
        <?php if ($promotions): ?>
            <table class="promotions-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($promotions as $promotion): ?>
                        <tr>
                            <td><?= htmlspecialchars($promotion['title']) ?></td>
                            <td><?= htmlspecialchars($promotion['description']) ?></td>
                            <td><img src="uploads/<?= htmlspecialchars($promotion['image']) ?>" alt="Promotion Image"></td>
                            <td>
                                <button class="edit-promotion-btn" data-id="<?= $promotion['id'] ?>" data-title="<?= htmlspecialchars($promotion['title']) ?>" data-description="<?= htmlspecialchars($promotion['description']) ?>">Edit</button>
                                <a href="manage-promotion.php?action=delete&id=<?= $promotion['id'] ?>"><button>Delete</button></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No promotions found.</p>
        <?php endif; ?>
    </section>

    <section class="admin-section">
        <h2>Add New Promotion</h2>
        <form class="admin-form" action="manage-promotion.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="add">
            <input type="text" name="promotionTitle" placeholder="Promotion Title" required>
            <textarea name="promotionDescription" placeholder="Promotion Description" required></textarea>
            <input type="file" name="promotionImage" required>
            <button type="submit">Add Promotion</button>
        </form>
    </section>

    <!-- Modal for Editing Promotion -->
    <div id="editPromotionModal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h2>Edit Promotion</h2>
            <form class="admin-form" action="manage-promotion.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="editPromotionId" id="editPromotionId">
                <input type="text" name="editPromotionTitle" id="editPromotionTitle" placeholder="Promotion Title" required>
                <textarea name="editPromotionDescription" id="editPromotionDescription" placeholder="Promotion Description" required></textarea>
                <input type="file" name="editPromotionImage">
                <button type="submit">Update Promotion</button>
            </form>
        </div>
    </div>
</main>

<footer>
    <p>&copy; 2024 The Gallery Café</p>
</footer>

<script>
    // Handle Edit Promotion button click
    document.querySelectorAll('.edit-promotion-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            const title = this.dataset.title;
            const description = this.dataset.description;

            document.getElementById('editPromotionId').value = id;
            document.getElementById('editPromotionTitle').value = title;
            document.getElementById('editPromotionDescription').value = description;

            document.getElementById('editPromotionModal').style.display = 'block';
        });
    });

    // Handle modal close
    document.querySelector('.close-modal').addEventListener('click', function() {
        document.getElementById('editPromotionModal').style.display = 'none';
    });

    // Close modal when clicking outside the modal
    window.onclick = function(event) {
        const modal = document.getElementById('editPromotionModal');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    };
</script>

</body>
</html>
