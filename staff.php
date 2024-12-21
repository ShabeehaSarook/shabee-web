<?php   include 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery Café | Staff Dashboard</title>
    <style>
        :root {
            --primary-color: #ffffff;
            --secondary-color: #d4a373;
            --button-color: #d4a373;
            --button-hover-color: #45a049;
            --logout-color: #f44336;
            --logout-hover-color: #d32f2f;
        }

        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        body {
            background: linear-gradient(to right, #1e3c72, #2a5298);
            overflow: hidden;
            margin: 0;
            padding: 0;
            color: #333;
            background: url('admin1.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        h1 {
            color: #ffffff;
            text-align: center;
            font-size: 2rem;
            padding-top: 10%;
        }

        .container {
            text-align: center;
            padding: 20px;
        }

        .btn {
            display: inline-block;
            background-color: var(--button-color);
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 1rem;
            margin-right: 10px;
            text-align: center;
            transition: background-color 0.3s;
            text-decoration: none;
        }

        .btn:hover {
            background-color: var(--button-hover-color);
        }

        .logout-btn {
            background-color: var(--logout-color);
            color: #fff;
        }

        .logout-btn:hover {
            background-color: var(--logout-hover-color);
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            background-color: var(--secondary-color);
            text-align: center;
            margin: 0;
            padding: 10px 0;
        }

        nav ul li {
            display: inline;
            margin-right: 10px;
        }

        nav ul li a {
            color: var(--primary-color);
            text-decoration: none;
            padding: 15px 20px;
            display: inline-block;
        }

        nav ul li a:hover {
            background-color: #fff;
            color: var(--secondary-color);
        }

        .actions {
            text-align: center;
            margin-top: 20px;
        }

        .actions button {
            background-color: var(--button-color);
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 1rem;
            margin-right: 10px;
            text-align: center;
            transition: background-color 0.3s;
            text-decoration: none;
        }

        .actions button:hover {
            background-color: var(--button-hover-color);
        }
    </style>
</head>
<body>
 
    <h1>Staff Dashboard</h1>

    <div class="container">
        <div class="actions">
            <a href="reservation-management.php" class="btn">View Reservations</a>
            <a href="preorder-management.php" class="btn">Process Pre-orders</a>
            <a href="staff-parking.php" class="btn">parking</a>
            <a href="logout.php" class="btn logout-btn">Logout</a>
           
        </div>
    </div>
</body>
</html>
