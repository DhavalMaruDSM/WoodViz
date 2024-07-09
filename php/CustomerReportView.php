<?php
include 'db.php';

// Check if invoice_id is provided in the GET request
if (isset($_GET['cname'])) {
    // Sanitize and cast invoice_id to integer to prevent SQL injection
    $invoiceId = intval($_GET['cname']);
    
    // Prepare the SQL query using a parameterized statement
    $sql = "SELECT * FROM Invoice WHERE customer_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $invoiceId); // 'i' indicates integer type
    $stmt->execute();
    
    // Check if there are any results
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // Fetch all rows into an array
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        $conn->close();

        // Return the data as JSON
        header('Content-Type: application/json');
        echo json_encode($data);
    } else {
        // If no results found, return an empty array
        $stmt->close();
        $conn->close();
        echo json_encode(array()); 
    }
} else {
    // If invoice_id is not provided in the GET request, return an error message
    echo json_encode(array('error' => 'No invoice_id provided'));
}
?>
