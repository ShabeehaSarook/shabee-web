<?php   include 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Staff Login - The Gallery Café</title>
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

    input {
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
    <a href="index.php">Home</a>
  </div>
  <div class="login-box">
    <h1>Staff Login</h1>
    <form id="loginForm" action="staff_login.php" method="post">
      <div>
        <input type="text" id="username" name="username" placeholder="Username" required>
        <div id="usernameError" class="error"></div>
      </div>
      <div>
        <input type="password" id="password" name="password" placeholder="Password" required>
        <div id="passwordError" class="error"></div>
      </div>
      <button type="submit">Login</button>
    </form>
    <a href="signup.php">Don't have an account? Sign up</a>
  </div>

  <script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
      event.preventDefault();

      var username = document.getElementById('username').value;
      var password = document.getElementById('password').value;

      var isValid = true;

      // Clear previous error messages
      document.getElementById('usernameError').textContent = '';
      document.getElementById('passwordError').textContent = '';

      // Validation
      if (username.length < 3) {
        document.getElementById('usernameError').textContent = 'Username must be at least 3 characters long.';
        isValid = false;
      }

      if (password.length < 6) {
        document.getElementById('passwordError').textContent = 'Password must be at least 6 characters long.';
        isValid = false;
      } else if (!/[A-Z]/.test(password) || !/[0-9]/.test(password) || !/[!@#$%^&*]/.test(password)) {
        document.getElementById('passwordError').textContent = 'Password must contain at least one uppercase letter, one number, and one special character.';
        isValid = false;
      }

      if (isValid) {
        // Submit form via fetch
        fetch('staff_login.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: new URLSearchParams({
            username: username,
            password: password
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            window.location.href = 'staff_home.html'; // Redirect to staff home page
          } else {
            alert('Login failed: ' + data.message);
          }
        });
      }
    });
  </script>
</body>
</html>
