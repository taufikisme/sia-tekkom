<?php
	include_once("../is_logged_in.php");
	// Create database connection using config file
	include_once("../config.php");
	$nim = $_GET['nim'];
	// Fetch data
	$rencana_studi = mysqli_query($mysqli, "SELECT m.nama, mk.nama_mk, mk.sks_mk, rs.tahun_ajaran, rs.semester, rs.status, rs.status_persetujuan, rs.nilai_mk, rs.id FROM rencana_studi AS rs LEFT JOIN mahasiswa AS m ON rs.nim = m.nim LEFT JOIN mata_kuliah AS mk ON rs.kode_mk = mk.kode_mk WHERE rs.nim='$nim';");

	$mhs = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM mahasiswa WHERE nim='$nim'"));

	$matkul = mysqli_query($mysqli, "SELECT * FROM mata_kuliah WHERE semester_mk='$mhs[semester]' AND kode_mk NOT IN (SELECT rs.kode_mk FROM rencana_studi AS rs WHERE rs.nim='$nim') AND status_mk='ditawarkan' AND is_delete=0");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-
scale=1.0">

<title>Add Rencana Studi</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
	<?php include('../navbar.php') ?>
	<main class="px-4 py-4">
	<div>
			<form action="" method="post" name="form">
				<input type="hidden" name="id_admin" value="1" />
				<h3>Add Rencana Studi</h3>
				<table width="25%" border="0">
					<tr>
						<td>NIM</td>
						<td><input class="form-control" type="number" name="nim" value="<?= $mhs['nim'] ?>" readonly required></td>
					</tr>
					<tr>
						<td>Kode MK</td>
						<td>
							<select class="form-control" name="kode_mk" required>
								<option>-- Mata Kuliah --</option>
								<?php while($item = mysqli_fetch_array($matkul)): ?>
								<option value="<?= $item['kode_mk'] ?>"><?= $item['nama_mk'] ?></option>
								<?php endwhile ?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Status</td>
						<td>
							<select class="form-control" name="status" required>
								<option>-- Status --</option>
								<option value="wajib">Wajib</option>
								<option value="pilihan">Pilihan</option>
								<option value="perbaikan">Perbaikan</option>
								<option value="mengulang">Mengulang</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Tahun Ajaran</td>
						<td><input class="form-control" type="text" name="tahun_ajaran" required></td>
					</tr>
					<tr>
						<td>Semester</td>
						<td><input class="form-control" type="number" name="semester" value="<?= $mhs['semester'] ?>" readonly/></td>
					</tr>
					<tr>
						<td>Status Persetujuan</td>
						<td><input class="form-control" type="text" name="status_persetujuan" value="belum" readonly/></td>
					</tr>
					<tr>
						<td></td>
						<td><input class="btn btn-primary" type="submit" name="submit" value="Add"></td>
					</tr>
				</table>
			</form>
		</div>
		<section class="mt-4">
			<h3>Tabel Rencana Studi</h3>
			<table class="table" width='80%' border=1>
			<tr>
				<th>Nama Mahasiswa</th>
				<th>Mata Kuliah</th>
				<th>SKS</th>
				<th>Tahun Ajaran</th>
				<th>Semester</th>
				<th>Status</th>
				<th>Status Persetujuan</th>
				<th>Action</th>
			</tr>

			<?php
				while($item = mysqli_fetch_array($rencana_studi)) {
					echo "<tr>";
					echo "<td>".$item['nama']."</td>";
					echo "<td>".$item['nama_mk']."</td>";
					echo "<td>".$item['sks_mk']."</td>";
					echo "<td>".$item['tahun_ajaran']."</td>";
					echo "<td>".$item['semester']."</td>";
					echo "<td>".$item['status']."</td>";
					echo "<td>".$item['status_persetujuan']."</td>";
					echo "<td><a href='/rencana_studi/setujuiRencanaStudi.php?nim=$mhs[nim]&id=$item[id]'>Setujui</a> | <a href='/rencana_studi/destroyRencanaStudi.php?nim=$mhs[nim]&id=$item[id]'>Destroy</a></td>";
					echo "<tr>";
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
			$nim = $_POST['nim'];
			$kode_mk = $_POST['kode_mk'];
			$id_admin = $_POST['id_admin'];
			$status = $_POST['status'];
			$tahun_ajaran = $_POST['tahun_ajaran'];
			$semester = $_POST['semester'];
			$status_persetujuan = $_POST['status_persetujuan'];

			// include database connection file
			include_once("../config.php");
			// Insert user data into table

			$result = mysqli_query($mysqli, "INSERT INTO
			rencana_studi(nim,kode_mk,id_admin,status,tahun_ajaran,semester,status_persetujuan) VALUES('$nim','$kode_mk','$id_admin','$status','$tahun_ajaran','$semester','$status_persetujuan')");
			header("Refresh:0");

		} catch (Exception $e) {
			echo $e->getMessage();
			// die();
		}
	}
?>