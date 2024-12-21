<?php
include 'connection.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM adminorders WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $order = mysqli_fetch_assoc($result);
    
    echo json_encode($order);
}
?>
