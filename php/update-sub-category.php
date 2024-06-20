<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $id = $data['id'];
    $subcategory = $data['subcategory'];

    $query = "UPDATE SubCategory SET description = ? WHERE sub_category_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $subcategory, $id);

    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'subcategory' => [
                'id' => $id,
                'subcategory' => $subcategory
            ]
        ]);
    } else {
        echo json_encode(['success' => false]);
    }

    $stmt->close();
}

$conn->close();
?>
