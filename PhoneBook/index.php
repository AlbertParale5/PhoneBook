<?php
	//include database
	include "includes/model.inc.php";

	$obj = new Model();

	//Insert Record
	if (isset($_POST['submit'])) {
		$obj->insertRecord($_POST);
	}

	//Update Record
	if (isset($_POST['update'])) {
		$obj->updateRecord($_POST);
	}

	//Delete Record
	if(isset($_GET['deleteid'])){
		$delid = $_GET['deleteid'];
		$obj->deleteRecord($delid);
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		
		<title>Phone Book</title>
	</head>
	<body style="background: #EAEAEA;">
		<h2 class="text-center  mt-4 mb-3">PHONE BOOK</h2><br>

		<div class="container ">
				<div class="row">
					<div class="card shadow-sm p-3 mb-5 w-50 mx-auto">
						<?php
							if (isset($_GET['editid'])) {
								$editid = $_GET['editid'];
								$myrecord = $obj->displayRecordById($editid);
						?>
						<form action="index.php" method="POST" class="mt-2 mb-4">
							<div class="card-header">
								<h5>UPDATE CONTACTS</h5>
							</div>
							<div class="form-group">
								<label>First Name:</label>
								<input type="text" name="fname" value="<?php echo $myrecord['firstname'];?>" placeholder="Enter your firstname name" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Last Name:</label>
								<input type="text" name="lname" value="<?php echo $myrecord['lastname'];?>" placeholder="Enter your last name" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Phone Number:</label>
								<input type="number" name="number" value="<?php echo $myrecord['number'];?>" placeholder="Enter your phone number" class="form-control" required>
							</div>
							<div class="form-group mt-4 text-center">
								<input type="hidden" name="hid" value="<?php echo $myrecord['id'];?>">
								<input type="submit" name="update" value="Update" class="btn btn-info">
								<a href="index.php" class="btn btn-danger">Cancel</a>
							</div>
						</form>


						<?php	
							}else{
						?>
						
						<form action="index.php" method="POST" class="mt-2 mb-4">
							<div class="card-header">
								<h5>ADD CONTACTS</h5>
							</div>
							<div class="form-group">
								<label>First Name:</label>
								<input type="text" name="fname" placeholder="Enter your first name" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Last Name:</label>
								<input type="text" name="lname" placeholder="Enter your last name" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Phone Number:</label>
								<input type="number" name="number" placeholder="Enter your phone number" class="form-control" required>
							</div>
							<div class="form-group mt-4 text-center">
								<input type="submit" name="submit" value="Submit" class="btn btn-info">
							</div>
						</form>
						<?php }?>
					</div>
				</div>
			<br>
			<h4 class="text-center "> PHONEBOOK RECORDS</h4>
			<table class="table table-bordered ">
				<tr class="alert-dark text-center">
					<th>First Name</th>
					<th>Last Name</th>
					<th>Phone Number</th>
					<th>Action</th>

				</tr>
				<?php
					//Display Records
					$data = $obj->displayRecord();
					foreach ($data as $value) {
				?>
				<tr class="text-center">
					<td><?php echo $value['firstname'];?></td>
					<td><?php echo $value['lastname'];?></td>
					<td><?php echo $value['number'];?></td>
					<td>
						<a href="index.php?editid=<?php echo $value['id'];?>" class="btn btn-info">EDIT</a>
						<a href="index.php?deleteid=<?php echo $value['id']; ?>" class="btn btn-danger">DELETE</a>
					</td>
				</tr>
				<?php
					}
				?>
			</table>
		</div>
	</body>
</html>