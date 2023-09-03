<?php require_once("connection.php"); ?>
<?php

	checkLevel(4, 9, 9, 4, 9, 9, 9, 9, 9, 9);

	$medicine_id = getValue($_GET["medicine_id"]);
	
	$medicine = mysqli_query($con, "SELECT * FROM medicine WHERE medicine_id = $medicine_id");
	$row_medicine = mysqli_fetch_assoc($medicine);

	
	if(isset($_POST["medicine_name"])) {
		$medicine_name = getValue($_POST["medicine_name"]);
		$description = getValue($_POST["description"]);
        $form = getValue($_POST["form"]);
        $quantity = getValue($_POST["quantity"]);
        $unitprice = getValue($_POST["unitprice"]);
		$expire_date = getValue($_POST["expire_date"]);
  

		$result = mysqli_query($con, "UPDATE medicine SET medicine_name='$medicine_name', description='$description', form='$form', quantity='$quantity', unitprice='$unitprice', expire_date='$expire_date' WHERE medicine_id = $medicine_id");
		if($result) {
			header("location:medicine_list.php?edit=done");
		}
		else {
			header("location:medicine_edit.php?error=notedit&medicine_id=$medicine_id");
		}
		
	}

?>
<?php require_once("header.php"); ?>

<div class="panel panel-primary">
	<div class="panel-heading">
		<h1>Edit Medicines</h1>
	</div>
	
	<div class="panel-body">
		
		<?php if(isset($_GET["error"])) { ?>
			<div class="alert alert-danger">
				Registration failed! Please try again!
			</div>
		<?php } ?>
	
		<form method="post" enctype="multipart/form-data">
			
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			
			<div class="input-group">
				<span class="input-group-addon">
					Medicine Name:
				</span>
				<input required value="<?php echo $row_medicine["medicine_name"]; ?>" type="text" name="medicine_name" class="form-control">
			</div>
		
			<div class="input-group">
				<span class="input-group-addon">
					Description:
				</span>
				<input required value="<?php echo $row_medicine["description"]; ?>" type="text" name="description" class="form-control">
			</div>
		
			<div class="input-group">
				<span class="input-group-addon">
					Medicina Form:
				</span>
				<input required  value="<?php echo $row_medicine["form"]; ?>"  type="text" name="form" class="form-control">
			</div>
			
			
			</div>
			
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			
			
	
			<div class="input-group">
				<span class="input-group-addon">
					Quantity:
				</span>
				<input required   value="<?php echo $row_medicine["quantity"]; ?>" type="text" name="quantity" class="form-control">
			</div>
			
			<div class="input-group">
				<span class="input-group-addon">
                Medicine Unitprice:
				</span>
				<input required   value="<?php echo $row_medicine["unitprice"]; ?>" type="text" name="unitprice" class="form-control">
			</div>

            <div class="input-group">
                    <span class="input-group-addon">
                        Expire Date:
                    </span>
                    <input value="<?php echo $row_medicine["expire_date"]; ?>" value="<?php echo date("Y-m-d"); ?>" required autocomplete="off" type="text" id="expire_date" name="expire_date" class="form-control">
                </div>
			
		
			
			<input type="submit" value="Register Patient" class="btn btn-primary">
			
			</div>
			
		</form>
	</div>
</div>

<script type="text/javascript">
    Calendar.setup({
        inputField: "expire_date",
        ifFormat: "%Y-%m-%d",
        showsTime: false,
        timeFormat: "24"
    });
</script>
<?php require_once("footer_mis.php"); ?>