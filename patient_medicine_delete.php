<?php

	require_once("connection.php");
	
	$patient_medicine_id = getValue($_GET["patient_medicine_id"]);
	
	$result = mysqli_query($con, "DELETE FROM patient_medicine WHERE patient_medicine_id = $patient_medicine_id");
	
	if($result) {
		header("location:patient_medicine_list.php?delete=done");
	}
	else {
		header("location:patient_medicine_list.php?error=notdelete");
	}
	

?>