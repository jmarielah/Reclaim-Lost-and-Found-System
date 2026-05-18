<?php
include '../config/config.php';

$type = $_POST['type'] ?? 'item';
$id = $_POST['item_id'] ?? null;

$name = $_POST['item_name'] ?? '';
$category = $_POST['category'] ?? '';
$date = $_POST['date_lost'] ?? ($_POST['date_found'] ?? '');;
$location = $_POST['location_lost'] ?? ($_POST['location_found'] ?? '');
$description = $_POST['description'] ?? '';

if (!$id) {
    echo "Missing ID";
    exit;
}

if ($type === "report") {

    // REPORTS TABLE
    $sql = "UPDATE reports 
            SET item_name = ?, 
                category = ?, 
                date_lost = ?, 
                location_lost = ?, 
                description = ?
            WHERE item_id = ?";

} else {

    // ITEMS TABLE
    $sql = "UPDATE items 
            SET item_name = ?, 
                category = ?, 
                date_found = ?, 
                location_found = ?, 
                description = ?
            WHERE item_id = ?";
}

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "sssssi",
    $name,
    $category,
    $date,
    $location,
    $description,
    $id
);

echo $stmt->execute() ? "success" : "error";
?>