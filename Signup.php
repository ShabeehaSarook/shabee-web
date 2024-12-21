<?php
include 'connection.php'; // Assuming this file contains your DB connection code

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $userType = $_POST['userType'] ?? '';

    // Validate inputs
    
    if (empty($username) || empty($email) || empty($password) || empty($userType)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required.']);
        exit;
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Prepare and execute the SQL query
    $sql = "INSERT INTO users (username, email, password, userType) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssss', $username, $email, $hashedPassword, $userType);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'User successfully registered!']);
    } else {
        echo json_encode(['success' => false, 'message' => $stmt->error]);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - The Gallery Café</title>
    <style>
        body {
            background-image: url('signupp.png');
            background-size: cover;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            animation: fadeIn 1s ease-in;
        }

        .signup-box {
            background-color: rgba(0, 0, 0, 0.8);
            color: #d4a373;
            padding: 40px;
            border-radius: 12px;
            text-align: center;
            width: 360px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
            animation: slideIn 1s ease-in;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 2.2rem;
            color: #d4a373;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-size: 1rem;
            color: #d4a373;
        }

        input {
            width: calc(100% - 22px);
            padding: 12px;
            margin: 5px 0 15px;
            border: 2px solid #d4a373;
            border-radius: 8px;
            background-color: rgba(0, 0, 0, 0.6);
            color: #fff;
            font-size: 1rem;
            transition: border-color 0.3s ease, background-color 0.3s ease;
        }

        input:focus {
            border-color: #f2f2f2;
            background-color: rgba(0, 0, 0, 0.8);
            outline: none;
        }

        button {
            background-color: #4CAF50;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.1rem;
            transition: background-color 0.3s, transform 0.3s;
            margin-top: 15px;
        }

        button:hover {
            background-color: #45a049;
            transform: scale(1.05);
        }

        a {
            color: #d4a373;
            text-decoration: none;
            font-size: 0.9rem;
            display: block;
            margin-top: 15px;
            transition: color 0.3s;
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
    <div class="signup-box">
        <h1>Sign Up</h1>
        <form id="signupForm" method="post">
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <div id="usernameError" class="error"></div>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <div id="emailError" class="error"></div>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <div id="passwordError" class="error"></div>
            </div>
            <div>
                <label for="userType">User Type:</label>
                <select id="userType" name="userType" required>
                    <option value="customer">Customer</option>
                  
                </select>
                <div id="userTypeError" class="error"></div>
            </div>
            <button type="submit">Sign Up</button>
        </form>
        <a href="login.php">Already have an account? Log in</a>
    </div>


   


    <script>
        document.getElementById('signupForm').addEventListener('submit', function(event) {
            event.preventDefault();

            var username = document.getElementById('username').value;
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            var userType = document.getElementById('userType').value;

            var isValid = true;

            // Clear previous error messages
            document.getElementById('usernameError').textContent = '';
            document.getElementById('emailError').textContent = '';
            document.getElementById('passwordError').textContent = '';
            document.getElementById('userTypeError').textContent = '';

            // Validation
            if (!validateUsername(username)) {
                document.getElementById('usernameError').textContent = 'Username must be at least 3 characters long.';
                isValid = false;
            }

            if (!validateEmail(email)) {
                document.getElementById('emailError').textContent = 'Please enter a valid email address.';
                isValid = false;
            }

            if (!validatePassword(password)) {
                document.getElementById('passwordError').textContent = 'Password must be at least 6 characters long.';
                isValid = false;
            }

            if (isValid) {
                // Submit form via fetch
                fetch('signup.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams({
                        username: username,
                        email: email,
                        password: password,
                        userType: userType
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = 'home.php'; // Redirect to home page
                    } else {
                        alert('Signup failed: ' + data.message);
                    }
                });
            }
        });

        function validateUsername(username) {
            return username.length >= 3;
        }

        function validateEmail(email) {
            var re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            return re.test(String(email).toLowerCase());
        }

        function validatePassword(password) {
            return password.length >= 6;
        }
    </script>
</body>
</html>
