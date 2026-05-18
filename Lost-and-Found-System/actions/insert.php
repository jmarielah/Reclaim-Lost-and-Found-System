<?php
include '../config/config.php';
session_start();

$type = $_POST['type'] ?? 'item';

if ($type === "report") {

    $name = $_POST['item_name'];
    $category = $_POST['category'];
    $date = $_POST['date_lost'];
    $location = $_POST['location_lost'];
    $description = $_POST['description'];
    $uploader = $_SESSION['user_id'] ?? 1;

    $sql = "INSERT INTO reports 
            (item_name, category, date_lost, location_lost, description, uploader_id, ver_status)
            VALUES (?, ?, ?, ?, ?, ?, 'pending')";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $name, $category, $date, $location, $description, $uploader);

    echo $stmt->execute() ? "success" : "error: " . $stmt->error;


} elseif ($type === "item") {

    $name = $_POST['item_name'];
    $category = $_POST['category'];
    $date = $_POST['date_found'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $uploader = $_SESSION['user_id'] ?? 1001;

    $sql = "INSERT INTO items 
            (item_name, category, date_found, location_found, description, uploader_id, status)
            VALUES (?, ?, ?, ?, ?, ?, 'found')";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $name, $category, $date, $location, $description, $uploader);

    echo $stmt->execute() ? "success" : "error: " . $stmt->error;

} else {
    echo "invalid type";
}