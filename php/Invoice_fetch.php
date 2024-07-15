<?php
include 'db.php';

$sql = "SELECT * from Customers as c,Invoice as i,Invoice_item as it where c.customer_id=i.customer_id and i.invoice_id=it.invoice_id group by it.invoice_id";
$result = $conn->query($sql);

$users = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
} 

echo json_encode($users);

$conn->close();
?>
