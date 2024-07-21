<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sub_category_id = $_POST['sub_category_id'];
    $description = $_POST['editsubcategoryname'];
    $updated_at = date('Y-m-d H:i:s');
    $updated_by = 1; // Example user ID

    $stmt = $conn->prepare("UPDATE SubCategory SET description = ?, updated_at = ?, updated_by = ? WHERE sub_category_id = ?");
    $stmt->bind_param("ssii", $description, $updated_at, $updated_by, $sub_category_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Unable to update sub-category: ' . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
