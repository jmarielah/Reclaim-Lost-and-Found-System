<?php

include '../config/config.php';

$item_id = $_POST['item_id'];
$claimer_id = $_POST['claimer_id'];

// INSERT INTO CLAIM HISTORY
$sql = "INSERT INTO claim_history (item_id, claimer_id)
        VALUES (?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $item_id, $claimer_id);
$stmt->execute();

// UPDATE ITEM STATUS
$update = "UPDATE items
           SET status = 'claimed'
           WHERE item_id = ?";

$stmt2 = $conn->prepare($update);
$stmt2->bind_param("i", $item_id);
$stmt2->execute();

echo "success";
?>