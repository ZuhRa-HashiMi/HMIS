<?php require_once("connection.php"); ?>
<?php

	checkLevel(4, 9, 9, 4, 9, 9, 9, 9, 9, 9);

	$test_id = getValue($_GET["test_id"]);
	
	$test = mysqli_query($con, "SELECT * FROM test WHERE test_id = $test_id");
	$row_test = mysqli_fetch_assoc($test);

	
	if(isset($_POST["test_name"])) {
		$test_name = getValue($_POST["test_name"]);
		$test_type = getValue($_POST["test_type"]);
        $price = getValue($_POST["price"]);
        $normal_result = getValue($_POST["normal_result"]);

		$result = mysqli_query($con, "UPDATE test SET test_name='$test_name', test_type='$test_type', price='$price',normal_result='$normal_result' WHERE test_id = $test_id");
		if($result) {
			header("location:test_list.php?edit=done");
		}
		else {
			header("location:test_edit.php?error=notedit&test_id=$test_id");
		}
		
	}

?>
<?php require_once("header.php"); ?>

<div class="panel panel-primary">
	<div class="panel-heading">
		<h1>Edit Test</h1>
	</div>
	
	<div class="panel-body">
		
		<?php if(isset($_GET["error"])) { ?>
			<div class="alert alert-danger">
				Adding test failed! Please try again!
			</div>
		<?php } ?>
	
		<form method="post" enctype="multipart/form-data">
			
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			
			<div class="input-group">
				<span class="input-group-addon">
					Test Name:
				</span>
				<input required value="<?php echo $row_test["test_name"]; ?>" type="text" name="test_name" class="form-control">
			</div>
		
			<div class="input-group">
				<span class="input-group-addon">
					Test Type:
				</span>
				<input required value="<?php echo $row_test["test_type"]; ?>" type="text" name="test_type" class="form-control">
			</div>
			
		
			
			<div class="input-group">
				<span class="input-group-addon">
					Price:
				</span>
				<input required  value="<?php echo $row_test["price"]; ?>"  type="text" name="price" class="form-control">
			</div>
			
		
        
			
		
			</div>
			
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		
            <div class="input-group">
				<span class="input-group-addon">
					Normal Result:
				</span>
				<input required  value="<?php echo $row_test["normal_result"]; ?>"  type="text" name="normal_result" class="form-control">
			</div>
			
			<input type="submit" value="Register Patient" class="btn btn-primary">
			
			</div>
			
		</form>
	</div>
</div>


<?php require_once("footer_mis.php"); ?>