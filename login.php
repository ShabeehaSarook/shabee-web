<?php
include 'connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $userType = $_POST['userType'] ?? '';

    // Validate inputs
    if (empty($username) || empty($password) || empty($userType)) {
        $error = "All fields are required.";
    } else {
        // Prepare SQL query to fetch user from the database
        $sql = "SELECT * FROM users WHERE username = ? AND userType = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $username, $userType);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        // Check if user exists and verify password
        if ($user && password_verify($password, $user['password'])) {
            // Successful login, set session variables
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $userType;

            // Redirect based on user type
            switch ($userType) {
                case 'admin':
                    header('Location: admin-dashboard.php');
                    break;
                case 'staff':
                    header('Location: staff.php');
                    break;
                case 'customer':
                    header('Location: index.php');
                    break;
            }
            exit;
        } else {
            $error = "Invalid login credentials.";
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Login - The Gallery Café</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    body {
      background-image: url("White Minimalist Good Morning Quote Coffee Instagram Story.png");
      background-size: cover;
      font-family: 'Arial', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
      padding: 0;
      animation: fadeIn 1s ease-in;
    }

    .navbar {
      position: absolute;
      top: 10px;
      left: 10px;
    }

    .navbar a {
      color: #d4a373;
      text-decoration: none;
      padding: 14px 20px;
      display: inline-block;
      transition: color 0.3s;
    }

    .navbar a:hover {
      color: #ccc;
    }

    .login-box {
      background-color: rgba(0, 0, 0, 0.7);
      color: #d4a373;
      padding: 40px;
      border-radius: 10px;
      text-align: center;
      width: 320px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
      animation: slideIn 1s ease-in;
    }

    h1 {
      margin-bottom: 20px;
      font-size: 2.5rem;
      color: #d4a373;
    }

    input, select {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: none;
      background-color: rgba(167, 103, 38, 0.5);
      border-radius: 5px;
      font-size: 1.1rem;
      color: #fff;
    }

    button {
      background-color: #4CAF50;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 1.2rem;
      margin-top: 10px;
      transition: background-color 0.3s, transform 0.3s;
    }

    button:hover {
      background-color: #45a049;
      transform: scale(1.05);
    }

    a {
      color: #d4a373;
      text-decoration: none;
      display: block;
      margin-top: 15px;
      font-size: 0.9rem;
    }

    a:hover {
      color: #f2f2f2;
    }

    .error {
      color: #ff4d4d;
      font-size: 0.9rem;
      margin: 10px 0;
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    @keyframes slideIn {
      from { transform: translateY(-50px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }
  </style>
</head>
<body>
  <div class="navbar">
    <a href="customer.php">Home</a>
  </div>
  <div class="login-box">
    <h1>Login</h1>
    <?php if (isset($error)): ?>
      <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form id="loginForm" action="login.php" method="post">
      <div>
        <input type="text" id="username" name="username" placeholder="Username" required>
      </div>
      <div>
        <input type="password" id="password" name="password" placeholder="Password" required>
      </div>
      <div>
        <select id="userType" name="userType" required>
          <option value="" disabled selected>Select User Type</option>
          <option value="admin">Admin</option>
          <option value="staff">Staff</option>
          <option value="customer">Customer</option>
        </select>
      </div>
      <button type="submit">Login</button>
    </form>
    <a href="signup.php">Don't have an account? Sign up</a>
  </div>

  <script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
      var username = document.getElementById('username').value;
      var password = document.getElementById('password').value;
      var userType = document.getElementById('userType').value;

      if (!username || !password || !userType) {
        alert('Please fill in all fields.');
        event.preventDefault();
      }
    });
  </script>
</body>
</html>
