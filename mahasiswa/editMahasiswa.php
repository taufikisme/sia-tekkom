<?php
include_once("../is_logged_in.php");
// Create database connection using config file
include_once("../config.php");

// Display selected mahasiswa based on nim
// Getting id from url
$nim = $_GET['nim'];
// Fetch data based on id
$result = mysqli_query($mysqli, "SELECT * FROM mahasiswa WHERE nim=$nim");

while($mahasiswa = mysqli_fetch_array($result))
{
	$nim = $mahasiswa['nim'];
	$nama = $mahasiswa['nama'];
	$jenis_kelamin = $mahasiswa['jenis_kelamin'];
	$tgl_lahir = $mahasiswa['tgl_lahir'];
	$kota = $mahasiswa['kota'];
	$provinsi = $mahasiswa['provinsi'];
	$telp = $mahasiswa['telp'];
	$status = $mahasiswa['status'];
	$angkatan = $mahasiswa['angkatan'];
	$semester = $mahasiswa['semester'];
}
?>

<?php
	// Check If form submitted, insert form data into users table.
	if(isset($_POST['update'])) {
		try {
			$nim = $_GET['nim'];
			$nama = $_POST['nama'];
			$jenis_kelamin = $_POST['jenis_kelamin'];
			$tgl_lahir = $_POST['tgl_lahir'];
			$kota = $_POST['kota'];
			$provinsi = $_POST['provinsi'];
			$telp = $_POST['telp'];
			$status = $_POST['status'];
			$angkatan = $_POST['angkatan'];
			$semester = $_POST['semester'];
			// include database connection file
			include_once("../config.php");
			// Insert user data into table

			$result = mysqli_query($mysqli, "UPDATE mahasiswa SET 
			nim='$nim', 
			nama='$nama',
			jenis_kelamin='$jenis_kelamin',
			tgl_lahir='$tgl_lahir',
			kota='$kota',
			provinsi='$provinsi',
			telp='$telp',
			status='$status',
			angkatan='$angkatan',
			semester='$semester'
			WHERE nim=$nim");
			
			// Show message when user added
			echo "Berhasil memperbarui mahasiswa!";
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

</head>
<body>
	<?php include('../navbar.php') ?>
	<main>
		<div>
			<form action="" method="post" name="form">
				<h3>Add Mahasiswa</h3>
				<table width="25%" border="0">
					<tr>
						<td>NIM</td>
						<td><input type="text" name="nim" value="<?= $nim ?>" required readonly></td>
					</tr>
					<tr>
						<td>Nama</td>
						<td><input type="text" name="nama" value="<?= $nama ?>" required></td>
					</tr>
					<tr>
						<td>Jenis Kelamin</td>
						<td>
							<select name="jenis_kelamin">
								<?php if ($jenis_kelamin == "laki-laki"): ?>
								<option value="laki-laki" selected>Laki-laki</option>
								<?php else: ?>
								<option value="laki-laki">Laki-laki</option>
								<?php endif ?>
								<?php if ($jenis_kelamin == "perempuan"): ?>
								<option value="perempuan">Perempuan</option>
								<?php else: ?>
								<option value="perempuan">Perempuan</option>
								<?php endif ?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Tanggal Lahir</td>
						<td><input type="date" name="tgl_lahir" value="<?= $tgl_lahir ?>" required></td>
					</tr>
					<tr>
						<td>Kota</td>
						<td><input type="text" name="kota" value="<?= $kota ?>" required></td>
					</tr>
					<tr>
						<td>Provinsi</td>
						<td><input type="text" name="provinsi" value="<?= $provinsi ?>" required></td>
					</tr>
					<tr>
						<td>Telp</td>
						<td><input type="text" name="telp" value="<?= $telp ?>" required></td>
					</tr>
					<tr>
						<td>Status</td>
						<td>
							<select name="status">
								<?php if ($status == "aktif"): ?>
								<option value="aktif" selected>Aktif</option>
								<?php else: ?>
								<option value="aktif">Aktif</option>
								<?php endif ?>

								<?php if ($status == "belum her-reg"): ?>
								<option value="belum her-reg" selected>Belum Her-reg</option>
								<?php else: ?>
								<option value="belum her-reg">Belum Her-reg</option>
								<?php endif ?>

								<?php if ($status == "cuti"): ?>
								<option value="cuti" selected>Cuti</option>
								<?php else: ?>
								<option value="cuti">Cuti</option>
								<?php endif ?>

								<?php if ($status == "non-aktif"): ?>
								<option value="non-aktif" selected>Non-aktif</option>
								<?php else: ?>
								<option value="non-aktif">Non-aktif</option>
								<?php endif ?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Angkatan</td>
						<td><input type="text" name="angkatan" value="<?= $angkatan ?>" required></td>
					</tr>
					<tr>
						<td>Semester</td>
						<td><input type="number" name="semester" value="<?= $semester ?>" required></td>
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