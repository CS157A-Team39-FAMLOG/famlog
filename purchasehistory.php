<?php 
	if (session_status()) {
        require 'navigation.php';
		require 'functional/db_config.php';
		$conn = new mysqli($servername, $username, $password, $database);
		if ($conn->connect_error) die($conn->connect_error);

		if (!$conn) {
		    die("Connection failed: ".mysqli_connect_error());
		}
    	$accName = $_SESSION['accountName'];

    } else {
        header("Location: ../index.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/accountHomeStyle.css">
</head>
<body>
    
    <div class="container">
        <table class="table text-center">
        <thead class="thead-dark">
            <tr>
            <th>Item Name</th>
            <th>Requested By</th>
            <th>Bought By</th>
            <th>Quantity</th>
            <th>Date Purchased</th>
            <th>Price</th>
            </tr>
        </thead>
        <tbody>
        
            <?php

            $sql = "SELECT itemName, belongsTo, buyer, purchase_history.quantity, datePurchased, price
                    FROM purchase_history, account, item, records
                    WHERE item.itemID = records.itemID AND accName='$accName' AND records.purchaseID = purchase_history.purchaseID";  
             $result = $conn->query($sql);   
             if($result) {
                while($row = $result->fetch_assoc()){
            ?>
                <tr>
                    <td><?php echo $row['itemName']; ?></td>
                    <td><?php echo $row['belongsTo']; ?></td>
                    <td><?php echo $row['buyer']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo $row['datePurchased']; ?></td>
                    <td><span>$</span><?php echo $row['price']; ?></td>
                </tr>
            <?php
                }
            }
            ?>
           
        </tbody>
        </table>
        <a href="index.php" class="btn btn-link float-right d-inline" role="button">Go Back</a>
    </div>
   
    
    </div>
  
    <script>

    </script>            

</body>
</html>
