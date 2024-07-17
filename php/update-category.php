<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_id = $_POST['category_id'];
    $description = $_POST['editcategoryname'];
    $updated_at = date('Y-m-d H:i:s');
    $updated_by = 1; // This should be dynamically set based on the logged-in user

    $stmt = $conn->prepare("UPDATE Category SET description = ?, updated_at = ?, updated_by = ? WHERE category_id = ?");
    $stmt->bind_param("ssii", $description, $updated_at, $updated_by, $category_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Unable to update category: ' . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
