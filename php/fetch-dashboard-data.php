<?php
include("db.php");

header('Content-Type: application/json');

$response = [];

$sql_top_selling_products = "SELECT product.product_id, name, SUM(quantity) as amount FROM Invoice_item JOIN product ON Invoice_item.product_id = product.product_id GROUP BY product_id ORDER BY amount DESC LIMIT 5";
$result = $conn->query($sql_top_selling_products);

$topSellingProducts = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $topSellingProducts[] = $row;
    }
}
$response['topSellingProducts'] = $topSellingProducts;

$sql_top_customers = "SELECT Customers.customer_id, Customers.name, SUM(invoice_value) as amount FROM Invoice JOIN Customers ON Invoice.customer_id = Customers.customer_id GROUP BY customer_id ORDER BY amount DESC LIMIT 5";
$result = $conn->query($sql_top_customers);

$topCustomers = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $topCustomers[] = $row;
    }
}
$response['topCustomers'] = $topCustomers;

$sql_top_unpaid_bills = "SELECT Invoice.invoice_id, Customers.name, Invoice.invoice_value as amount 
                         FROM Invoice 
                         JOIN Customers ON Invoice.customer_id = Customers.customer_id 
                         JOIN Invoice_item ON Invoice.invoice_id = Invoice_item.invoice_id 
                         WHERE Invoice.Payment_status = 'Unpaid' 
                         GROUP BY Invoice.invoice_id, Customers.name 
                         ORDER BY amount DESC 
                         LIMIT 5";
$result = $conn->query($sql_top_unpaid_bills);

$topUnpaidBills = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $topUnpaidBills[] = $row;
    }
}
$response['topUnpaidBills'] = $topUnpaidBills;

$sql_category_sales = "SELECT category_id, SUM(quantity * unit_price) as total FROM Invoice_item JOIN product ON Invoice_item.product_id = product.product_id GROUP BY category_id";
$result = $conn->query($sql_category_sales);

$categorySales = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categorySales[] = $row;
    }
}
$response['categorySales'] = $categorySales;

echo json_encode($response);

$conn->close();
?>
