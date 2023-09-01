<?php require_once("connection.php"); ?>
<?php

	$condition = "";

	if(isset($_GET["q"])) {
		$search = getValue($_GET["q"]);
		$condition = " WHERE test_name LIKE '%$search%' ";
	}
	
	$test = mysqli_query($con, "SELECT * FROM test $condition ORDER BY test_id ASC");
	$row_test = mysqli_fetch_assoc($test);
	
	$totalRows_test = mysqli_num_rows($test);
	
?>
<?php require_once("header.php"); ?>

<h2>Test List</h2>

<?php if(isset($_GET["add"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		New Test has been successfully added!
	</div>
<?php } ?>

<?php if(isset($_GET["edit"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected test has been successfully updated!
	</div>
<?php } ?>

<?php if(isset($_GET["delete"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected test has been successfully deleted!
	</div>
<?php } ?>

<?php if(isset($_GET["error"])) { ?>
	<div class="alert alert-danger alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Could not delete selected test!
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
	<b>Total Result: <?php echo $totalRows_test; ?></b>
</div>
<?php } ?>


<?php if($totalRows_test > 0) { ?>
<table class="table table-striped">
	<tr>
		<th>ID</th>
		<th>Test Name</th>
        <th>Test Type</th>
        <th>Test Price</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	
	<?php do { ?>
		<tr>
			<td><?php echo $row_test["test_id"]; ?></td>
			<td><?php echo $row_test["test_name"]; ?></td>
            <td><?php echo $row_test["test_type"]; ?></td>
            <td><?php echo $row_test["price"]; ?></td>
			<td>
				<a href="test_edit.php?test_id=<?php echo $row_test["test_id"]; ?>">
					<span class="glyphicon glyphicon-edit"></span>
				</a>
			</td>
			<td>
				<a class="delete" href="test_delete.php?test_id=<?php echo $row_test["test_id"]; ?>">
					<span class="glyphicon glyphicon-trash"></span>
				</a>
			</td>
		</tr>
	<?php } while($row_test = mysqli_fetch_assoc($test)); ?>
	
</table>
<?php } else { ?>
	<div class="alert alert-warning text-center">
		<h3 style="border:none;">No Result Found!</h3>
	</div>
<?php } ?>


<?php require_once("footer_mis.php"); ?>