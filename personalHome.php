<?php 
	if (session_status()) {
        require 'navigation.php';
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
	<h2>Welcome, <?php echo $_SESSION['accountName'] ?>!</h2>
	<h4>Pick a user or add new profile!</h4>
    <div class="card-deck">
    	<div class="card text-center bg-light mb-3">
	      <div class="card-body">
	        <h5 class="card-title">Person1</h5>
	        <a href="#" class="btn btn-primary">Choose</a>
	      </div>
	    </div>
	    <div class="card text-center bg-light mb-3">
	      <div class="card-body">
	        <h5 class="card-title">Person2</h5>
	        <a href="#" class="btn btn-primary">Choose</a>
	      </div>
	    </div>
	    <div class="card text-center bg-light mb-3">
	      <div class="card-body">
	        <h5 class="card-title">Person3</h5>
	        <a href="#" class="btn btn-primary">Choose</a>
	      </div>
	    </div>
    </div>
</div>







<button class="open-button" onclick="openForm()">Create New Profile</button>

<div class="form-popup" id="myForm">
  <form action="functional/add_user.php" class="form-container" method="post">
    <h1>New Profile</h1>

    <label for="userName"><b>Name</b></label>
    <input type="text" placeholder="Enter Name" name="userName" required>

    <label for="pin"><b>PIN</b></label>
    <input type="password" pattern="[0-9]{4}" placeholder="Enter PIN" name="pin" maxlength="4" required>

    <button type="submit" class="btn" name="submit">Add</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
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
