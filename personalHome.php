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
<link rel="stylesheet" type="text/css" href="css/personalStyle.css">
</head>
<body>

<!-- Display all profiles of this account-->
<div class="container">
	<h1>Welcome, <?php echo $accName ?>!</h1>
	<h3>Pick a user or add new profile!</h3>
	<br>
	<?php
	$count = 0;

	$sql = "SELECT name FROM account JOIN has USING (accountID) JOIN user USING (userID) WHERE accName='$accName' ORDER BY name";
	$result = $conn->query($sql);
	if (!empty($result) && $result->num_rows > 0) {
	// output data of each row	
		while($row = $result->fetch_assoc()) {
		
			if (($count%4)==0) {
				echo "<div class='card-deck'>";
			}
			$name = $row['name'];
			switch ($count%5) {
				case 0:
					echo "<div class='card text-center bg-info mb-3'>";
					break;
				case 1:
					echo "<div class='card text-center bg-warning mb-3'>";
					break;
				case 2:
					echo "<div class='card text-center bg-success mb-3'>";
					break;
				case 3:
					echo "<div class='card text-center bg-light mb-3'>";
					break;
				case 4:
					echo "<div class='card text-center bg-danger mb-3'>";
					break;
			}
			echo "<div class='card-body'>
		        <h5 class='card-title'>$name</h5><form action='personalList.php' method='post'>
				  <input type='hidden' name='name' value=$name>
		      	<input class='btn btn-dark' type='submit' name='submit' value='Choose'>
		      </form>
		      </div></div>";

		    if (($count%4)==3) {
		    	echo "</div>";
		    }
		    $count++;
		}
	} else { echo "0 results"; }
	$conn->close();
	?>
</div>
<button class="btn btn-info open-button" onclick="openForm()"><i class="fa fa-user-plus"></i></button>

<div class="form-popup" id="myForm">
  <form action="functional/add_user.php" class="form-container" method="post">
    <h1>New Profile</h1>

    <label for="userName"><b>Name</b></label>
    <input type="text" placeholder="Enter Name" name="userName" required>

    <button type="submit" class="btn btn-primary" name="submit">Add</button>
    <button type="button" class="btn btn-danger" onclick="closeForm()">Close</button>
  </form>
</div>

<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>

</body>
</html>
