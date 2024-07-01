<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_id = isset($_POST['categoryId']) ? intval($_POST['categoryId']) : null;
    $categoryname = trim($_POST['categoryname']);
    $created_by = 1; // This should be dynamically set based on the logged-in user
    $created_at = date('Y-m-d H:i:s');
    $updated_at = $created_at;
    $updated_by = $created_by;

    // Validate category name
    if (empty($categoryname)) {
        echo 'Error: Category name is required';
        exit;
    }

    if ($category_id) {
        // Update existing category
        $stmt = $conn->prepare("UPDATE Category SET description = ?, updated_at = ?, updated_by = ? WHERE category_id = ?");
        $stmt->bind_param("ssii", $categoryname, $updated_at, $updated_by, $category_id);
    } else {
        // Insert new category
        $stmt = $conn->prepare("INSERT INTO Category (description, created_at, created_by, updated_at, updated_by) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisi", $categoryname, $created_at, $created_by, $updated_at, $updated_by);
    }

    if ($stmt->execute()) {
        echo 'Category saved successfully';
    } else {
        echo 'Error: ' . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
}

$conn->close();
?>
