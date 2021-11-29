<?php
include_once("../is_logged_in.php");
// Create database connection using config file
include_once("../config.php");

// Display selected mahasiswa based on nim
// Getting id from url
$kode_mk = $_GET['kode_mk'];
// Fetch data based on id
$result = mysqli_query($mysqli, "SELECT * FROM mata_kuliah WHERE kode_mk=$kode_mk");

while($mata_kuliah = mysqli_fetch_array($result))
{
	$kode_mk = $mata_kuliah['kode_mk'];
	$nama_mk = $mata_kuliah['nama_mk'];
	$kuota_mk = $mata_kuliah['kuota_mk'];
	$sks_mk = $mata_kuliah['sks_mk'];
	$status_mk = $mata_kuliah['status_mk'];
	$kurikulum_mk = $mata_kuliah['kurikulum_mk'];
	$hari = $mata_kuliah['hari'];
	$waktu = $mata_kuliah['waktu'];
	$nidn = $mata_kuliah['nidn'];
}
?>

<?php
	// Check If form submitted, insert form data into users table.
	if(isset($_POST['update'])) {
		try {
			$kode_mk = $_GET['kode_mk'];
			$nama_mk = $_POST['nama_mk'];
			$kuota_mk = $_POST['kuota_mk'];
			$sks_mk = $_POST['sks_mk'];
			$status_mk = $_POST['status_mk'];
			$kurikulum_mk = $_POST['kurikulum_mk'];
			$hari = $_POST['hari'];
			$waktu = $_POST['waktu'];
			$nidn = $_POST['nidn'];

			// include database connection file
			include_once("../config.php");
			// Insert user data into table

			$result = mysqli_query($mysqli, "UPDATE mata_kuliah SET 
			kode_mk='$kode_mk', 
			nama_mk='$nama_mk', 
			kuota_mk='$kuota_mk', 
			sks_mk='$sks_mk', 
			status_mk='$status_mk', 
			kurikulum_mk='$kurikulum_mk', 
			hari='$hari', 
			waktu='$waktu', 
			nidn='$nidn' 
			WHERE kode_mk=$kode_mk");
			
			// Show message when user added
			echo "Berhasil memperbarui Mata Kuliah!";
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

<title>Homepage</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
	<?php include('../navbar.php') ?>
	<main class="px-4 py-4">
		<div>
			<form action="" method="post" name="form">
				<h3>Add Mata Kuliah</h3>
				<table width="25%" border="0">
					<tr>
						<td>Kode</td>
						<td><input class="form-control" type="number" name="kode_mk" value="<?= $kode_mk ?>" required></td>
					</tr>
					<tr>
						<td>Nama</td>
						<td><input class="form-control" type="text" name="nama_mk" value="<?= $nama_mk ?>" required></td>
					</tr>
					<tr>
						<td>Kuota</td>
						<td><input class="form-control" type="number" name="kuota_mk" value="<?= $kuota_mk ?>" required></td>
					</tr>
					<tr>
						<td>SKS</td>
						<td><input class="form-control" type="number" name="sks_mk" value="<?= $sks_mk ?>" required></td>
					</tr>
					<tr>
						<td>Status</td>
						<td>
							<select class="form-control" name="status_mk">
								<?php if ($status_mk == "ditawarkan"): ?>
								<option value="ditawarkan" selected>Ditawarkan</option>
								<?php else: ?>
									<option value="ditawarkan">Ditawarkan</option>
								<?php endif ?>

								<?php if ($status_mk == "nonaktif"): ?>
								<option value="nonaktif" selected>Nonaktif</option>
								<?php else: ?>
									<option value="nonaktif">Nonaktif</option>
								<?php endif ?>
							
							</select>
						</td>
					</tr>
					<tr>
						<td>Kurikulum</td>
						<td><input class="form-control" type="text" name="kurikulum_mk" value="<?= $kurikulum_mk ?>" required></td>
					</tr>
					<tr>
						<td>Hari</td>
						<td><input class="form-control" type="text" name="hari" value="<?= $hari ?>" required></td>
					</tr>
					<tr>
						<td>Waktu</td>
						<td><input class="form-control" type="text" name="waktu" value="<?= $waktu ?>" required></td>
					</tr>
					<tr>
						<td>NIDN</td>
						<td><input class="form-control" type="number" name="nidn" value="<?= $nidn ?>" required></td>
					</tr>
					<tr>
						<td></td>
						<td><input class="btn btn-primary" type="submit" name="update" value="Update"></td>
					</tr>
				</table>
			</form>
		</div>
	</main>
</html>