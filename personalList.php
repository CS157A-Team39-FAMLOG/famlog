<?php 
require 'navigation.php';
require 'functional/db_config.php';

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) die($conn->connect_error);

if (!$conn) {
	die("Connection failed: ".mysqli_connect_error());
}

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-6">
				<form>
					<h3>Add to wishlist</h3>
					<div class="form-inline mb-2">
						<div class="form-group">
							<label for="itemName">Item Name</label>
							<input type="text" class="form-control ml-2" id="itemName" name="itemName" pattern="a-zA-Z" required>
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
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
		<h3>Your Current List</h3>
		<table style="width:100%" class="table table-striped text-center table-hover table-responsive-sm">
			<thead class="thead-dark">
				<tr>
					<th>Items</th>
					<th>Quantity</th>
					<th>Priority</th>
					<th>Notes</th>
					<th>Remove</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Jill</td>
					<td>Smith</td>
					<td>50</td>
					<td>50</td>
					<td><button class="btn"><i class="fa fa-trash"></i></button></td>
					
				</tr>
				<tr>
					<td>Eve</td>
					<td>Jackson</td>
					<td>94</td>
					<td>94</td>
					<td><button class="btn"><i class="fa fa-trash"></i></button></td>
				</tr>
				<tr>
					<td>Eve</td>
					<td>Jackson</td>
					<td>94</td>
					<td>94</td>
					<td><button class="btn"><i class="fa fa-trash"></i></button></td>
				</tr>
				<tr>
					<td>Eve</td>
					<td>Jackson</td>
					<td>94</td>
					<td>94</td>
					<td><button class="btn"><i class="fa fa-trash"></i></button></td>
				</tr>
			</tbody>
		</table> 
	</div>
</body>
</html>