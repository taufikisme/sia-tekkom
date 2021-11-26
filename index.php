<?php
	include_once("is_logged_in.php");
	// Create database connection using config file
	include_once("config.php");
	// Fetch data
	$mahasiswa = mysqli_query($mysqli, "SELECT * FROM mahasiswa WHERE is_delete=0");
	$dosen = mysqli_query($mysqli, "SELECT * FROM dosen WHERE is_delete=0");
	$mata_kuliah = mysqli_query($mysqli, "SELECT mk.kode_mk, mk.nama_mk, mk.kuota_mk, mk.sks_mk, mk.status_mk, mk.kurikulum_mk, mk.hari, mk.waktu, d.nama AS 'dosen' FROM mata_kuliah AS mk INNER JOIN dosen AS d ON mk.nidn = d.nidn WHERE mk.is_delete=0");
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
	<?php include('navbar.php') ?>
	<main>
		<section>
			<h3>Tabel Mahasiswa</h3>
			<table width='80%' border=1>
			<tr>
				<th>NIM</th>
				<th>Nama</th>
				<th>Jenis Kelamin</th>
				<th>Tanggal Lahir</th>
				<th>Alamat</th>
				<th>Telp</th>
				<th>Status</th>
				<th>Angkatan</th>
				<th>Semester</th>
			</tr>

			<?php
				while($item = mysqli_fetch_array($mahasiswa)) {
					echo "<tr>";
					echo "<td>".$item['nim']."</td>";
					echo "<td>".$item['nama']."</td>";
					echo "<td>".$item['jenis_kelamin']."</td>";
					echo "<td>".$item['tgl_lahir']."</td>";
					echo "<td>".$item['kota'].", ".$item['provinsi']."</td>";
					echo "<td>".$item['telp']."</td>";
					echo "<td>".$item['status']."</td>";
					echo "<td>".$item['angkatan']."</td>";
					echo "<td>".$item['semester']."</td>";
					echo "<tr>";
				}
			?>

			</table>
		</section>

		<section>
			<h3>Tabel Dosen</h3>
			<table width='80%' border=1>
			<tr>
				<th>NIDN</th>
				<th>Nama</th>
				<th>Alamat</th>
				<th>Telp</th>
			</tr>

			<?php
				while($item = mysqli_fetch_array($dosen)) {
					echo "<tr>";
					echo "<td>".$item['nidn']."</td>";
					echo "<td>".$item['nama']."</td>";
					echo "<td>".$item['alamat']."</td>";
					echo "<td>".$item['telp']."</td>";
					echo "</tr>";
				}
			?>

			</table>
		</section>

		<section>
			<h3>Tabel Mata Kuliah</h3>
			<table width='80%' border=1>
			<tr>
				<th>Kode</th>
				<th>Nama</th>
				<th>Kuota</th>
				<th>SKS</th>
				<th>Status</th>
				<th>Kurikulum</th>
				<th>Jadwal</th>
				<th>Dosen Pengampu</th>
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
					echo "<td>".$item['dosen']."</td>";
					echo "</tr>";
				}
			?>

			</table>
		</section>
	</main>
</html>