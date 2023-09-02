<?php require_once("connection.php"); ?>
<?php

	checkLevel(1, 9, 9, 1, 1, 9, 9, 9, 9, 9);


	if(isset($_GET["page"])) {
		$page = $_GET["page"];
	}
	else {
		$page = 1;
	}

	$allpatient_test = mysqli_query($con, "SELECT * FROM patient_test LEFT JOIN patient ON patient.patient_id = patient_test.patient_id");
	$row_allpatient_test = mysqli_fetch_assoc($allpatient_test);

	
	$alltest = mysqli_query($con, "SELECT * FROM patient_test LEFT JOIN test ON test.test_id = test.test_id");
	$row_alltest = mysqli_fetch_assoc($alltest);
	
	$totalrows = mysqli_num_rows($allpatient_test);
	$rows_per_page = 7;
	$totalpage = ceil($totalrows / $rows_per_page);

	$offset = ($page - 1) * $rows_per_page;
	
	$patient_test = mysqli_query($con, "SELECT *, test.test_name, test.test_id FROM patient_test LEFT JOIN patient ON patient.patient_id = patient_test.patient_id LEFT JOIN test ON test.test_id = patient_test.test_id LIMIT $offset, $rows_per_page");

	$row_patient_test = mysqli_fetch_assoc($patient_test);

	$test = mysqli_query($con, "SELECT * FROM patient_test LEFT JOIN test ON test.test_id = patient_test.test_id LIMIT $offset, $rows_per_page");
	$row_patient_test = mysqli_fetch_assoc($patient_test);

?>
<?php require_once("header.php"); ?>

<a href="#" id="print" class="noprint btn btn-primary pull-right">
	<span class="glyphicon glyphicon-print"></span> 
	Print
</a>

<h2>Patient Test List after visit by Doctor</h2>

<?php if(isset($_GET["add"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		New patient test has been successfully added!
	</div>
<?php } ?>

<?php if(isset($_GET["edit"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected patient test has been successfully updated!
	</div>
<?php } ?>

<?php if(isset($_GET["delete"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected patient test has been successfully deleted!
	</div>
<?php } ?>

<?php if(isset($_GET["error"])) { ?>
	<div class="alert alert-danger alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Could not delete selected patient test!
	</div>
<?php } ?>

<table class="table table-striped">
	<tr>
		<th>S/N</th>
		<th>Patient ID</th>
		<th>Test ID</th>
		<th>Test Name</th>
		<th>Test Date</th>
		<th>Test Result</th>
		<th class="noprint">Edit</th>
		<th class="noprint">Delete</th>
	</tr>

	<?php $x = 1; do { ?>
	<tr>
		<td><?php echo $x++; ?></td>
		<td><?php echo $row_patient_test["patient_id"]; ?></td>
		<td><?php echo $row_patient_test["test_id"]; ?></td>
		<td><?php echo $row_patient_test["test_name"]; ?></td>
		<td><?php echo $row_patient_test["test_date"]; ?></td>
		<td><?php echo $row_patient_test["test_result"]; ?></td>
   

        <td class="noprint">
			<a href="patient_test_edit.php?patient_test_id=<?php echo $row_patient_test["patient_test_id"]; ?>">
				<span class="glyphicon glyphicon-edit"></span>
			</a>
		</td>
		<td class="noprint">
			<a class="delete" href="patient_test_delete.php?patient_test_id=<?php echo $row_patient_test["patient_test_id"]; ?>">
				<span class="glyphicon glyphicon-trash"></span>
			</a>
		</td>
	
	
	</tr>
	<?php } while($row_patient_test = mysqli_fetch_assoc($patient_test)); ?>
	
</table>


<ul class="pagination noprint">
<?php if($page != 1) { ?>
	<li><a href="patient_test_list.php?page=1">
		First 
	</a></li>
<?php } ?>

<?php if($page > 1) { ?>
	<li><a href="patient_test_list.php?page=<?php echo $page-1; ?>">
		Previous 
	</a></li>
<?php } ?>

<?php if($page < $totalpage) { ?>
	<li><a href="patient_test_list.php?page=<?php echo $page+1; ?>">
		Next
	</a></li>
<?php } ?>

<?php if($page != $totalpage) { ?>
	<li><a href="patient_test_list.php?page=<?php echo $totalpage; ?>">
		Last
	</a></li>
<?php } ?>
</ul>

<br>

<ul class="pagination noprint">
<?php for($x=1; $x<=$totalpage; $x++) { ?>
	<li>
		<?php if($x != $page) { ?>
			<a href="patient_test_list.php?page=<?php echo $x; ?>">
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