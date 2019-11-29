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

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Groceries</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Personal Care</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false">Clothing</a>
        </li>
 
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
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
                
                <?php 
                    $pickedRow;
                ?>
            </tbody>
            </table>
            </form>

        </div>
        <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
        <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">...</div>
    </div>

    
   
    
    </div>
  
    <script>
    $(function () {
        $('#myTab li:first-child a').tab('show')
    })

    
    </script>            

</body>
</html>

/**
NOTES:

    1. Base yourself off of https://www.sourcecodester.com/php/11847/simple-ordering-app-using-phpmysqli.html
       for purchase transaction on AccountHOme page...this will execute action on purchase_functional.php
    
            a) if isset then add to purchase history on form action
    2. For personallist, every user can have multiple personal lists. 
       HOWEVER, their max will be 6 or whatever the number of unique types (ie Groceries, Electronics).
       Each user can have only one list of each type.

 */