<?php
include "db.php"; 

$query = "SELECT customer_id as id , name, email , phone as mobile,balance  FROM Customers";
$result = $conn->query($query);

if ($result) {
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
} else {
    echo "Error: " . $conn->error;
}
$conn->close();
?>
