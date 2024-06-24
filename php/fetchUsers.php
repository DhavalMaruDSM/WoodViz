<?php
include 'db.php';

$sql = "SELECT user_id, username, fullname, email_id, mobile_number, role, admin, product, purchase, production, billing, customer, report FROM users";
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
