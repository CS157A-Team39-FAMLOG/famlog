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
    <link rel="stylesheet" type="text/css" href="css/personalStyle.css">
</head>
<body>
    
    <div class="container">
        <form method="POST" action="functional/purchase_functional.php">
        <table class="table">
        <thead class="thead-dark">
            <tr>
            <th><a>Priority</a></th>
            <th><a>Item Name</a></th>
            <th><a >Brand</a></th>
            <th><a>Quantity</a></th>
            <th><a>Notes</a></th>
            <th><a>Price</a></th>
            </tr>
        </thead>
        <tbody>
        
            <?php
            $sql = "SELECT * FROM item ORDER BY priority DESC";  
            $result = $conn->query($sql);   
                while($row = $result->fetch_assoc()){
            ?>
            <tr>
                <td><?php echo $row['priority']; ?></td>
                <td><?php echo $row['itemName']; ?></td>
                <td><?php echo $row['brand']; ?></td>
                <td><?php echo $row['quantity']; ?></td>
                <td><?php echo $row['notes']; ?></td>
                <?php echo '<td><input type="text" name="'. $row['itemID']. '" class="form-control"?></td'; 
                ?>
            </tr>
            <?php
            }
            ?>
            
        </tbody>
        </table>
        </form>
    </div>

    
   
    
    </div>
  
    <script>
    $(function () {
        $('#myTab li:first-child a').tab('show')
    })

    
    </script>            

</body>
</html>
