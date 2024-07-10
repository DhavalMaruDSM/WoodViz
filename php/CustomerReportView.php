<?php
include 'db.php';

if (isset($_GET['cname']) && isset($_GET['fromDate']) && isset($_GET['toDate'])) {
    $invoiceId = intval($_GET['cname']);
    $fromDate = $_GET['fromDate']; // Assuming fromDate and toDate are in YYYY-MM-DD format
    $toDate = $_GET['toDate'];

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
    echo json_encode(array('error' => 'Missing parameters'));
}
?>
