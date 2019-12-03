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

<?php 

		if (isset($_POST['submit']) || isset($_GET['mark'])) {
			
			if (isset($_GET['mark'])){
				$user = json_decode(base64_decode($_GET['mark']));
				$user = sanitizeString($user);
			} else {
				$user = $_POST['name'];
			}
		
			$_SESSION['profile'] = $user;
		}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-6">
				<form action="functional/add_item.php" method="post">
					<h3>Add to Your List</h3>
					<div class="form-inline mb-2">
						<div class="form-group">
							<label for="itemName">Item Name</label>
							<input type="text" class="form-control ml-2" id="itemName" name="itemName" required>
						</div>

					</div>
					<div class="form-inline mb-2">
						<div class="form-group">
							<label for="brand">Brand</label>
							<input type="text" class="form-control ml-2" id="brand" name="brand">
						</div>
					</div>
					<div class="form-inline mb-2">
						<div class="form-group mr-5">
							<label for="quantity">Quantity</label>
							<input type="number" class="form-control ml-2" id="quantity" name="quantity" min="1" value="1" step="1" required>
						</div>
						<div class="form-group">
							<label for="priority">Priority</label>
							<select class="form-control ml-2 custom-select" name="priority" required>
								<option selected>Choose</option>
								<option value="1">1-Lowest</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5-Highest</option>
							</select>
						</div>
					</div>
					<div class="form-inline form-group mb-2">
						<label for="notes">Notes</label>
						<input type="text" class="form-control ml-2" name="notes" id="notes">
					</div>
					<button type="submit" name="submit" class="btn btn-primary">Submit</button>
					<a href="personalHome.php" class="btn btn-link link-style">Go Back</a>
				</form>
			</div>
		</div>
		<h3><?php echo $user;?>'s List</h3>

		<table style="width:100%" class="table text-center table-responsive-sm">
			<thead class="thead-dark">
				<tr>
					<th>Items</th>
					<th>Brand</th>
					<th>Quantity</th>
					<th>Priority</th>
					<th>Notes</th>
					<th>Bought</th>
				</tr>
			</thead>
			<tbody>
				<?php

				    $query = "SELECT userID
							  FROM account
							  JOIN has USING(accountID)
							  JOIN user USING(userID)
							  WHERE accName='$accName'
							  AND name='$user'";

				    $result = mysqli_query($conn, $query);
				    if ( ! $result ) die(mysqli_error());
				    $userID = mysqli_fetch_assoc($result);
				    $user_id = $userID['userID'];

				    $sql = "SELECT *
							FROM account
							JOIN has USING(accountID) 
							JOIN user USING(userID)
							JOIN owns USING (userID)
							JOIN contains USING(personalListID)
							JOIN item USING (itemID)
							WHERE accName='$accName'
							AND userID='$user_id'
							ORDER BY priority DESC";

	    			$result = $conn->query($sql);
					if ($result->num_rows > 0) {
					// output data of each row	
						while($row = $result->fetch_assoc()) {

							$itemID = $row['itemID'];
							$name = $row['itemName'];
							$brand = $row['brand'];
							$quantity = $row['quantity'];
							$priority = $row['priority'];
							$notes = $row['notes'];

							$sql2 = "SELECT item.itemID, itemName
									FROM item, records, purchase_history
									WHERE item.itemID = records.itemID
									AND records.purchaseID = purchase_history.purchaseID
									AND item.itemID = $itemID";
							$result2 = $conn->query($sql2);
							
							if($result2->num_rows != 0) {
								$checkMark = "<i class='fa fa-check-square'></i>";
							} else {
								$checkMark = "";
							}
							
							echo "<tr>
									<td>$name</td>
									<td>$brand</td>
									<td>$quantity</td><td>";
							for ($i=0; $i < $priority; $i++) 
								{echo "<span class='fa fa-exclamation'></span>";}
							echo "</td><td>$notes</td>
									<td>$checkMark</td>
								  </tr>";
						}
					} else { echo "Your list is currently empty"; }
					
					$conn->close();
				
				?>
			</tbody>
		</table>
	</div>
	<script>
	</script>
</body>
</html>

<?php 
	function sanitizeString($var) {
		$var = stripslashes($var);
		$var = strip_tags($var);
		$var = htmlentities($var);
		return $var;
	}

?>