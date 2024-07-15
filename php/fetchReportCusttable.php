<?php
include 'db.php';

if (isset($_GET['fromDate']) && isset($_GET['toDate']) && !empty($_GET['fromDate']) && !empty($_GET['toDate'])) {
    $fromDate = mysqli_real_escape_string($conn, $_GET['fromDate']);
    $toDate = mysqli_real_escape_string($conn, $_GET['toDate']);

    $sql = "SELECT Customers.name AS customerName,
                    invoices.customer_id as customer_id,
                   COUNT(invoices.invoice_id) AS totalBillsGenerated,
                   SUM(invoices.invoice_value) AS totalBillAmt,
                   SUM(invoices.invoice_value) - SUM(invoices.paid_amount) AS balance
            FROM Customers
            JOIN Invoice AS invoices ON Customers.customer_id = invoices.customer_id
            WHERE invoices.invoice_date BETWEEN '$fromDate' AND '$toDate'
            GROUP BY Customers.name";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        
        header('Content-Type: application/json');
        echo json_encode($data);
    } else {
        echo "No data found";
    }
} else {
    echo "Error: Missing or empty fromDate or toDate parameters.";
}

$conn->close();
?>
