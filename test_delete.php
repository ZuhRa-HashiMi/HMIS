<?php

	require_once("connection.php");
	
	$test_id = getValue($_GET["test_id"]);
	
	$result = mysqli_query($con, "DELETE FROM test WHERE test_id = $test_id");
	
	if($result) {
		header("location:test_list.php?delete=done");
	}
	else {
		header("location:test_list.php?error=notdelete");
	}
	

?>