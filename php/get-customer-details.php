<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['customer_id'])) {
    $customer_id = $_GET['customer_id'];
    $query = "SELECT * FROM Customers WHERE customer_id = '$customer_id'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(['error' => 'Customer not found']);
    }
}
?>
