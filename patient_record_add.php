<?php require_once("connection.php"); ?>
<?php

    checkLevel(2, 9, 9, 2, 9, 9, 9, 9, 9, 9);
    $patient_id = isset($_POST["patient_id"]) ? getValue($_POST["patient_id"]) : null;

    $patient = mysqli_query($con, "SELECT * FROM patient ORDER BY patient_id ASC");
    $row_patient = mysqli_fetch_assoc($patient);

    if(isset($_POST["record_date"])) {
        $record_date = getValue($_POST["record_date"]);
        $sickness  = getValue($_POST["sickness"]);
        $doctor = getValue($_POST["doctor"]);

        // Check if patient_id is not NULL
        if ($patient_id !== null) {
            // Use prepared statement to insert data safely
            $stmt = mysqli_prepare($con, "INSERT INTO patient_record (patient_id, record_date, sickness, doctor) VALUES (?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, 'isss', $patient_id, $record_date, $sickness, $doctor);

            if(mysqli_stmt_execute($stmt)) {
                header("location:patient_record_list.php?add=done");
            }
            else {
                header("location:patient_record_add.php?error=notadd");
            }

            mysqli_stmt_close($stmt);
        } else {
            // Handle the case when patient_id is NULL
            header("location:patient_record_add.php?error=patient_id_null");
        }
    }

?>
<?php require_once("header.php"); ?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h1>Add Patient Record </h1>
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
                    Patient ID:
                </span>
                <select name="patient_id" class="form-control " required>

                    <option value="NULL">None</option>

                    <?php do { ?>
                        <option value="<?php echo $row_patient["patient_id"]; ?>"><?php echo $row_patient["patient_id"]; ?></option>
                    <?php } while($row_patient = mysqli_fetch_assoc($patient)); ?>
                </select>
            </div>


                <div class="input-group">
                    <span class="input-group-addon">
                        Record Date:
                    </span>
                    <input value="<?php echo date("Y-m-d"); ?>" required autocomplete="off" type="text" id="record_date" name="record_date" class="form-control">
                </div>

                <div class="input-group">
                    <span class="input-group-addon">
                        Sickness:
                    </span>
                    <input required type="text" name="sickness" class="form-control">
                </div>

                <div class="input-group">
                    <span class="input-group-addon">
                        Doctor:
                    </span>
                    <input required type="text" name="doctor" class="form-control">
                </div>


            </div>

            <input type="submit" value="Register patient" class="btn btn-primary">

        </form>
    </div>
</div>

<script type="text/javascript">
    Calendar.setup({
        inputField      :    "record_date",
        ifFormat        :    "%Y-%m-%d",
        showsTime       :    false,
        timeFormat      :    "24"
    });
</script>

<?php require_once("footer_mis.php"); ?>
