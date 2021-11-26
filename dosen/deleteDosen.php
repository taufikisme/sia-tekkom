<?php
include_once("../is_logged_in.php");
// include database connection file
include_once("../config.php");
// Get id from URL to delete that data
$nidn = $_GET['nidn'];
// Delete data row from table based on given id

$result = mysqli_query($mysqli, "UPDATE dosen SET is_delete=1 WHERE nidn=$nidn");
// After delete redirect to Home, so that latest user list will be displayed.
header("Location:/dosen");