<?php   
    if (isset($_SESSION['accountName'])) {
		require 'functional/db_config.php';
		$conn = new mysqli($servername, $username, $password, $database);
		if ($conn->connect_error) die($conn->connect_error);

		if (!$conn) {
		    die("Connection failed: ".mysqli_connect_error());
        }
        
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
        <form method="post" action="purchase.php">
        <table class="table text-center">
        <thead class="thead-dark">
            <tr>
            <th>Priority</th>
            <th>Item Name</th>
            <th>Brand</th>
            <th>Quantity</th>
            <th>Notes</th>
            <th>Selection</th>
            </tr>
        </thead>
        <tbody>
        
            <?php

            $accountName = $_SESSION['accountName'];
            $sql = "SELECT * FROM item
            JOIN contains USING(itemID)
            JOIN personal_list USING(personalListID)
            JOIN owns USING (personalListID)
            JOIN user USING(userID)
            JOIN has USING (userID)
            JOIN account USING (accountID)
            WHERE accName='$accountName' ORDER BY priority DESC";  
            $result = $conn->query($sql);   
                while($row = $result->fetch_assoc()){
            ?>
            <tr>
                <td><?php echo $row['priority']; ?></td>
                <td><?php echo $row['itemName']; ?></td>
                <td><?php echo $row['brand']; ?></td>
                <td><?php echo $row['quantity']; ?></td>
                <td><?php echo $row['notes']; ?></td>
                    <?php echo '<td><input type="checkbox" name="check_list[]" value="'. $row['itemName']. '" class="checkbox-style"?></td>';?>
            </tr>
            <?php
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
