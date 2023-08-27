<?php

	$con = mysqli_connect("localhost", "root", "");
	mysqli_select_db($con, "hmis");
	
	if(!isset($_SESSION)) { 
		session_start();
	}
	
	// Wrapper Function
	function getValue($value) {
		global $con;
		return mysqli_real_escape_string($con, $value);
	}
	
	
	function checkLevel($admin_level, $hr_level, $finance_level, $pharmacy_level, $laboratoar_level, $patient_level) {
		
		$redirect = true;
		
		if($_SESSION["admin_level"] >= $admin_level) {
			$redirect = false;
		}
		
	
		if($_SESSION["hr_level"] >= $hr_level) {
			$redirect = false;
		}
		
		if($_SESSION["finance_level"] >= $finance_level) {
			$redirect = false;
		}
		
		if($_SESSION["pharmacy_level"] >= $pharmacy_level) {
			$redirect = false;
		}
		
		if($_SESSION["laboratoar_level"] >= $laboratoar_level) {
			$redirect = false;
		}
		
		if($_SESSION["patient_level"] >= $patient_level) {
			$redirect = false;
		}
		
		
		if($redirect) {
			
			if(isset($_SERVER["HTTP_REFERER"])) {
				$previousURL = $_SERVER["HTTP_REFERER"];
			}
			else {
				$previousURL = "login.php?authorize=failed";
			}
			
			header("location:$previousURL?authorize=failed");
			exit();
		}
		
	}
	
	
	
	
	
	
	
?>