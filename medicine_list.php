<?php require_once("connection.php"); ?>

<?php
$condition = "";
$search = "";

if (isset($_GET["q"])) {
    $search = getValue($_GET["q"]);
    $condition = " WHERE medicine_name LIKE '%$search%' ";
}

// Pagination variables
$records_per_page = 8;
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$start_from = ($page - 1) * $records_per_page;

// Query to fetch medicine records with pagination
$query = "SELECT * FROM medicine $condition ORDER BY medicine_id ASC LIMIT $start_from, $records_per_page";
$medicine = mysqli_query($con, $query);
$row_medicine = mysqli_fetch_assoc($medicine);

// Total number of medicine records
$totalRows_medicine = mysqli_num_rows(mysqli_query($con, "SELECT * FROM medicine $condition"));

// Calculate total pages for pagination
$total_pages = ceil($totalRows_medicine / $records_per_page);
?>

<?php require_once("header.php"); ?>

<h2>Medicine List</h2>

<!-- Display search results -->
<?php if (!empty($search)) { ?>
    <div style="font-size: 18px;">
        <b>Search for: <?php echo $search; ?></b><br>
        <b>Total Results: <?php echo $totalRows_medicine; ?></b>
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

<?php if (isset($_GET["q"])) { ?>
    <div style="font-size: 18px;">
        <b>Search for: <?php echo $_GET["q"]; ?></b><br>
        <b>Total Result: <?php echo $totalRows_medicine; ?></b>
    </div>
<?php } ?>

<?php if ($totalRows_medicine > 0) { ?>
    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>Medicine Name</th>
            <th>Description</th>
            <th>Form</th>
            <th>Quantity</th>
            <th>Unitprice</th>
            <th>Expire Date</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>

        <?php do { ?>
            <tr>
                <td><?php echo $row_medicine["medicine_id"]; ?></td>
                <td><?php echo $row_medicine["medicine_name"]; ?></td>
                <td><?php echo $row_medicine["description"]; ?></td>
                <td><?php echo $row_medicine["form"]; ?></td>
                <td><?php echo $row_medicine["quantity"]; ?></td>
                <td><?php echo $row_medicine["unitprice"]; ?></td>
                <td><?php echo $row_medicine["expire_date"]; ?></td>
                <td>
                    <a href="medicine_edit.php?medicine_id=<?php echo $row_medicine["medicine_id"]; ?>">
                        <span class="glyphicon glyphicon-edit"></span>
                    </a>
                </td>
                <td>
                    <a class="delete" href="medicine_delete.php?medicine_id=<?php echo $row_medicine["medicine_id"]; ?>">
                        <span class="glyphicon glyphicon-trash"></span>
                    </a>
                </td>
            </tr>
        <?php } while ($row_medicine = mysqli_fetch_assoc($medicine)); ?>

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
        <h3 style="border:none;">No Result Found!</h3>
    </div>
<?php } ?>

<?php require_once("footer_mis.php"); ?>
