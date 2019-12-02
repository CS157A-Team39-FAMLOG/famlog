<?php 
session_start();
require 'db_config.php';


$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) die($conn->connect_error);

if (!$conn) {
    die("Connection failed: ".mysqli_connect_error());
}
$accName = $_SESSION['accountName'];

if (isset($_POST['submit'])) {
    
    $selectedItems = array();
    $atPrices = array();
    $purchasedItems = array();

    $buyer = $_POST['buyer'];

    if(!empty($_POST['prices'])){  
        foreach($_POST['item_id'] as $thisItem) {
            $selectedItems[] = $thisItem;  
        }
        foreach($_POST['prices'] as $thisPrice){
            $atPrices[] = $thisPrice;
        }
    }

    $purchasedItems = array_combine($selectedItems, $atPrices);

    foreach ($purchasedItems as $item => $price) {
        $stmt1 = $conn->prepare("SELECT name FROM user 
                            JOIN owns USING(userID)
                            JOIN personal_list USING(personalListID)
                            JOIN contains USING (personalListID)
                            JOIN item USING(itemID)
                            WHERE itemID = ?");
        $stmt1->bind_param("i", $item);
        $stmt1->execute();
        $result = $stmt1->get_result();
        if($result->num_rows === 0) exit('No rows');
        while($row = $result->fetch_assoc()) {
            $itemLister = $row['name'];
        }
        $stmt1->close();

        $stmt2 = $conn->prepare("SELECT quantity FROM item WHERE itemID = ?");
        $stmt2->bind_param("i", $item);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        if($result2->num_rows === 0) exit('No rows');
        while($row2 = $result2->fetch_assoc()) {
            $quantity = $row2['quantity'];
        }
        $stmt2->close();

        $dat = date("Y-m-d");
        $stmt3 = $conn->prepare("INSERT INTO purchase_history (belongsTo, buyer, quantity, datePurchased, price) VALUES (?,?,?,?,?)");
        $stmt3->bind_param("ssisd", $itemLister, $buyer, $quantity, $dat, $price);
        $stmt3->execute();
        $purchaseID = $stmt3->insert_id;
        $stmt3->close(); 

        $stmt4 = $conn->prepare("INSERT INTO records (itemID, purchaseID) VALUES (?,?)");
        $stmt4->bind_param("ii", $item, $purchaseID);
        $stmt4->execute();
        $stmt4->close();

        $stmt5 = $conn->prepare("SELECT accountID FROM account WHERE accName = ?");
        $stmt5->bind_param("s", $accName);
        $stmt5->execute();
        $result5 = $stmt5->get_result();
        if($result5->num_rows === 0) exit('No rows');
        while($row5 = $result5->fetch_assoc()) {
            $accountID = $row5['accountID'];
        }
        $stmt5->close();

        $stmt6 = $conn->prepare("INSERT INTO shows (accountID, purchaseID) VALUES (?,?)");
        $stmt6->bind_param("ii", $accountID, $purchaseID);
        $stmt6->execute();
        $stmt6->close();


    }   
    $conn->close();
    header("Location: ../purchaseHistory.php");
} else {
    header("Location: ../purchase.php");
    exit();
}

