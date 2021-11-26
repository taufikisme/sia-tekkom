<?php
include_once("../is_logged_in.php");
// include database connection file
include_once("../config.php");
// Get id from URL to delete that data
$nim = $_GET['nim'];
// Delete data row from table based on given nim
$result = mysqli_query($mysqli, "DELETE FROM mahasiswa WHERE nim='$nim'");
// After delete redirect to Home, so that latest user list will be displayed.
header("Location:/mahasiswa");
?>