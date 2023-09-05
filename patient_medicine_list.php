<?php require_once("connection.php"); ?>
<?php

	checkLevel(1, 9, 9, 1, 1, 9, 9, 9, 9, 9);

	if(isset($_GET["page"])) {
		$page = $_GET["page"];
	}
	else {
		$page = 1;
	}

	$allpatient_record = mysqli_query($con, "SELECT * FROM patient_record LEFT JOIN patient ON patient.patient_id = patient_record.patient_id");
	$row_allpatient_record = mysqli_fetch_assoc($allpatient_record);
	
	$totalrows = mysqli_num_rows($allpatient_record);
	$rows_per_page = 7;
	$totalpage = ceil($totalrows / $rows_per_page);

	$offset = ($page - 1) * $rows_per_page;
	
	$patient_medicine = mysqli_query($con, "SELECT * FROM patient_medicine LEFT JOIN patient ON patient.patient_id = patient_medicine.patient_id LIMIT $offset, $rows_per_page");
	$row_patient_medicine = mysqli_fetch_assoc($patient_medicine);

?>
<?php require_once("header.php"); ?>

<a href="#" id="print" class="noprint btn btn-primary pull-right">
	<span class="glyphicon glyphicon-print"></span> 
	Print
</a>

<h2>Patient Medicine List after visit by Doctor</h2>

<?php if(isset($_GET["add"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		New patient medicine has been successfully added!
	</div>
<?php } ?>

<?php if(isset($_GET["edit"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected patient medicine has been successfully updated!
	</div>
<?php } ?>

<?php if(isset($_GET["delete"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected patient medicine has been successfully deleted!
	</div>
<?php } ?>

<?php if(isset($_GET["error"])) { ?>
	<div class="alert alert-danger alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Could not delete selected patient medicine!
	</div>
<?php } ?>

<?php if(mysqli_num_rows($patient_medicine) == 0) { ?>
	<div class="alert alert-warning">
		No result found.
	</div>
<?php } else { ?>
	<table class="table table-striped">
		<tr>
			<th>S/N</th>
			<th>Patient ID</th>
			<th>Medicine Name</th>
			<th>Quantity</th>
			<th>Unitprice</th>
	        <th>Totalprice</th>
	        <th>Apply Date</th>
			<th class="noprint">Edit</th>
			<th class="noprint">Delete</th>
		</tr>

		<?php $x = 1; do { ?>
		<tr>
			<td><?php echo $x++; ?></td>
			<td><?php echo $row_patient_medicine["patient_id"]; ?></td>
			<td><?php echo $row_patient_medicine["medicine"]; ?></td>
			<td><?php echo $row_patient_medicine["quantity"]; ?></td>
	        <td><?php echo $row_patient_medicine["unitprice"]; ?></td>
	        <td><?php echo $row_patient_medicine["totalprice"]; ?></td>
	        <td><?php echo $row_patient_medicine["apply_date"]; ?></td>

	        <td class="noprint">
				<a href="patient_medicine_edit.php?patient_medicine_id=<?php echo $row_patient_medicine["patient_medicine_id"]; ?>">
					<span class="glyphicon glyphicon-edit"></span>
				</a>
			</td>
			<td class="noprint">
				<a class="delete" href="patient_medicine_delete.php?patient_medicine_id=<?php echo $row_patient_medicine["patient_medicine_id"]; ?>">
					<span class="glyphicon glyphicon-trash"></span>
				</a>
			</td>
		</tr>
		<?php } while($row_patient_medicine = mysqli_fetch_assoc($patient_medicine)); ?>
	</table>
<?php } ?>

<ul class="pagination noprint">
<?php if($page != 1) { ?>
	<li><a href="patient_medicine_list.php?page=1">
		First 
	</a></li>
<?php } ?>

<?php if($page > 1) { ?>
	<li><a href="patient_medicine_list.php?page=<?php echo $page-1; ?>">
		Previous 
	</a></li>
<?php } ?>

<?php if($page < $totalpage) { ?>
	<li><a href="patient_medicine_list.php?page=<?php echo $page+1; ?>">
		Next
	</a></li>
<?php } ?>

<?php if($page != $totalpage) { ?>
	<li><a href="patient_medicine_list.php?page=<?php echo $totalpage; ?>">
		Last
	</a></li>
<?php } ?>
</ul>

<br>

<ul class="pagination noprint">
<?php for($x=1; $x<=$totalpage; $x++) { ?>
	<li>
		<?php if($x != $page) { ?>
			<a href="patient_medicine_list.php?page=<?php echo $x; ?>">
				<?php echo $x; ?>
			</a>
		<?php } else { ?>
			<a href="#">
				<?php echo $x; ?>
			</a>
		<?php } ?>
	</li>
<?php } ?>
</ul>

<?php require_once("footer_mis.php"); ?>
