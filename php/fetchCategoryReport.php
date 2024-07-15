<?php
include 'db.php';

$fromDate = $_GET['fromDate'];
$toDate = $_GET['toDate'];

$sql = "SELECT category.description AS categoryName, SUM(Invoice_item.quantity) AS totalCategorySale, SUM(Invoice_item.total_value) AS totalCategorySaleAmt FROM Invoice_item INNER JOIN product ON Invoice_item.product_id = product.product_id INNER JOIN Category as category ON product.category_id = category.category_id INNER JOIN Invoice ON Invoice_item.invoice_id = Invoice.invoice_id WHERE Invoice.invoice_date BETWEEN '$fromDate' AND '$toDate' GROUP BY categoryName;";

$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);

$conn->close();
?>
