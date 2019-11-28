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
	<h2>Welcome, <?php echo $accName ?>!</h2>
	<h4>Pick a user or add new profile!</h4>

	<!-- <div class="card text-center bg-light mb-3">
      <div class="card-body">
        <h5 class="card-title">Name</h5>
        <a href="#" class="btn btn-primary">Choose</a>
      </div>
    </div> -->
	<?php
	$count = 0;

	$sql = "SELECT name FROM account JOIN has USING (accName) JOIN user USING (userID) WHERE accName='$accName' ORDER BY name";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	// output data of each row	
		while($row = $result->fetch_assoc()) {
		
			if (($count%4)==0) {
				echo "<div class='card-deck'>";
			}
			echo "<div class='card text-center bg-light mb-3'>
					<div class='card-body'>
		        		<h5 class='card-title'>" . $row["name"]. "</h5>
		        		<a href='#' class='btn btn-primary'>Choose</a>
					  </div>
				  </div>";
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
