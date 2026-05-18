<?php
include '../config/config.php';

$id = $_POST['item_id'];
$name = $_POST['item_name'];
$category = $_POST['category'];
$date = $_POST['date_found'];
$location = $_POST['location'];
$description = $_POST['description'];

$sql = "UPDATE items 
        SET item_name = ?, 
            category = ?, 
            date_found = ?, 
            location_found = ?, 
            description = ?
        WHERE item_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssi", $name, $category, $date, $location, $description, $id);

echo $stmt->execute() ? "success" : "error";
?>