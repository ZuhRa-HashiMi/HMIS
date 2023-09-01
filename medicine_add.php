<?php require_once("connection.php"); ?>
<?php

	checkLevel(2, 9, 9, 2, 9, 9, 9, 9, 9, 9);

	
	if(isset($_POST["medicine_name"])) {
		$medicine_name = getValue($_POST["medicine_name"]);
		$description  = getValue($_POST["description "]);
		$form = getValue($_POST["form"]);
		$quantity = getValue($_POST["quantity"]);
		$unitprice  = getValue($_POST["unitprice"]);
		$expire_date = getValue($_POST["expire_date"]);
		
		
		$result = mysqli_query($con, "INSERT INTO medicine VALUES (NULL, '$medicine_name', '$description', '$form', '$quantity','$unitprice', '$expire_date')");
		if($result) {
			header("location:medicine_list.php?add=done");
		}
		else {
			header("location:medicine_add.php?error=notadd");
		}
		
		
	}

?>
<?php require_once("header.php"); ?>

<div class="panel panel-primary">
	<div class="panel-heading">
		<h1>Add New Medicine</h1>
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
					Medicine Name:
				</span>
				<input required type="text" name="medicine_name" class="form-control">
			</div>
		
			<div class="input-group">
				<span class="input-group-addon">
					Description:
				</span>
				<input required type="text" name="description" class="form-control">
			</div>
			
			
			<div class="input-group">
				<span class="input-group-addon">
					Form:
				</span>
				<input required type="text" name="form" class="form-control">
			</div>
			
			
			
			<div class="input-group">
				<span class="input-group-addon">
					Quantity:
				</span>
				<input required type="text" name="quantity" class="form-control">
			</div>
			
			<div class="input-group">
				<span class="input-group-addon">
					Unitprice:
				</span>
				<input required type="text" name="unitprice" class="form-control">
			</div>
			
			
			</div>
			
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		
			<div class="input-group">
				<span class="input-group-addon">
					Expire Date:
				</span>
				<input value="<?php echo date("Y-m-d"); ?>" required autocomplete="off" type="text" id="expire_date" name="expire_date" class="form-control">
			</div>
			
			<input type="submit" value="Register Staff" class="btn btn-primary">
			
			</div>
			
		</form>
	</div>
</div>

<script type="text/javascript">
	Calendar.setup({
        inputField      :    "expire_date",
        ifFormat        :    "%Y-%m-%d",
        showsTime       :    false,
        timeFormat      :    "24"
    });
</script>

<?php require_once("footer_mis.php"); ?>