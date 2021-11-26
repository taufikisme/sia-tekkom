<?php
// include database connection file
include_once("../config.php");
// Get id from URL to delete that data
$nim = $_GET['nim'];
// Delete data row from table based on given id

$result = mysqli_query($mysqli, "UPDATE mahasiswa SET is_delete=1 WHERE nim=$nim");
// After delete redirect to Home, so that latest user list will be displayed.
header("Location:/mahasiswa");