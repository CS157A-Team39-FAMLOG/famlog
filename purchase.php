<?php   
    if ($_POST['seshVar']) {
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
<?php 
    $checkedItems = array();
    if(isset($_POST['submit'])){
        if(!empty($_POST['check_list'])){
            foreach($_POST['check_list'] as $selected){
                $checkedItems[] = $selected;
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/purchaseStyle.css">
</head>
<body>
    
    <div class="container">
    
    <form method="post" action="functional/purchase_functional.php">
        <table class="table text-center">

            <div class="form-group">
                <label class="label-style" for="formControlSelect1">Who Bought These Items?</label>
                <div><p>Please select your name from the list and fill in the prices of the items</p></div>
            
                <select class="form-control col-width" name="buyer">
                    <?php
                        $sql2 = "SELECT * FROM user, has, account
                                WHERE user.userID = has.userID
                                AND has.accountID = account.accountID
                                AND accName='$accName'";  
                        $result2 = $conn->query($sql2); 
                            while($row2 = $result2->fetch_assoc()){
                                echo "<option value=".$row2['name'].">".$row2['name']."</option>"; 
                        }
                    ?>
                </select>
            </div>
         
        <thead class="thead-dark">
            <tr>
            <th>Item Name</th>
            <th>Brand</th>
            <th>Quantity</th>
            <th>Notes</th>
            <th>Price</th>
            </tr>
        </thead>
        <tbody>
        
            <?php
            $entries = join("','",$checkedItems);   
            $sql = "SELECT * FROM item WHERE itemID IN ('$entries')";
            $result = $conn->query($sql);   
                while($row = $result->fetch_assoc()){
            ?>
            <tr>
                <td class="align-middle"><?php echo $row['itemName']; ?></td>
                <td class="align-middle"><?php echo $row['brand']; ?></td>
                <td class="align-middle"><?php echo $row['quantity']; ?></td>
                <td class="align-middle"><?php echo $row['notes']; ?></td>
                <td class="col-width"><div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="hidden" name="item_id[]" value="<?php echo $row['itemID'] ?>">
                        <input type="number" step="0.01" min="0" placeholder="0.00" class="form-control" name="prices[]" required>
                    </div>
                </td>
            </tr>
            <?php
            }
            ?>
           
        </tbody>
        </table>
            <button type="submit" name="submit" class="btn btn-success float-right">
                Confirm
            </button>
            
        </form>
    <a href="index.php" class="btn btn-link link-style float-right d-inline" role="button">Go Back</a>
    
    </div>

    <script>
    </script>            

</body>
</html>

