<?php
require_once("connection.php");

$patient_id = getValue($_GET["patient_id"]);

try {
    $result = mysqli_query($con, "DELETE FROM patient WHERE patient_id = $patient_id");

    if ($result) {
        header("location:patient_list.php?delete=done");
    } else {
        header("location:patient_list.php?error=notdelete");
    }
} catch (mysqli_sql_exception $e) {
    // Check if the exception message contains the foreign key constraint error message
    $errorMessage = $e->getMessage();
    
    if (strpos($errorMessage, "foreign key constraint") !== false) {
        // Handle the foreign key constraint error with a user-friendly message
        header("location:patient_list.php?error=foreignkey");
    } else {
        // Handle other database-related errors
        header("location:patient_list.php?error=databaseerror");
    }
}
?>
