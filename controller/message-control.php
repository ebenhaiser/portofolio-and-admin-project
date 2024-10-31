<?php
require_once "../admin/controller/connection.php";

if (isset($_GET['send'])) {
    $id = $_GET['send'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = mysqli_real_escape_string($connection, $_POST['message']);
    
    $querySendMessage = mysqli_query($connection, "INSERT INTO portofolio_message (userId, status_id, name, email, phone,  message) VALUES ('$id', 2, '$name', '$email', '$phone', '$message')");
    if($querySendMessage) {
        header("location: ../index.php?id=$id#contact");
        exit();
    }
}