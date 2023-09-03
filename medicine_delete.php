<?php

	require_once("connection.php");
	
	$medicine_id = getValue($_GET["medicine_id"]);
	
	$result = mysqli_query($con, "DELETE FROM medicine WHERE medicine_id = $medicine_id");
	
	if($result) {
		header("location:medicine_list.php?delete=done");
	}
	else {
		header("location:medicine_list.php?error=notdelete");
	}
	

?>