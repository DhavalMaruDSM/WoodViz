<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'db.php';

header('Content-Type: application/json'); // Ensure the response is JSON

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $userId = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM users WHERE User_id = ?");
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        $response = array("success" => true, "message" => "User deleted successfully", "userId" => $userId);
    } else {
        $response = array("success" => false, "error" => "Error deleting user");
    }

    $stmt->close();
    $conn->close();
} else {
    $response = array("success" => false, "error" => "Invalid request");
}

echo json_encode($response);
?>
