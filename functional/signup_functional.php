<?php 
    require 'db_config.php';

	$conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) die($conn->connect_error);
    
    if (!$conn) {
        die("Connection failed: ".mysqli_connect_error());
    }

if (isset($_POST['signup'])) {
    
    $acctName = $_POST['acctName'];
    $password = $_POST['pwd'];
    $confirmPass = $_POST['confirm-pwd'];
    

    if (empty($acctName) || empty($password) || empty($confirmPass)) {
        header("Location: ../signup.php?error=emptyfields&acctName=".$acctName);
        exit();
    } else if (!preg_match("/^[a-zA-Z0-9]*$/", $acctName)) {
        header("Location: ../signup.php?error=invalidacctName");
        exit();
    } else if ($password !== $confirmPass) {
        header("Location: ../signup.php?error=passwordConfirmation&acctName=".$acctName);
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

function checkAndInsert($conn, $acctName, $password) {
    $stmt = $conn->prepare("SELECT accName FROM account WHERE accName=?");
    $stmt->bind_param("s", $acctName);
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

function insertIntoDb($conn, $acctName, $password) {
    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO account(accName, passWrd) VALUES (?, ?)");
    $stmt->bind_param("ss", $acctName, $hashedPwd);
    $stmt->execute();
    header("Location: ../signup.php?signup=success");
    exit();
}

