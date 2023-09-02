<?php require_once("connection.php"); ?>
<?php

	checkLevel(4, 9, 9, 4, 9, 9, 9, 9, 9, 9);


	$patient_record_id = getValue($_GET["patient_record_id"]);
	$patient_record = mysqli_query($con, "SELECT * FROM patient_record WHERE patient_record_id = $patient_record_id");
	$row_patient_record = mysqli_fetch_assoc($patient_record);

	$patient = mysqli_query($con, "SELECT * FROM patient ORDER BY patient_id ASC");
	$row_patient = mysqli_fetch_assoc($patient);
	
	if(isset($_POST["record_date"])) {
		
		$record_date = getValue($_POST["record_date"]);
        $patient_id = getValue($_POST["patient_id"]);
		$sickness = getValue($_POST["sickness"]);
		$doctor = getValue($_POST["doctor"]);

		
		
		$result = mysqli_query($con, "UPDATE patient_record SET patient_id='$patient_id', record_date='$record_date', sickness='$sickness', doctor='$doctor'  WHERE patient_record_id = $patient_record_id");
		if($result) {
			header("location:patient_record_list.php?edit=done");
		}
		else {
			header("location:patient_record_edit.php?error=notedit&patient_record_id=$patient_record_id");
		}
		
	}

?>
<?php require_once("header.php"); ?>

<div class="panel panel-primary">
	<div class="panel-heading">
		<h1>Edit Patient Record after visit doctor</h1>
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
						<option <?php if($row_patient_record["patient_id"] == $row_patient["patient_id"]) echo "selected"; ?> 
                        value="<?php echo $row_patient["patient_id"]; ?>"><?php echo $row_patient["patient_id"]; ?></option>
					<?php } while($row_patient = mysqli_fetch_assoc($patient)); ?>
				</select>
			</div>
		
			<div class="input-group">
				<span class="input-group-addon">
					Record Date:
				</span>
				<input value="<?php echo $row_patient_record["record_date"]; ?>" value="<?php echo date("Y-m-d"); ?>" required autocomplete="off" type="text" id="record_date" name="record_date" class="form-control">
			</div>
			
		
		
			
			<div class="input-group">
				<span class="input-group-addon">
					Sickness:
				</span>
				<input value="<?php echo $row_patient_record["sickness"]; ?>" required type="text" name="sickness" class="form-control">
			</div>
			
			
			
			<div class="input-group">
				<span class="input-group-addon">
					Doctor Name:
				</span>
				<input value="<?php echo $row_patient_record["doctor"]; ?>" required type="text" name="doctor" class="form-control">
			</div>
			
		
			
			</div>
			
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			
			
		
		
			
			<input type="submit" value="Save Changes" class="btn btn-primary">
			
			</div>
			
		</form>
	</div>
</div>

<script type="text/javascript">
	Calendar.setup({
        inputField      :    "record_date",
        ifFormat        :    "%Y-%m-%d",
        showsTime       :    false,
        timeFormat      :    "24"
    });
</script>

<?php require_once("footer_mis.php"); ?>