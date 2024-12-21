<?php
include 'connection.php';

$id = $_GET['id'];

// Validate ID
if (!filter_var($id, FILTER_VALIDATE_INT)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid ID']);
    exit;
}

$sql = "SELECT title, description, image FROM promotions WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$stmt->bind_result($title, $description, $image);
$stmt->fetch();
$stmt->close();

$response = [
    'title' => $title,
    'description' => $description,
    'image' => $image
];

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>
