<?php
	include_once("../is_logged_in.php");
	// Create database connection using config file
	include_once("../config.php");
	
	// Fetch data
	// Fetch data
	if(isset($_GET['cari'])) {
		try {
			$q = $_GET['q'];
			// include database connection file
			include_once("../config.php");
			// Insert user data into table
			$mata_kuliah = mysqli_query($mysqli, "SELECT * FROM mata_kuliah WHERE is_delete=0 AND nama_mk LIKE '%$q%'");
		} catch (Exception $e) {
			echo $e->getMessage();
			die();
		}
	} else {
		$mata_kuliah = mysqli_query($mysqli, "SELECT * FROM mata_kuliah WHERE is_delete=0");
	}
	$mata_kuliah_trash = mysqli_query($mysqli, "SELECT * FROM mata_kuliah WHERE is_delete=1");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-
scale=1.0">

<title>Mata Kuliah</title>
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
						<td><input class="form-control" type="number" name="kode_mk" required></td>
					</tr>
					<tr>
						<td>Nama</td>
						<td><input class="form-control" type="text" name="nama_mk" required></td>
					</tr>
					<tr>
						<td>Kuota</td>
						<td><input class="form-control" type="number" name="kuota_mk" required></td>
					</tr>
					<tr>
						<td>SKS</td>
						<td><input class="form-control" type="number" name="sks_mk" required></td>
					</tr>
					<tr>
						<td>Status</td>
						<td>
							<select class="form-control" name="status_mk">
								<option>-- Status --</option>
								<option value="ditawarkan">Ditawarkan</option>
								<option value="nonaktif">Nonaktif</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Kurikulum</td>
						<td><input class="form-control" type="text" name="kurikulum_mk" required></td>
					</tr>
					<tr>
						<td>Hari</td>
						<td><input class="form-control" type="text" name="hari" required></td>
					</tr>
					<tr>
						<td>Waktu</td>
						<td><input class="form-control" type="text" name="waktu" required></td>
					</tr>
					<tr>
						<td>NIDN</td>
						<td><input class="form-control" type="number" name="nidn" required></td>
					</tr>
					<tr>
						<td></td>
						<td><input class="btn btn-primary" type="submit" name="submit" value="Add"></td>
					</tr>
				</table>
			</form>
		</div>
		<section class="mt-5">
			<h3>Tabel Mata Kuliah</h3>
			<form action="" method="get" name="form">
				<table width="25%" border="0">
					<tr>
						<td>Cari</td>
						<td><input class="form-control" type="text" name="q" placeholder="Cari Mata Kuliah"></td>
						<td><button class="btn btn-primary" type="submit" name="cari">Cari</button></td>
					</tr>
				</table>
			</form>
			<br/>
			<table class="table" width='80%' border=1>
			<tr>
				<th>Kode</th>
				<th>Nama</th>
				<th>Kuota</th>
				<th>SKS</th>
				<th>Status</th>
				<th>Kurikulum</th>
				<th>Jadwal</th>
				<th>NIDN</th>
				<th>Action</th>
			</tr>

			<?php
				while($item = mysqli_fetch_array($mata_kuliah)) {
					echo "<tr>";
					echo "<td>".$item['kode_mk']."</td>";
					echo "<td>".$item['nama_mk']."</td>";
					echo "<td>".$item['kuota_mk']."</td>";
					echo "<td>".$item['sks_mk']."</td>";
					echo "<td>".$item['status_mk']."</td>";
					echo "<td>".$item['kurikulum_mk']."</td>";
					echo "<td>".$item['hari'].", ".$item['waktu']."</td>";
					echo "<td>".$item['nidn']."</td>";
					echo "<td><a href='/mata_kuliah/editMataKuliah.php?kode_mk=$item[kode_mk]'>Edit</a> | <a href='/mata_kuliah/deleteMataKuliah.php?kode_mk=$item[kode_mk]'>Delete</a></td>";
					echo "</tr>";
				}
			?>

			</table>
		</section>

		<section class="mt-5">
			<h3>Trash Mata Kuliah</h3>
			<table class="table" width='80%' border=1>
			<tr>
				<th>Kode</th>
				<th>Nama</th>
				<th>Kuota</th>
				<th>SKS</th>
				<th>Status</th>
				<th>Kurikulum</th>
				<th>Jadwal</th>
				<th>NIDN</th>
				<th>Action</th>
			</tr>

			<?php
				while($item = mysqli_fetch_array($mata_kuliah_trash)) {
					echo "<tr>";
					echo "<td>".$item['kode_mk']."</td>";
					echo "<td>".$item['nama_mk']."</td>";
					echo "<td>".$item['kuota_mk']."</td>";
					echo "<td>".$item['sks_mk']."</td>";
					echo "<td>".$item['status_mk']."</td>";
					echo "<td>".$item['kurikulum_mk']."</td>";
					echo "<td>".$item['hari'].", ".$item['waktu']."</td>";
					echo "<td>".$item['nidn']."</td>";
					echo "<td><a href='/mata_kuliah/restoreMataKuliah.php?kode_mk=$item[kode_mk]'>Restore</a> | <a href='/mata_kuliah/destroyMataKuliah.php?kode_mk=$item[kode_mk]'>Destroy</a></td>";
					echo "</tr>";
				}
			?>

			</table>
		</section>
	</main>
</html>

<?php
	// Check If form submitted, insert form data into users table.
	if(isset($_POST['submit'])) {
		try {
			$kode_mk = $_POST['kode_mk'];
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

			$result = mysqli_query($mysqli, "INSERT INTO
			mata_kuliah(kode_mk,nama_mk,kuota_mk,sks_mk,status_mk,kurikulum_mk,hari,waktu,nidn) VALUES('$kode_mk','$nama_mk','$kuota_mk','$sks_mk','$status_mk','$kurikulum_mk','$hari','$waktu','$nidn')");
			header("Refresh:0");

		} catch (Exception $e) {
			echo $e->getMessage();
			die();
		}
	}
?>