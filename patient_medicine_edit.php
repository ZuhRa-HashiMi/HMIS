<?php require_once("connection.php"); ?>
<?php

	checkLevel(4, 9, 9, 4, 9, 9, 9, 9, 9, 9);

    $patient_id = isset($_POST["patient_id"]) ? getValue($_POST["patient_id"]) : null;

	$patient_medicine_id = getValue($_GET["patient_medicine_id"]);
	$patient_medicine = mysqli_query($con, "SELECT * FROM patient_medicine WHERE patient_medicine_id = $patient_medicine_id");
	$row_patient_medicine = mysqli_fetch_assoc($patient_medicine);

	$patient = mysqli_query($con, "SELECT * FROM patient ORDER BY patient_id ASC");
	$row_patient = mysqli_fetch_assoc($patient);
	
    if(isset($_POST["medicine"])) {
        $medicine = getValue($_POST["medicine"]);
        $quantity = getValue($_POST["quantity"]);
        $unitprice = getValue($_POST["unitprice"]);
        $totalprice = getValue($_POST["totalprice"]);
        $apply_date = getValue($_POST["apply_date"]);
		
		
		$result = mysqli_query($con, "UPDATE patient_medicine SET patient_id='$patient_id', medicine='$medicine', quantity='$quantity', unitprice='$unitprice', totalprice='$totalprice', apply_date='$apply_date'  WHERE patient_medicine_id = $patient_medicine_id");
		if($result) {
			header("location:patient_medicine_list.php?edit=done");
		}
		else {
			header("location:patient_medicine_edit.php?error=notedit&patient_medicine_id=$patient_medicine_id");
		}
		
	}

?>
<?php require_once("header.php"); ?>

<div class="panel panel-primary">
	<div class="panel-heading">
		<h1>Edit Patient Medicine after visit doctor</h1>
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
					Patient ID:
				</span>
				<select name="patient_id" class="form-control">
					
					<option value="NULL">None</option>
						
					<?php do { ?>
						<option <?php if($row_patient_medicine["patient_id"] == $row_patient["patient_id"]) echo "selected"; ?> 
                        value="<?php echo $row_patient["patient_id"]; ?>"><?php echo $row_patient["patient_id"]; ?></option>
					<?php } while($row_patient = mysqli_fetch_assoc($patient)); ?>
				</select>
			</div>
		
		
            <div class="input-group">
                    <span class="input-group-addon">
                        Medicine Name:
                    </span>
                	<input value="<?php echo $row_patient_medicine["medicine"]; ?>" required type="text" name="medicine" class="form-control">
                </div>

                <div class="input-group">
                    <span class="input-group-addon">
                        Quantity:
                    </span>
                    <input value="<?php echo $row_patient_medicine["quantity"]; ?>" required type="text" name="quantity" class="form-control">
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        Unitprice:
                    </span>
                    <input value="<?php echo $row_patient_medicine["unitprice"]; ?>" required type="text" name="unitprice" class="form-control">
                </div>
           
			

			
			
		
            <div class="input-group">
                    <span class="input-group-addon">
                        Totalprice:
                    </span>
                	<input value="<?php echo $row_patient_medicine["totalprice"]; ?>" required type="text" name="totalprice" class="form-control">
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        Apply Date:
                    </span>
                    <input value="<?php echo date("Y-m-d"); ?>" required autocomplete="off" type="text" id="apply_date" name="apply_date" class="form-control">
                </div>

			
			<input type="submit" value="Save Changes" class="btn btn-primary">
			
			</div>
			
		</form>
	</div>
</div>

<script type="text/javascript">
	Calendar.setup({
        inputField      :    "apply_date",
        ifFormat        :    "%Y-%m-%d",
        showsTime       :    false,
        timeFormat      :    "24"
    });
</script>

<?php require_once("footer_mis.php"); ?>