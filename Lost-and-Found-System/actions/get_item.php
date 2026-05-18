<?php
header('Content-Type: application/json');

include '../config/config.php';

$id = $_GET['id'] ?? null;
$type = $_GET['type'] ?? 'item';

if (!$id) {
    echo json_encode(["error" => "Missing ID"]);
    exit;
}

if ($type == "item") {

    $sql = "SELECT i.*, u.f_name, u.l_name
            FROM items i
            LEFT JOIN users u ON i.uploader_id = u.user_id
            WHERE i.item_id = ?";

} else {

    $sql = "SELECT r.*, u.f_name, u.l_name
            FROM reports r
            LEFT JOIN users u ON r.uploader_id = u.user_id
            WHERE r.item_id = ?";
}

$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(["error" => $conn->error]);
    exit;
}

$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$data = $result->fetch_assoc();

echo json_encode($data ?: []);