<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    $email_verify = "select * from users where email_id='$email' OR username='$email';";
    $res_email_verify = $conn->query($email_verify);
    if ($res_email_verify->num_rows > 0) {
        while ($row = $res_email_verify->fetch_assoc()) {
            $user_id = $row['user_id'];
            $db_password = $row['password'];
            $name = $row['username'];
            $role=$row['role'];
        }
        // if (password_verify($password,$db_password)){ 
        if($db_password==$password){
        session_start();
            $_SESSION['User_id'] = $user_id;
            $_SESSION['User_name'] = $name;
            echo "<script>alert('logginnned successfully $name');window.location.href='../index.php';</script>";
        }else {
            echo "<script>alert('Please enter correct password');window.location.href='/../woodviz/login.php';</script>";
        }
    }else {
            echo "<script>alert('Please enter correct email-id');window.location.href='/../woodviz/login.php';</script>";
        }
}
?>