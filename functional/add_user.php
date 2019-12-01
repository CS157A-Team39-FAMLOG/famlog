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
    $stmt2->bind_param("si", $acc_id['accountID'], $unique_user);
    $unique_user = $user_id['userID'];
    $stmt2->execute();
    $stmt2->close();
    
    checkToInsertList($conn, $unique_user);
}
    
function checkToInsertList($conn, $user_id){
    $query = "SELECT COUNT(*) AS count FROM owns WHERE userID='$user_id'";
    $result = mysqli_query($conn, $query);
    if ( ! $result ) die(mysqli_error());
    $row = mysqli_fetch_assoc($result);
    $personalConfirm = $row['count'];

    $query2 = "SELECT COUNT(*) AS count FROM owns";
    $result2 = mysqli_query($conn, $query2);
    if ( ! $result2 ) die(mysqli_error());
    $row2 = mysqli_fetch_assoc($result2);
    $num_of_lists = $row2['count'];

    
    if ($personalConfirm == 0) {
        $stmt1 = $conn->prepare("INSERT INTO personal_list (personalListID, items_count) VALUES (?,?)");
        $stmt1->bind_param("ii", $personal_list_ID, $initial_count);
        $stmt1->execute();
        $stmt1->close();

        $personal_list_ID = $num_of_lists+1;
        $initial_count = 0;

        $stmt2 = $conn->prepare("INSERT INTO owns (userID, personalListID) VALUES (?,?)");
        $stmt2->bind_param("ii", $user_id, $personal_list_ID);
        $stmt2->execute();
        $stmt2->close();
    }
}