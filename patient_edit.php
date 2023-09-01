<?php require_once("connection.php"); ?>
<?php

	checkLevel(4, 9, 9, 4, 9, 9, 9, 9, 9, 9);

	$patient_id = getValue($_GET["patient_id"]);
	
	$patient = mysqli_query($con, "SELECT * FROM patient WHERE patient_id = $patient_id");
	$row_patient = mysqli_fetch_assoc($patient);

	
	if(isset($_POST["firstname"])) {
		$firstname = getValue($_POST["firstname"]);
		$lastname = getValue($_POST["lastname"]);
        $province = getValue($_POST["province"]);
        $current_location = getValue($_POST["current_location"]);
        $phone = getValue($_POST["phone"]);
		$gender = getValue($_POST["gender"]);
        $birth_year = getValue($_POST["birth_year"]);
        $history = getValue($_POST["history"]);

		$result = mysqli_query($con, "UPDATE patient SET firstname='$firstname', lastname='$lastname', province='$province',current_location='$current_location', phone='$phone' gender=$gender, birth_year=$birth_year, history='$history' WHERE patient_id = $patient_id");
		if($result) {
			header("location:patient_list.php?edit=done");
		}
		else {
			header("location:patient_edit.php?error=notedit&patient_id=$patient_id");
		}
		
	}

?>
<?php require_once("header.php"); ?>

<div class="panel panel-primary">
	<div class="panel-heading">
		<h1>Edit Patient</h1>
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
					Firstname:
				</span>
				<input required value="<?php echo $row_patient["firstname"]; ?>" type="text" name="firstname" class="form-control">
			</div>
		
			<div class="input-group">
				<span class="input-group-addon">
					Lastname:
				</span>
				<input required value="<?php echo $row_patient["lastname"]; ?>" type="text" name="lastname" class="form-control">
			</div>
			
			<div class="input-group">
				<span class="input-group-addon">
					Gender:
				</span>  &nbsp;
				<label><input <?php if($row_patient["gender"] == 0) echo "checked"; ?> type="radio" name="gender" value="0"> Male</label> &nbsp;
				<label><input <?php if($row_patient["gender"] == 1) echo "checked"; ?> type="radio" name="gender" value="1"> Female</label>
			</div>
			
			
			<div class="input-group">
				<span class="input-group-addon">
					Birth Year:
				</span>
				<select name="birth_year" class="form-control">
					<?php
						$year = date("Y");
						$max = $year - 18;
						$min = $year - 65;
						
						for($x=$max; $x>$min; $x--) {
						?>
							<option <?php if($row_patient["birth_year"] == $x) { echo "selected"; } ?>><?php echo $x; ?></option>	
						<?php } ?>
					
				</select>
			</div>
			
			
			<div class="input-group">
				<span class="input-group-addon">
					History:
				</span>
				<input required  value="<?php echo $row_patient["history"]; ?>"  type="text" name="history" class="form-control">
			</div>
			
		
			
			</div>
			
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			
			
	
			<div class="input-group">
				<span class="input-group-addon">
					Province:
				</span>
				<input required   value="<?php echo $row_patient["province"]; ?>" type="text" name="province" class="form-control">
			</div>
			
			<div class="input-group">
				<span class="input-group-addon">
                current_location:
				</span>
				<input required   value="<?php echo $row_patient["current_location"]; ?>" type="text" name="current_location" class="form-control">
			</div>

            <div class="input-group">
				<span class="input-group-addon">
					Phone:
				</span>
				<input required   value="<?php echo $row_patient["phone"]; ?>" type="text" name="phone" class="form-control">
			</div>
			
			
		
			
			<input type="submit" value="Register Patient" class="btn btn-primary">
			
			</div>
			
		</form>
	</div>
</div>


<?php require_once("footer_mis.php"); ?>