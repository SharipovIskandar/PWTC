<?php
require 'connectDB.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['registrationPassword'];

    $db = connectDB::connect();

    $sql = "INSERT INTO `info` (userNmae, email, password) VALUES (:userNmae, :email, :password)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':userNmae', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Registration failed!";
    }
}
?>
