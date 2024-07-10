<?php
include 'db.php';

if (isset($_GET['cname'])) {

    $invoiceId = intval($_GET['cname']);
    
    $sql = "SELECT * FROM Invoice WHERE customer_id = ? AND invoice_date BETWEEN ? AND ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iss', $invoiceId, $fromDate, $toDate);  
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        $conn->close();
        header('Content-Type: application/json');
        echo json_encode($data);
    } else {
        $stmt->close();
        $conn->close();
        echo json_encode(array()); 
    }
} else {
    echo json_encode(array('error' => 'No invoice_id provided'));
}
?>
