<?php

	require_once("connection.php");
	
	$patient_id = getValue($_GET["patient_id"]);
	
	$result = mysqli_query($con, "DELETE FROM patient WHERE patient_id = $patient_id");
	
	if($result) {
		header("location:patient_list.php?delete=done");
	}
	else {
		header("location:patient_list.php?error=notdelete");
	}
	

?>