<?php
include 'connection.php';

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $table = $_POST['table'];  // 'adminreservation' or 'reservation'
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $quantity = $_POST['quantity'];
   

    $sql = "UPDATE admin adminpreorders SET name='$name', email='$email', phone='$phone', quantity='$quantity' WHERE id=$id";

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
        $result = $conn->query("SELECT * FROM $table WHERE id = $id");

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
</head>
<body>
    <h1>Edit Reservation</h1>
    <form method="post" action="editReservation.php">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <input type="hidden" name="table" value="<?php echo $table; ?>">
        <label>Name: <input type="text" name="name" value="<?php echo $row['name']; ?>"></label><br>
        <label>Email: <input type="text" name="email" value="<?php echo $row['email']; ?>"></label><br>
        <label>Phone: <input type="text" name="phone" value="<?php echo $row['phone']; ?>"></label><br>
        <label>Phone: <input type="text" name="quantity" value="<?php echo $row['quantity']; ?>"></label><br>
        <input type="submit" name="submit" value="Update">
    </form>
</body>
</html>
