<?php
include '../config/config.php';

$id = $_GET['id'];
$type = $_GET['type'];

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
$stmt->bind_param("i", $id);
$stmt->execute();

echo json_encode($stmt->get_result()->fetch_assoc());
?>