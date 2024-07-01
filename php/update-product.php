<?php
require 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $subcategory_id = $_POST['sub_category_id'];
    $inventory = $_POST['inventory'];
    $cgst = $_POST['cgst'];
    $sgst = $_POST['sgst'];
    $igst = $_POST['igst'];
    $price = $_POST['price'];

    $sql = "UPDATE product SET name = '$name', category_id = $category_id, sub_category_id = $subcategory_id, inventory = $inventory, cgst = $cgst, sgst = $sgst, igst = $igst, price = $price WHERE product_id = $product_id";
if ($conn->query($sql) === TRUE) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Unable to update product: ' . $conn->error]);
    }

    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
