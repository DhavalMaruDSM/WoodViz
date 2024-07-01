<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sub_category_id = $_POST['sub_category_id'];

    $stmt = $conn->prepare("DELETE FROM SubCategory WHERE sub_category_id = ?");
    $stmt->bind_param("i", $sub_category_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Unable to delete sub-category: ' . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
