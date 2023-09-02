<?php

	require_once("connection.php");
	
	$patient_record_id = getValue($_GET["patient_record_id"]);
	
	$result = mysqli_query($con, "DELETE FROM patient_record WHERE patient_record_id = $patient_record_id");
	
	if($result) {
		header("location:patient_record_list.php?delete=done");
	}
	else {
		header("location:patient_record_list.php?error=notdelete");
	}
	

?>