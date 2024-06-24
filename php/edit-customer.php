<?php
include('db.php');

//  fetch customer details
function fetchCustomerDetails($conn, $id) {
    $fetch_query = "SELECT * FROM Customers WHERE customer_id = ?";
    $stmt = $conn->prepare($fetch_query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if (!$result) {
        return json_encode(["error" => $stmt->error]);
    }
    
    $response = array();
    if ($result->num_rows > 0) {
        $response = $result->fetch_assoc();
    } else {
        $response['status'] = 200;
        $response['message'] = 'Data not Found';
    }
    $stmt->close();
    return json_encode($response);
}

//  update customer details
function updateCustomerDetails($conn, $id, $name, $addressLine1, $addressLine2, $city, $state, $pincode, $mobile, $email, $gst, $pan, $bankAccount, $balance, $ifsc) {
    $sql = "UPDATE Customers SET name = ?, address_line_1 = ?, address_line_2 = ?, city = ?, state = ?, pincode = ?, phone = ?, email = ?, gst = ?, pan = ?, bank_account = ?, balance = ?, ifsc = ? WHERE customer_id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssdsi", $name, $addressLine1, $addressLine2, $city, $state, $pincode, $mobile, $email, $gst, $pan, $bankAccount, $balance, $ifsc, $id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            $stmt->close();
            return json_encode(["success" => true, "message" => "Customer updated successfully"]);
        } else {
            $stmt->close();
            return json_encode(["success" => false, "message" => "No rows updated"]);
        }
    } else {
        $error_message = $stmt->error;
        $stmt->close();
        return json_encode(["success" => false, "message" => "Failed to update customer", "error" => $error_message]);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && $_POST['id'] != "" && count($_POST) == 1) {
        $id = $_POST['id'];
        echo fetchCustomerDetails($conn, $id);
    } elseif (
        isset($_POST['id']) && $_POST['id'] != "" &&
        isset($_POST['name']) && isset($_POST['addressLine1']) && isset($_POST['addressLine2']) &&
        isset($_POST['city']) && isset($_POST['state']) && isset($_POST['pincode']) &&
        isset($_POST['mobile']) && isset($_POST['email']) && isset($_POST['gst']) &&
        isset($_POST['pan']) && isset($_POST['bankAccount']) && isset($_POST['balance']) && isset($_POST['ifsc'])
    ) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $addressLine1 = $_POST['addressLine1'];
        $addressLine2 = $_POST['addressLine2'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $pincode = $_POST['pincode'];
        $mobile = $_POST['mobile'];
        $email = $_POST['email'];
        $gst = $_POST['gst'];
        $pan = $_POST['pan'];
        $bankAccount = $_POST['bankAccount'];
        $balance = $_POST['balance'];
        $ifsc = $_POST['ifsc'];
        
        echo updateCustomerDetails($conn, $id, $name, $addressLine1, $addressLine2, $city, $state, $pincode, $mobile, $email, $gst, $pan, $bankAccount, $balance, $ifsc);
    } else {
        echo json_encode(["status" => 200, "message" => 'Invalid Request!']);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
}
?>
