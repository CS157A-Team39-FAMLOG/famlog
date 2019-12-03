<?php 
session_start();
require 'db_config.php';


$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) die($conn->connect_error);

if (!$conn) {
    die("Connection failed: ".mysqli_connect_error());
}

if (isset($_POST['submit'])) {

    $user = $_SESSION['profile'];
    $itemID = $_POST['itemID'];
    $accName = $_SESSION['accountName'];

    deleteFromDb($conn, $user, $itemID, $accName);
    $conn->close();
    $hiddenUser = base64_encode(json_encode($user));
    header("Location: ../personalList.php?mark=$hiddenUser");
} else {
    header("Location: ../personalHome.php");
    exit();
}


function deleteFromDb($conn, $user, $itemID, $accName) {
    $query = "SELECT userID FROM account JOIN has USING(accountID) JOIN user USING(userID) WHERE accName='$accName' AND name='$user'";
    $result = mysqli_query($conn, $query);
    if ( ! $result ) die(mysqli_error());
    $userID = mysqli_fetch_assoc($result);
    $user_id = $userID['userID'];

    $query = "SELECT personalListID FROM owns WHERE userID='$user_id'";
    $result = mysqli_query($conn, $query);
    if ( ! $result ) die(mysqli_error());
    $personalID = mysqli_fetch_assoc($result);
    $personal_id = $personalID['personalListID'];

    $stmt1 = $conn->prepare("DELETE FROM item WHERE itemID=(?)");
    $stmt1->bind_param("i", $itemID);
    $stmt1->execute();
    $stmt1->close();

    $stmt2 = $conn->prepare("DELETE FROM contains WHERE itemID=(?)");
    $stmt2->bind_param("i", $itemID);
    $stmt2->execute();
    $stmt2->close();

    // count items of the specified personal_id
    $query = "SELECT COUNT(*) AS count FROM contains WHERE personalListID='$personal_id'";
    $result = mysqli_query($conn, $query);
    if ( ! $result ) die(mysqli_error());
    $row = mysqli_fetch_assoc($result);
    $count = $row['count'];

    // // update item_count in personalList
    // $query = "UPDATE personalList SET items_count='$count' WHERE personalListID='$personal_id'";
    $stmt2 = $conn->prepare("UPDATE personal_list SET items_count=(?) WHERE personalListID='$personal_id'");
    $stmt2->bind_param("i", $count);
    $stmt2->execute();
    $stmt2->close();
}