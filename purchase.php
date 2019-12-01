<?php   
    if ($_POST['seshVar']) {
        require 'navigation.php';
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
                <label for="formControlSelect1">Who Are You?</label>
            
                <select class="form-control col-width" id="exampleFormControlSelect1">
                    <?php
                        $sql2 = "SELECT * FROM user";  
                        $result2 = $conn->query($sql2); 
                            while($row2 = $result2->fetch_assoc()){
                        ?>
                    <option><?php echo $row2['name']; ?></option>
                  <?php
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
            $sql = "SELECT * FROM item WHERE itemName IN ('$entries')";
            $result = $conn->query($sql);   
                while($row = $result->fetch_assoc()){
            ?>
            <tr>
                <td><?php echo $row['itemName']; ?></td>
                <td><?php echo $row['brand']; ?></td>
                <td><?php echo $row['quantity']; ?></td>
                <td><?php echo $row['notes']; ?></td>
                <td class="col-width"><div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
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
    <a href="index.php" class="btn btn-link float-right d-inline" role="button">Go Back</a>
    
    </div>

    
    <script>
    </script>            

</body>
</html>

