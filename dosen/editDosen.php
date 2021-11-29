<?php
include_once("../is_logged_in.php");
// Create database connection using config file
include_once("../config.php");

// Display selected dosen based on nidn
// Getting id from url
$nidn = $_GET['nidn'];
// Fetch data based on id
$result = mysqli_query($mysqli, "SELECT * FROM dosen WHERE nidn=$nidn");

while($dosen = mysqli_fetch_array($result))
{
	$nidn = $dosen['nidn'];
	$nama = $dosen['nama'];
	$alamat = $dosen['alamat'];
	$telp = $dosen['telp'];
}
?>

<?php
	// Check If form submitted, insert form data into users table.
	if(isset($_POST['update'])) {
		try {
			$nidn = $_GET['nidn'];
			$nama = $_POST['nama'];
			$alamat = $_POST['alamat'];
			$telp = $_POST['telp'];

			// include database connection file
			include_once("../config.php");
			// Insert user data into table

			$result = mysqli_query($mysqli, "UPDATE dosen SET 
			nidn='$nidn', 
			nama='$nama',
			alamat='$alamat',
			telp='$telp' 
			WHERE nidn=$nidn");
			
			// Show message when user added
			echo "Berhasil memperbarui dosen!";
		} catch (Exception $e) {
			echo $e->getMessage();
			die();
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-
scale=1.0">

<title>Edit Dosen</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
	<?php include('../navbar.php') ?>
	<main>
		<div>
			<form action="" method="post" name="form">
				<h3>Add Dosen</h3>
				<table width="25%" border="0">
					<tr>
						<td>NIDN</td>
						<td><input type="text" name="nidn" value="<?= $nidn ?>" required readonly></td>
					</tr>
					<tr>
						<td>Nama</td>
						<td><input type="text" name="nama" value="<?= $nama ?>" required></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td><input type="text" name="alamat" value="<?= $alamat ?>" required></td>
					</tr>
					<tr>
						<td>Telp</td>
						<td><input type="text" name="telp" value="<?= $telp ?>" required></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="update" value="Update"></td>
					</tr>
				</table>
			</form>
		</div>
	</main>
</html>