<?php
include '../config/config.php';

$id = $_POST['id'] ?? null;
$type = $_POST['type'] ?? 'item';

if (!$id) {
    echo "Missing ID";
    exit;
}

if ($type === "report") {

    $stmt = $conn->prepare("DELETE FROM reports WHERE item_id = ?");
    $stmt->bind_param("i", $id);

} else {

    $stmt = $conn->prepare("DELETE FROM items WHERE item_id = ?");
    $stmt->bind_param("i", $id);

}

if ($stmt->execute()) {
    echo "deleted";
} else {
    echo "error";
}
?>