<?php require_once("connection.php"); ?>
<?php

	$condition = "";

	if(isset($_GET["q"])) {
		$search = getValue($_GET["q"]);
		$condition = " WHERE   medicine_name LIKE '%$search%' ";
	}
	
	$medicine = mysqli_query($con, "SELECT * FROM medicine $condition ORDER BY medicine_id ASC");
	$row_medicine = mysqli_fetch_assoc($medicine);
	
	$totalRows_medicine = mysqli_num_rows($medicine);
	
?>
<?php require_once("header.php"); ?>

<h2>Medicine List</h2>

<?php if(isset($_GET["add"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		New Medicine has been successfully added!
	</div>
<?php } ?>

<?php if(isset($_GET["edit"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected Medicine has been successfully updated!
	</div>
<?php } ?>

<?php if(isset($_GET["delete"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected Medicine has been successfully deleted!
	</div>
<?php } ?>

<?php if(isset($_GET["error"])) { ?>
	<div class="alert alert-danger alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Could not delete selected Medicine!
	</div>
<?php } ?>

<form method="get">
	<div class="input-group">
		<span class="input-group-addon">
			Search:
		</span>
		<input type="text" name="q" class="form-control">
		<span class="input-group-btn">
			<button class="btn btn-primary">
				<span style="color:white;" class="glyphicon glyphicon-search"></span>
			</button>
		</span>
	</div>
</form>

<?php if(isset($_GET["q"])) { ?>
<div style="font-size:18px;">
	<b>Search for: <?php echo $_GET["q"]; ?></b>
	<br>
	<b>Total Result: <?php echo $totalRows_medicine; ?></b>
</div>
<?php } ?>


<?php if($totalRows_medicine > 0) { ?>
<table class="table table-striped">
	<tr>
		<th>ID</th>
		<th>Medicine Name</th>
        <th>Description</th>
		<th>Form</th>
		<th>Quantity</th>
		<th>Unitprice</th>
		<th>Expire Date</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	
	<?php do { ?>
		<tr>
			<td><?php echo $row_medicine["medicine_id"]; ?></td>
			<td><?php echo $row_medicine["medicine_name"]; ?></td>
            <td><?php echo $row_medicine["description"]; ?></td>
			<td><?php echo $row_medicine["form"]; ?></td>
			<td><?php echo $row_medicine["quantity"]; ?></td>
			<td><?php echo $row_medicine["unitprice"]; ?></td>
			<td><?php echo $row_medicine["expire_date"]; ?></td>
			<td>
				<a href="medicine_edit.php?medicine_id=<?php echo $row_medicine["medicine_id"]; ?>">
					<span class="glyphicon glyphicon-edit"></span>
				</a>
			</td>
			<td>
				<a class="delete" href="medicine_delete.php?medicine_id=<?php echo $row_medicine["medicine_id"]; ?>">
					<span class="glyphicon glyphicon-trash"></span>
				</a>
			</td>
		</tr>
	<?php } while($row_medicine = mysqli_fetch_assoc($medicine)); ?>
	
</table>
<?php } else { ?>
	<div class="alert alert-warning text-center">
		<h3 style="border:none;">No Result Found!</h3>
	</div>
<?php } ?>


<?php require_once("footer_mis.php"); ?>