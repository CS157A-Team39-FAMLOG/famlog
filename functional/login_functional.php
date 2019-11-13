<?php

require 'db_config.php';

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) die($conn->connect_error);

if (!$conn) {
    die("Connection failed: ".mysqli_connect_error());
}

if (isset($_POST['login'])) {

    $accountName = $_POST['loginAcctName'];
    $password = $_POST['loginPwd'];
    $tmpAcctName;
    $tmpPassword;

    if (empty($accountName) || empty($password)) {
        header("Location: ../index.php?error=emptyfield");
        exit();
    } else { 
        $stmt = $conn->prepare("SELECT accName, passWrd FROM account WHERE accName=?");
        $stmt->bind_param("s", $accountName);
        $stmt->execute();
        $stmt -> store_result(); 
        $stmt -> bind_result($tmpAcctName, $tmpPassword); 
        $stmt -> fetch();
            
        if (!empty($tmpPassword)) {
            $pwdCheck = password_verify($password, $tmpPassword);
            if ($pwdCheck == false) {
                header("Location: ../index.php?error=wrongPassword");
                exit();
            } else if ($pwdCheck == true) {
                session_start();
                $_SESSION['accountName'] = $tmpAcctName;
                header("Location: ../accountHome.php");
                exit();
            } else {
                header("Location: ../index.php?error=wrongPass");
                exit();
            }
        } else {
            header("Location: ../index.php?error=userDoesNotExist");
            exit();
        }
    }
} else {
    header("Location: ../index.php");
    exit();
}