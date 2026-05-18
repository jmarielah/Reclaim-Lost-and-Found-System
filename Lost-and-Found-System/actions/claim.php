<?php
include '../config/config.php';



$item_id = $_POST['item_id'] ?? null;
$claimer_id = $_POST['claimer_id'] ?? null;
$type = $_POST['type'] ?? 'item';

if (!$item_id || !$claimer_id) {
    echo "missing data";
    exit;
}

/*
    1. INSERT INTO CLAIM HISTORY (same for both)
*/
$sql = "INSERT INTO claim_history (item_id, claimer_id)
        VALUES (?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $item_id, $claimer_id);
if (!$stmt->execute()) {
    die("INSERT FAILED: " . $stmt->error);
}

/*
    2. UPDATE BASED ON TYPE
*/
if ($type === "report") {

    $update = "UPDATE reports
               SET status = 'claimed'
               WHERE item_id = ?";

} 
else {

    $update = "UPDATE items
               SET status = 'claimed'
               WHERE item_id = ?";
}

$stmt2 = $conn->prepare($update);
$stmt2->bind_param("i", $item_id);
$stmt2->execute();

echo "success";
?>