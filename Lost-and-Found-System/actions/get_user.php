<?php
include '../config/config.php';

header('Content-Type: application/json');

$id = $_GET['id'] ?? null;

if (!$id) {
    echo json_encode(["error" => "missing id"]);
    exit;
}

$sql = "SELECT user_id, f_name, l_name, email, phone_no, department 
        FROM users 
        WHERE user_id = ?";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(["error" => $conn->error]);
    exit;
}

$stmt->bind_param("i", $id);

if (!$stmt->execute()) {
    echo json_encode(["error" => $stmt->error]);
    exit;
}

$result = $stmt->get_result();
$user = $result->fetch_assoc();

echo json_encode($user ?: []);
?>