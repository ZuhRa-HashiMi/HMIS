<?php require_once("connection.php"); ?>
<?php

	checkLevel(2, 9, 9, 2, 9, 9, 9, 9, 9, 9);
	
	if(isset($_POST["test_name"])) {
		$test_name = getValue($_POST["test_name"]);
		$test_type = getValue($_POST["test_type"]);
        $price = getValue($_POST["price"]);
        $normal_result = getValue($_POST["normal_result"]);
		
		
		$result = mysqli_query($con, "INSERT INTO test VALUES (NULL, '$test_name', '$test_type', '$price','$normal_result')");
		if($result) {
			header("location:test_list.php?add=done");
		}
		else {
			header("location:test_add.php?error=notadd");
		}
		
		
	}

?>
<?php require_once("header.php"); ?>

<div class="panel panel-primary">
	<div class="panel-heading">
		<h1>Add New Test</h1>
	</div>
	
	<div class="panel-body">
	
		
		
		<?php if(isset($_GET["error"])) { ?>
			<div class="alert alert-danger">
				Adding failed! Please try again!
			</div>
		<?php } ?>
	
		<form method="post" enctype="multipart/form-data">
			
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			
			<div class="input-group">
				<span class="input-group-addon">
					Test Name:
				</span>
				<input required type="text" name="test_name" class="form-control">
			</div>
		
			<div class="input-group">
				<span class="input-group-addon">
					Test Type:
				</span>
				<input required type="text" name="test_type" class="form-control">
			</div>
			

			<div class="input-group">
				<span class="input-group-addon">
					Price:
				</span>
				<input required type="text" name="price" class="form-control">
			</div>

            <div class="input-group">
				<span class="input-group-addon">
					Normal Result:
				</span>
				<input required type="text" name="normal_result" class="form-control">
			</div>
			
            <input type="submit" value="Register Patient" class="btn btn-primary">
		
			
        </div>
			
			</div>
			
		</form>
	</div>
</div>


<?php require_once("footer_mis.php"); ?>