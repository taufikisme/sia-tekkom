<?php
include_once("../is_logged_in.php");
// include database connection file
include_once("../config.php");
// Get id from URL to delete that data
$id = $_GET['id'];
$nim = $_GET['nim'];
// Delete data row from table based on given id
$result = mysqli_query($mysqli, "DELETE FROM rencana_studi WHERE id='$id'");
// After delete redirect to Home, so that latest user list will be displayed.
header("Location:/rencana_studi/addRencanaStudi.php?nim=" . $nim);
?>