<?php
require 'connectDB.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['signInPassword'];

    $db = connectDB::connect();

    $sql = "SELECT * FROM `info` WHERE userNmae = :userNmae AND password = :password";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':userNmae', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $_SESSION['logged_in'] = true;
        header("Location: adminPanel.php");
        exit();
    } else {
        echo "Username or password incorrect!";
    }
}
?>
