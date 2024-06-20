<?php
$servername = "154.41.233.52";
$username = "u839503646_admin";
$password = "Ads@2024";
$dbname = "u839503646_woodviz";
<<<<<<< HEAD

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
=======
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
>>>>>>> d19f87eb8e88afe6d6a3445c1b85f552bcc64428
