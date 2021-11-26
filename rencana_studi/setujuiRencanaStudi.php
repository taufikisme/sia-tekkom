<?php
// include database connection file
include_once("../config.php");
// Get id from URL to delete that data
$id = $_GET['id'];
$nim = $_GET['nim'];
// Delete data row from table based on given id

$result = mysqli_query($mysqli, "UPDATE rencana_studi SET status_persetujuan='disetujui' WHERE id=$id");
// After delete redirect to Home, so that latest user list will be displayed.
header("Location:/rencana_studi/addRencanaStudi.php?nim=" . $nim);