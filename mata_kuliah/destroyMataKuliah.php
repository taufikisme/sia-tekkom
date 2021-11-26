<?php
include_once("../is_logged_in.php");
// include database connection file
include_once("../config.php");
// Get id from URL to delete that data
$kode_mk = $_GET['kode_mk'];
// Delete data row from table based on given kode_mk
$result = mysqli_query($mysqli, "DELETE FROM mata_kuliah WHERE kode_mk='$kode_mk'");
// After delete redirect to Home, so that latest user list will be displayed.
header("Location:/mata_kuliah");
?>