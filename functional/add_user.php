<?php 
session_start();
require 'db_config.php';


$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) die($conn->connect_error);

if (!$conn) {
    die("Connection failed: ".mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    
    $user = mysqli_escape_string($conn, $_POST['userName']);

    $accName = $_SESSION['accountName'];
    insertIntoDb($conn, $accName, $user);
    $conn->close();
    header("Location: ../personalHome.php");
} else {
    header("Location: ../personalHome.php");
    exit();
}


function insertIntoDb($conn, $accName, $name) {
    $stmt1 = $conn->prepare("INSERT INTO user (name) VALUES (?)");
    $stmt1->bind_param("s", $_POST['userName']);
    $stmt1->execute();
    $stmt1->close();

    $query = "SELECT accountID FROM account WHERE accName='$accName'";
    $result = mysqli_query($conn, $query);
    if ( ! $result ) die(mysqli_error());
    $acc_id = mysqli_fetch_assoc($result);

    $query = "SELECT userID FROM user WHERE userID>=ALL(SELECT userID FROM user)";
    $result = mysqli_query($conn, $query);
    if ( ! $result ) die(mysqli_error());
    $user_id = mysqli_fetch_assoc($result);

    $stmt2 = $conn->prepare("INSERT INTO has VALUES (?, ?)");
    $stmt2->bind_param("si", $acc_id['accountID'], $user_id['userID']);
    $stmt2->execute();
    $stmt2->close();
}

