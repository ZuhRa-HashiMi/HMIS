<?php

	require_once("connection.php");
	
	$patient_test_id = getValue($_GET["patient_test_id"]);
	
	$result = mysqli_query($con, "DELETE FROM patient_test WHERE patient_test_id = $patient_test_id");
	
	if($result) {
		header("location:patient_test_list.php?delete=done");
	}
	else {
		header("location:patient_test_list.php?error=notdelete");
	}
	

?>