<?php
// include database connection file
include_once("../config.php");
// Get id from URL to delete that data
$kode_mk = $_GET['kode_mk'];
// Delete data row from table based on given id

$result = mysqli_query($mysqli, "UPDATE mata_kuliah SET is_delete=1 WHERE kode_mk=$kode_mk");
// After delete redirect to Home, so that latest user list will be displayed.
header("Location:/mata_kuliah");