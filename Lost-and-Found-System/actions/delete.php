<?php
include '../config/config.php';

$id = $_POST['id'] ?? null;

if (!$id) {
    echo "Missing ID";
    exit;
}

$stmt = $conn->prepare("DELETE FROM items WHERE item_id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "deleted";
} else {
    echo "error";
}
?>