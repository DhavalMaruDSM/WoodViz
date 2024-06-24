<?php

include "db.php"; 
$data = json_decode(file_get_contents("php://input"), true);


if (isset($data['id'])) {
    $id = $data['id'];
    $sql = "DELETE FROM Customers WHERE customer_id = ?";
    
   
    if ($stmt = $conn->prepare($sql)) {
       
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            
            echo json_encode(['success' => true]);
        } else {
           
            echo json_encode(['success' => false, 'message' => 'Error deleting record: ' . $conn->error]);
        }
        
        $stmt->close();
    } else {
        
        echo json_encode(['success' => false, 'message' => 'Error preparing statement: ' . $conn->error]);
    }
} else {
  
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
}

$conn->close();
?>
