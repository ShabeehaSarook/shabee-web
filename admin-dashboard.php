<?php   include 'connection.php';
session_start();
if ($_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery Café | Admin Dashboard</title>
    <style>
        :root {
            --primary-color: #ebe3e3;
            --secondary-color: #cd6b09;
            --button-color:#0b0602 ;
            --button-hover-color: #45a049;
            --logout-color: #f44336;
            --logout-hover-color: #d32f2f;
            --background-gradient-start: #1e3c72;
            --background-gradient-end: #2a5298;
            --section-bg-color: rgba(255, 255, 255, 0.9);
            --section-border-radius: 8px;
            --button-radius: 5px;
            --font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        * {
            box-sizing: border-box;
            font-family: var(--font-family);
            margin: 0;
            padding: 0;
        }

        body {
            background: linear-gradient(to right, var(--background-gradient-start), var(--background-gradient-end));
            color: #333;
            overflow: hidden;
            background: url('admin dash1.avif') no-repeat center center fixed;
            background-size: cover;
        }

        h1 {
            color: var(--primary-color);
            text-align: center;
            font-size: 2rem;
            padding-top: 5%;
            margin-bottom: 20px;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .btn {
            display: inline-block;
            background-color: var(--button-color);
            color: var(--primary-color);
            border: none;
            padding: 12px 24px;
            cursor: pointer;
            border-radius: var(--button-radius);
            font-size: 1rem;
            text-align: center;
            transition: background-color 0.3s, transform 0.3s;
            text-decoration: none;
            margin: 10px;
        }

        .btn:hover {
            background-color: var(--button-hover-color);
            transform: scale(1.05);
        }

        .logout-btn {
            background-color: var(--logout-color);
        }

        .logout-btn:hover {
            background-color: var(--logout-hover-color);
        }

        .actions {
            text-align: center;
            margin-top: 20px;
        }

        .dashboard-section {
            background: var(--section-bg-color);
            border-radius: var(--section-border-radius);
            padding: 20px;
            margin: 10px 0;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .dashboard-section h3 {
            color: var(--secondary-color);
            margin-bottom: 15px;
        }

        .dashboard-section button {
            background-color: var(--button-color);
            color: var(--primary-color);
            border: none;
            padding: 12px 24px;
            cursor: pointer;
            border-radius: var(--button-radius);
            font-size: 1rem;
            margin: 10px;
            text-align: center;
            transition: background-color 0.3s, transform 0.3s;
            text-decoration: none;
        }

        .dashboard-section button:hover {
            background-color: var(--button-hover-color);
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <h1>Admin Dashboard</h1>

    <div class="container">
        <div class="actions">
            <button id="manageUsersBtn" class="btn">Manage Users</button>
            <button id="viewMenuBtn" class="btn">Manage Menu</button>
            
            <a href="parking-admin management.php" class="btn">Parking</a>
            <a href="manage-promotion.php" class="btn">Manage Promotion</a>
            <a href="logout.php" class="btn logout-btn">Logout</a>
            <br>
            <a href="admin-preorder.php" class="btn">Manage <br> Pre order</a>
            <a href="manage-order&reserve.php" class="btn">Manage <br> reservation</a>
           
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const manageUsersBtn = document.getElementById('manageUsersBtn');
            const viewMenuBtn = document.getElementById('viewMenuBtn');
            const viewReservationsBtn = document.getElementById('viewReservationsBtn');

            manageUsersBtn.addEventListener('click', function() {
                window.location.href = 'manage-users.php';
            });

            viewMenuBtn.addEventListener('click', function() {
                window.location.href = 'manage-menu.php';
            });

            viewReservationsBtn.addEventListener('click', function() {
                window.location.href = 'manage-reservations.php';
            });
        });
    </script>
</body>
</html>
