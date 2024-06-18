<?php
include('db.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $id = $_POST['id'];
    $name = $_POST['name'];
    $addressLine1 = $_POST['addressLine1'];
    $addressLine2 = $_POST['addressLine2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $pincode = $_POST['pincode'];
    $mobile = $_POST['mobile'];
    $ifsc = $_POST['ifsc'];
    $email = $_POST['email'];
    $gst = $_POST['gst'];
    $pan = $_POST['pan'];
    $bankAccount = $_POST['bankAccount'];
    $balance = $_POST['balance']; 
    
    $sql = "UPDATE Customers SET name = ?, address_line_1 = ?, address_line_2 = ?, city = ?, state = ?, pincode = ?, phone = ?, email = ?, gst = ?, pan = ?, bank_account = ?, balance = ? WHERE customer_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssdis", $name, $addressLine1, $addressLine2, $city, $state, $pincode, $mobile, $email, $gst, $pan, $bankAccount, $balance, $id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            
            echo json_encode(["success" => true, "message" => "Customer updated successfully"]);
        } else {
            
            echo json_encode(["success" => false, "message" => "No rows updated"]);
        }
    } else {
        
        echo json_encode(["success" => false, "message" => "Failed to update customer", "error" => $stmt->error]);
    }
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
}
?>
