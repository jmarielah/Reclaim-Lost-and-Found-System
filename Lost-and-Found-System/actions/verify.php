<?php
include '../config/config.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

$id = $data['id'] ?? null;
$type = $data['type'] ?? null;
$action = $data['action'] ?? 'approve';

if (!$id || !$type) {
    echo json_encode(["success" => false, "message" => "Missing data"]);
    exit;
}

if ($type === "item") {

    if ($action === "reject") {
        $sql = "DELETE FROM items WHERE item_id=?";
    } else {
        $sql = "UPDATE items SET ver_status='approved' WHERE item_id=?";
    }

} else { // reports

    if ($action === "reject") {
        $sql = "DELETE FROM reports WHERE item_id=?";
    } else {
        $sql = "UPDATE reports SET ver_status='approved' WHERE item_id=?";
    }
}

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

$success = $stmt->execute();

echo json_encode([
    "success" => $success
]);