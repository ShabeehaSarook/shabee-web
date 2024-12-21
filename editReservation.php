<?php
include 'connection.php';

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $table = $_POST['table'];  // 'adminreservation' or 'reservation'
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $guests = $_POST['guests'];

    // Use the correct column names as per your database
    $sql = "UPDATE reservations SET customer_name='$name', customer_email='$email', customer_phone='$phone', reservation_date='$date', reservation_time='$time', number_of_guests='$guests' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    header("Location: manage-order&reserve.php");
    exit();
} else {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $table = $_GET['table'];

        // Use the correct table name
        $result = $conn->query("SELECT * FROM reservations WHERE id = $id");

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "Record not found";
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Reservation</title>
    <style>
        body, h1, form, label, input {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f0f4f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"], input[type="email"], input[type="date"], input[type="time"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        @media (max-width: 500px) {
            body {
                padding: 20px;
            }

            form {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <h1>Edit Reservation</h1>
    <form method="post" action="editReservation.php">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <input type="hidden" name="table" value="<?php echo $table; ?>">
        <label>Name: <input type="text" name="name" value="<?php echo $row['customer_name']; ?>" required></label><br>
        <label>Email: <input type="email" name="email" value="<?php echo $row['customer_email']; ?>" required></label><br>
        <label>Phone: <input type="text" name="phone" value="<?php echo $row['customer_phone']; ?>" required></label><br>
        <label>Date: <input type="date" name="date" value="<?php echo $row['reservation_date']; ?>" required></label><br>
        <label>Time: <input type="time" name="time" value="<?php echo $row['reservation_time']; ?>" required></label><br>
        <label>Guests: <input type="number" name="guests" value="<?php echo $row['number_of_guests']; ?>" required></label><br>
        <input type="submit" name="submit" value="Update">
    </form>
</body>
</html>
