<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subcategory_id = isset($_POST['subcategoryId']) ? intval($_POST['subcategoryId']) : null;
    $subcategoryname = trim($_POST['subcategoryname']);
    $created_by = 1; // This should be dynamically set based on the logged-in user
    $created_at = date('Y-m-d H:i:s');
    $updated_at = $created_at;
    $updated_by = $created_by;

    // Validate sub-category name
    if (empty($subcategoryname)) {
        echo 'Error: Sub-category name is required';
        exit;
    }

    if ($subcategory_id) {
        // Update existing sub-category
        $stmt = $conn->prepare("UPDATE SubCategory SET description = ?, updated_at = ?, updated_by = ? WHERE subcategory_id = ?");
        $stmt->bind_param("ssii", $subcategoryname, $updated_at, $updated_by, $subcategory_id);
    } else {
        // Insert new sub-category
        $stmt = $conn->prepare("INSERT INTO SubCategory (description, created_at, created_by, updated_at, updated_by) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisi", $subcategoryname, $created_at, $created_by, $updated_at, $updated_by);
    }

    if ($stmt->execute()) {
        echo 'Sub-category saved successfully';
    } else {
        echo 'Error: ' . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
}

$conn->close();
?>
