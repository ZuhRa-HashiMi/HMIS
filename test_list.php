<?php require_once("connection.php"); ?>

<?php
$condition = "";
$search = "";

if (isset($_GET["q"])) {
    $search = getValue($_GET["q"]);
    $condition = " WHERE test_name LIKE '%$search%' ";
}

// Pagination variables
$records_per_page = 8; // Set the number of tests to display per page
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$start_from = ($page - 1) * $records_per_page;

// Query to fetch test records with pagination
$query = "SELECT * FROM test $condition ORDER BY test_id ASC LIMIT $start_from, $records_per_page";
$test = mysqli_query($con, $query);
$row_test = mysqli_fetch_assoc($test);

// Total number of test records
$totalRows_test = mysqli_num_rows(mysqli_query($con, "SELECT * FROM test $condition"));

// Calculate total pages for pagination
$total_pages = ceil($totalRows_test / $records_per_page);
?>

<?php require_once("header.php"); ?>

<h2>Test List</h2>

<!-- Display search results -->
<?php if (!empty($search)) { ?>
    <div style="font-size: 18px;">
        <b>Search for: <?php echo $search; ?></b><br>
        <b>Total Results: <?php echo $totalRows_test; ?></b>
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
        <b>Total Result: <?php echo $totalRows_test; ?></b>
    </div>
<?php } ?>

<?php if ($totalRows_test > 0) { ?>
    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>Test Name</th>
            <th>Test Type</th>
            <th>Test Price</th>
            <th>Normal Result</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>

        <?php do { ?>
            <tr>
                <td><?php echo $row_test["test_id"]; ?></td>
                <td><?php echo $row_test["test_name"]; ?></td>
                <td><?php echo $row_test["test_type"]; ?></td>
                <td><?php echo $row_test["price"]; ?></td>
                <td><?php echo $row_test["normal_result"]; ?></td>
                <td>
                    <a href="test_edit.php?test_id=<?php echo $row_test["test_id"]; ?>">
                        <span class="glyphicon glyphicon-edit"></span>
                    </a>
                </td>
                <td>
                    <a class="delete" href="test_delete.php?test_id=<?php echo $row_test["test_id"]; ?>">
                        <span class="glyphicon glyphicon-trash"></span>
                    </a>
                </td>
            </tr>
        <?php } while ($row_test = mysqli_fetch_assoc($test)); ?>

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
