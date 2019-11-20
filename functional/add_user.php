<?php 
require 'db_config.php';

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) die($conn->connect_error);

if (!$conn) {
    die("Connection failed: ".mysqli_connect_error());
}

if (isset($_POST['addUser'])) {
    
    $user = $_POST['user'];
    

    if empty($acctName) {
        exit();
    } else if (!preg_match("/^[a-zA-Z0-9]*$/", $acctName)) {
        exit();
    } else {
        checkAndInsert($conn, $acctName, $password);
    }
    $stmt->close();
    $conn->close();
} else {
    header("Location: ../signup.php");
    exit();
}

function checkAndInsert($conn, $userName, $password) {
    $stmt = $conn->prepare("SELECT name FROM user WHERE name=?");
    $stmt->bind_param("s", $userName);
    $stmt->execute();
    $stmt->store_result();
    $result_check = $stmt->num_rows();
    
    if ($result_check > 0) {
        header("Location: ../signup.php?error=accountAlreadyExists");
        exit();
    } else {
        insertIntoDb($conn, $acctName, $password);
    }
}

function insertIntoDb($conn, $accName, $userName, $password) {
    $stmt = $conn->prepare("INSERT INTO user(userName) VALUES (?)");
    $stmt->bind_param("s", $userName);
    $stmt->execute();
    header("Location: ../signup.php?signup=success");
    exit();
}

