<?php
session_start();
include 'connection.php'; // DB connection

// Check if the user is an admin
if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'admin') {
    // Admin can manage users
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Collect form data
        $action = $_POST['action'] ?? ''; // Determine if it's an edit, delete, or create action
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $userType = $_POST['userType'] ?? '';

        // Validate inputs
        if (empty($username) || empty($email) || empty($userType)) {
            echo json_encode(['success' => false, 'message' => 'All fields are required.']);
            exit;
        }

        // Action handlers
        if ($action == 'create') {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO users (username, email, password, userType) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssss', $username, $email, $hashedPassword, $userType);

            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'User created successfully!']);
            } else {
                echo json_encode(['success' => false, 'message' => $stmt->error]);
            }
        } elseif ($action == 'edit') {
            // Handle user editing
            $sql = "UPDATE users SET username=?, email=?, userType=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sssi', $username, $email, $userType, $_POST['id']);
            
            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'User updated successfully!']);
            } else {
                echo json_encode(['success' => false, 'message' => $stmt->error]);
            }
        } elseif ($action == 'delete') {
            // Handle user deletion
            $sql = "DELETE FROM users WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $_POST['id']);

            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'User deleted successfully!']);
            } else {
                echo json_encode(['success' => false, 'message' => $stmt->error]);
            }
        }

        $stmt->close();
        $conn->close();
    }
} else {
    // Redirect if not admin
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - The Gallery Café</title>
    <style>
        /* Add your styles here */
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }
        .dashboard-box {
            padding: 20px;
            margin: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #d4a373;
            color: white;
        }
        button {
            padding: 8px 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="dashboard-box">
        <h1>Admin Dashboard</h1>

        <h2>User Management</h2>
        <button onclick="showCreateUserForm()">Create New User</button>

        <table id="usersTable">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>User Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- User list will be loaded here via JavaScript -->
            </tbody>
        </table>

        <div id="createUserForm" style="display: none;">
            <h3>Create User</h3>
            <form id="userForm" method="POST">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required><br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br>
                <label for="userType">User Type:</label>
                <select id="userType" name="userType" required>
                    <option value="customer">Customer</option>
                    <option value="admin">Admin</option>
                </select><br>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

    <script>
        function showCreateUserForm() {
            document.getElementById('createUserForm').style.display = 'block';
        }

        document.getElementById('userForm').addEventListener('submit', function(event) {
            event.preventDefault();

            var username = document.getElementById('username').value;
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            var userType = document.getElementById('userType').value;

            fetch('admin_management.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    action: 'create',
                    username: username,
                    email: email,
                    password: password,
                    userType: userType
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('User created successfully!');
                    // Reload the users table (to be implemented)
                } else {
                    alert('Error: ' + data.message);
                }
            });
        });

        // Function to load and display users can be added here
    </script>
</body>
</html>
