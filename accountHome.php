<?php   
    if (isset($_SESSION['accountName'])) {
		require 'functional/db_config.php';
		$conn = new mysqli($servername, $username, $password, $database);
		if ($conn->connect_error) die($conn->connect_error);

		if (!$conn) {
		    die("Connection failed: ".mysqli_connect_error());
        }
        $accountName = $_SESSION['accountName'];
        
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
        <div><h1>Main Shopping List</h1></div>
        <div><h5>Select the Items You Bought</h5></div>
        <form method="post" action="purchase.php">
        <table class="table text-center">
        <thead class="thead-dark">
            <tr>
            <th>Priority</th>
            <th>Item Name</th>
            <th>Brand</th>
            <th>Quantity</th>
            <th>Notes</th>
            <th>Item Bought</th>
            </tr>
        </thead>
        <tbody>
        
            <?php
            $sql = "SELECT *
                    FROM item
                    NATURAL JOIN contains
                    NATURAL JOIN personal_list
                    NATURAL JOIN owns
                    NATURAL JOIN user
                    NATURAL JOIN has
                    NATURAL JOIN account
                    WHERE accName = '$accountName'
                    AND itemID NOT IN
                    (SELECT item.itemID FROM item, purchase_history, records WHERE item.itemID = records.itemID AND records.purchaseID = purchase_history.purchaseID)
                    ORDER BY priority DESC";  
            $result = $conn->query($sql);
            if($result) {
                while($row = $result->fetch_assoc()){
            ?>
                <tr>
                    <td><?php for ($i=0; $i < $row['priority']; $i++) { 
                        echo "<span class='fa fa-star checked'></span>";
                    } ?></td>
                    <td><?php echo $row['itemName']; ?></td>
                    <td><?php echo $row['brand']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo $row['notes']; ?></td>
                        <?php echo '<td><input type="checkbox" name="check_list[]" value="'. $row['itemID']. '" class="checkbox-style"?></td>';?>
                </tr>
            <?php
                }   
            }
            ?>
            <?php echo '<input type="hidden" name="seshVar" value="'.$_SESSION['accountName'].'">';?>
           
        </tbody>
        </table>
            <button type="submit" name="submit" class="btn btn-primary float-right">
                Choose
            </button>
  
        </form>
    </div>
   
    
    </div>
  
    <script>

    </script>            

</body>
</html>
