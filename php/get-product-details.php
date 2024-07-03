<?php
// get-product-details.php

include 'db.php';

$product_id = $_GET['product_id'];

$query = "SELECT * FROM product WHERE product_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
    echo json_encode($product);
} else {
    echo json_encode([]);
}
?>
