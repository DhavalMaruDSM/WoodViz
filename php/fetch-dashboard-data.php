<?php
include("db.php");

header('Content-Type: application/json');

$response = [];

// Get the current month and year
$currentMonth = date('m');
$currentYear = date('Y');

// Fetch top selling products for the current month
$sql_top_selling_products = "SELECT product.product_id, product.name, SUM(Invoice_item.quantity) as amount 
                             FROM Invoice_item 
                             JOIN product ON Invoice_item.product_id = product.product_id 
                             JOIN Invoice ON Invoice_item.invoice_id = Invoice.invoice_id 
                             WHERE MONTH(Invoice.invoice_date) = $currentMonth AND YEAR(Invoice.invoice_date) = $currentYear
                             GROUP BY product.product_id 
                             ORDER BY amount DESC 
                             LIMIT 5";
$result = $conn->query($sql_top_selling_products);

$topSellingProducts = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $topSellingProducts[] = $row;
    }
}
$response['topSellingProducts'] = $topSellingProducts;

// Fetch top customers for the current month
$sql_top_customers = "SELECT Customers.customer_id, Customers.name, SUM(Invoice.invoice_value) as amount 
                      FROM Invoice 
                      JOIN Customers ON Invoice.customer_id = Customers.customer_id 
                      WHERE MONTH(Invoice.invoice_date) = $currentMonth AND YEAR(Invoice.invoice_date) = $currentYear
                      GROUP BY Customers.customer_id 
                      ORDER BY amount DESC 
                      LIMIT 5";
$result = $conn->query($sql_top_customers);

$topCustomers = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $topCustomers[] = $row;
    }
}
$response['topCustomers'] = $topCustomers;

// Fetch top unpaid bills till date
$sql_top_unpaid_bills = "SELECT Invoice.invoice_id, Customers.name, Invoice.invoice_value as amount 
                         FROM Invoice 
                         JOIN Customers ON Invoice.customer_id = Customers.customer_id 
                         WHERE Invoice.payment_status = 'Unpaid' 
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

// Fetch category-wise sales
$sql_category_sales = "SELECT product.category_id, SUM(Invoice_item.quantity * Invoice_item.unit_price) as total 
                       FROM Invoice_item 
                       JOIN product ON Invoice_item.product_id = product.product_id 
                       GROUP BY product.category_id";
$result = $conn->query($sql_category_sales);

$categorySales = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categorySales[] = $row;
    }
}
$response['categorySales'] = $categorySales;

// Fetch total sales, total paid, and total unpaid amounts
$sql_total_sales = "SELECT SUM(invoice_value) as totalSales FROM Invoice";
$result = $conn->query($sql_total_sales);
$response['totalSales'] = $result->fetch_assoc()['totalSales'];

$sql_total_paid = "SELECT SUM(invoice_value) as totalPaid FROM Invoice WHERE payment_status = 'Paid'";
$result = $conn->query($sql_total_paid);
$response['totalPaid'] = $result->fetch_assoc()['totalPaid'];

$sql_total_unpaid = "SELECT SUM(invoice_value) as totalUnpaid FROM Invoice WHERE payment_status = 'Unpaid'";
$result = $conn->query($sql_total_unpaid);
$response['totalUnpaid'] = $result->fetch_assoc()['totalUnpaid'];

// Fetch monthly sales data
$sql_monthly_sales = "SELECT MONTH(invoice_date) as month, SUM(invoice_value) as total 
                      FROM Invoice 
                      WHERE YEAR(invoice_date) = $currentYear
                      GROUP BY MONTH(invoice_date) 
                      ORDER BY month";
$result = $conn->query($sql_monthly_sales);

$monthlySales = [];
$months = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $months[] = date('F', mktime(0, 0, 0, $row['month'], 10));
        $monthlySales[] = $row['total'];
    }
}
$response['monthlySales'] = $monthlySales;
$response['months'] = $months;

echo json_encode($response);

$conn->close();
