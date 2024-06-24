<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productname = $_POST['productname'];
    $category = $_POST['category'];
    $subcategory = $_POST['subcategory'];
    $inventory = $_POST['inventory'];
    $cgst = $_POST['cgst'];
    $sgst = $_POST['sgst'];
    $igst = $_POST['igst'];
    $price = $_POST['price'];

    $stmt = $conn->prepare("INSERT INTO product (name, category_id, sub_category_id, inventory, cgst, sgst, igst, price) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("siiiiiii", $productname, $category, $subcategory, $inventory, $cgst, $sgst, $igst, $price);

    if ($stmt->execute()) {
        echo 'Product submitted successfully';
    } else {
        echo 'Error: ' . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
}

$conn->close();
?>
