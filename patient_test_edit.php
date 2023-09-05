<?php require_once("connection.php"); ?>

<?php
    checkLevel(4, 9, 9, 4, 9, 9, 9, 9, 9, 9);

    $patient_test_id = getValue($_GET["patient_test_id"]);
	$patient_test = mysqli_query($con, "SELECT pt.*, t.test_name FROM patient_test pt INNER JOIN test t ON pt.test_id = t.test_id WHERE pt.patient_test_id = $patient_test_id");
	$row_patient_test = mysqli_fetch_assoc($patient_test);
	

    $patient = mysqli_query($con, "SELECT * FROM patient ORDER BY patient_id ASC");
    $row_patient = mysqli_fetch_assoc($patient);

    $test_query = mysqli_query($con, "SELECT test_id, test_name FROM test ORDER BY test_id ASC");
    $test_data = [];
    while ($row = mysqli_fetch_assoc($test_query)) {
        $test_data[] = $row;
    }
    
    if (isset($_POST["test_date"])) {
        $patient_id = getValue($_POST["patient_id"]);
        $test_id = getValue($_POST["test_id"]);
        $test_date = getValue($_POST["test_date"]);
        $test_result = getValue($_POST["test_result"]);

        // Find the test_name associated with the selected test_id
        $test_name = "";
        foreach ($test_data as $test_row) {
            if ($test_row["test_id"] == $test_id) {
                $test_name = $test_row["test_name"];
                break;
            }
        }

        $result = mysqli_query($con, "UPDATE patient_test SET test_id='$test_id', patient_id='$patient_id', test_date='$test_date', test_result='$test_result' WHERE patient_test_id = $patient_test_id");
        if ($result) {
            header("location:patient_test_list.php?edit=done");
        } else {
            header("location:patient_test_edit.php?error=notedit&patient_test_id=$patient_test_id");
        }
    }
?>

<?php require_once("header.php"); ?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h1>Edit Patient Test</h1>
    </div>

    <div class="panel-body">

        <?php if (isset($_GET["error"])) { ?>
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
                            <option <?php if ($row_patient_test["patient_id"] == $row_patient["patient_id"]) echo "selected"; ?>
                                value="<?php echo $row_patient["patient_id"]; ?>"><?php echo $row_patient["patient_id"]; ?></option>
                        <?php } while ($row_patient = mysqli_fetch_assoc($patient)); ?>
                    </select>
                </div>

                <div class="input-group">
                    <span class="input-group-addon">
                        Test ID:
                    </span>
                    <select name="test_id" class="form-control">

                        <option value="NULL">None</option>

                        <?php foreach ($test_data as $test_row) { ?>
                            <option <?php if ($row_patient_test["test_id"] == $test_row["test_id"]) echo "selected"; ?>
                                value="<?php echo $test_row["test_id"]; ?>"><?php echo $test_row["test_id"]; ?></option>
                        <?php } ?>
                    </select>
                </div>

				<div class="input-group">
                    <span class="input-group-addon">
                        Test Name:
                    </span>
                    <select name="test_name" class="form-control">

                        <option value="NULL">None</option>

                        <?php foreach ($test_data as $test_row) { ?>
                            <option <?php if ($row_patient_test["test_name"] == $test_row["test_name"]) echo "selected"; ?>
                                value="<?php echo $test_row["test_name"]; ?>"><?php echo $test_row["test_name"]; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        Test Date:
                    </span>
                    <input value="<?php echo $row_patient_test["test_date"]; ?>" value="<?php echo date("Y-m-d"); ?>" required autocomplete="off" type="text" id="test_date" name="test_date" class="form-control">
                </div>

                <div class="input-group">
                    <span class="input-group-addon">
                        Test Result:
                    </span>
                    <input value="<?php echo $row_patient_test["test_result"]; ?>" required type="text" name="test_result" class="form-control">
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
        inputField: "test_date",
        ifFormat: "%Y-%m-%d",
        showsTime: false,
        timeFormat: "24"
    });
</script>

<?php require_once("footer_mis.php"); ?>
