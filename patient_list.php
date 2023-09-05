<?php require_once("connection.php"); ?>

<?php
$condition = "";
$search = "";

if (isset($_GET["q"])) {
    $search = getValue($_GET["q"]);
    $condition = " WHERE firstname LIKE '%$search%' ";
}

// Pagination variables
$records_per_page = 7;
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$start_from = ($page - 1) * $records_per_page;

// Query to fetch patient records with pagination
$query = "SELECT * FROM patient $condition ORDER BY patient_id ASC LIMIT $start_from, $records_per_page";
$patient = mysqli_query($con, $query);
$row_patient = mysqli_fetch_assoc($patient);

// Total number of patient records
$totalRows_patient = mysqli_num_rows(mysqli_query($con, "SELECT * FROM patient $condition"));

// Calculate total pages for pagination
$total_pages = ceil($totalRows_patient / $records_per_page);
?>

<?php require_once("header.php"); ?>

<h2>Patient List</h2>

<!-- Display search results -->
<?php if (!empty($search)) { ?>
    <div style="font-size: 18px;">
        <b>Search for: <?php echo $search; ?></b><br>
        <b>Total Results: <?php echo $totalRows_patient; ?></b>
    </div>
<?php } ?>

<!-- Search form -->
<form method="get">
    <div class="input-group">
        <span class="input-group-addon">Search:</span>
        <input type="text" name="q" class="form-control" value="<?php echo $search; ?>">
        <span class="input-group-btn">
            <button class="btn btn-primary">
                <span style="color: white;" class="glyphicon glyphicon-search"></span>
            </button>
        </span>
    </div>
</form>

<?php if ($totalRows_patient > 0) { ?>
    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Lastname</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>

        <?php do { ?>
            <tr>
                <td><?php echo $row_patient["patient_id"]; ?></td>
                <td><?php echo $row_patient["firstname"]; ?></td>
                <td><?php echo $row_patient["lastname"]; ?></td>
                <td>
                    <a href="patient_edit.php?patient_id=<?php echo $row_patient["patient_id"]; ?>">
                        <span class="glyphicon glyphicon-edit"></span>
                    </a>
                </td>
                <td>
                    <a class="delete" href="patient_delete.php?patient_id=<?php echo $row_patient["patient_id"]; ?>">
                        <span class="glyphicon glyphicon-trash"></span>
                    </a>
                </td>
            </tr>
        <?php } while ($row_patient = mysqli_fetch_assoc($patient)); ?>

    </table>

    <!-- Pagination links -->
    <ul class="pagination">
        <?php
        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<li><a href='?page=" . $i . "&q=" . urlencode($search) . "'>" . $i . "</a></li>";
        }
        ?>
    </ul>

<?php } else { ?>
    <div class="alert alert-warning text-center">
        <h3 style="border:none;">No Results Found!</h3>
    </div>
<?php } ?>

<?php require_once("footer_mis.php"); ?>
