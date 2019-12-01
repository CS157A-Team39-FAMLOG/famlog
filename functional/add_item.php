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
    $itemName = $_POST['itemName'];
    $brand = $_POST['brand'];
    $quantity = $_POST['quantity'];
    $priority = $_POST['priority'];
    $notes = $_POST['notes'];

    $accName = $_SESSION['accountName'];
    insertIntoDb($conn, $accName, $user, $itemName, $brand, $quantity, $priority, $notes);
    $conn->close();
    header("Location: ../personalList.php?");
} else {
    header("Location: ../personalHome.php");
    exit();
}


function insertIntoDb($conn, $accName, $user, $itemName, $brand, $quantity, $priority, $notes) {
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

    // insert to table item
    $stmt1 = $conn->prepare("INSERT INTO item (itemName, brand, quantity, priority, notes) VALUES (?,?,?,?,?)");
    $stmt1->bind_param("ssiis", $itemName, $brand, $quantity, $priority, $notes);
    $stmt1->execute();
    $stmt1->close();

    // select itemID
    $query = "SELECT itemID FROM item WHERE itemID>=ALL(SELECT itemID FROM item)";
    $result = mysqli_query($conn, $query);
    if ( ! $result ) die(mysqli_error());
    $item = mysqli_fetch_assoc($result);
    $item_id = $item['itemID'];

    // insert to table contains
    $stmt1 = $conn->prepare("INSERT INTO contains VALUES (?,?)");
    $stmt1->bind_param("ii", $personal_id, $item_id);
    $stmt1->execute();
    $stmt1->close();

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