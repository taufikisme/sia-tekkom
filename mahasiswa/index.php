<?php
	// Create database connection using config file
	include_once("../config.php");
	
	// Fetch data
	if(isset($_GET['cari'])) {
		try {
			$q = $_GET['q'];
			// include database connection file
			include_once("../config.php");
			// Insert user data into table
			$mahasiswa = mysqli_query($mysqli, "SELECT * FROM mahasiswa WHERE nama LIKE '%$q%' AND is_delete=0");
		} catch (Exception $e) {
			echo $e->getMessage();
			die();
		}
	} else {
		$mahasiswa = mysqli_query($mysqli, "SELECT * FROM mahasiswa WHERE is_delete=0");
	}
	$mahasiswa_trash = mysqli_query($mysqli, "SELECT * FROM mahasiswa WHERE is_delete=1");
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
	<nav>
		<a href="/">Home</a> | 
		<a href="/mahasiswa">Mahasiswa</a> | 
		<a href="/mata_kuliah">Mata Kuliah</a> | 
		<a href="/dosen">Dosen</a> | 
		<a href="/rencana_studi">Rencana Studi</a>
	</nav>
	<main>
		<div>
			<form action="" method="post" name="form">
				<h3>Add Mahasiswa</h3>
				<table width="25%" border="0">
					<tr>
						<td>NIM</td>
						<td><input type="text" name="nim" required></td>
					</tr>
					<tr>
						<td>Nama</td>
						<td><input type="text" name="nama" required></td>
					</tr>
					<tr>
						<td>Jenis Kelamin</td>
						<td>
							<select name="jenis_kelamin">
								<option>-- Jenis Kelamin --</option>
								<option value="laki-laki">Laki-laki</option>
								<option value="perempuan">Perempuan</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Tanggal Lahir</td>
						<td><input type="date" name="tgl_lahir" required></td>
					</tr>
					<tr>
						<td>Kota</td>
						<td><input type="text" name="kota" required></td>
					</tr>
					<tr>
						<td>Provinsi</td>
						<td><input type="text" name="provinsi" required></td>
					</tr>
					<tr>
						<td>Telp</td>
						<td><input type="text" name="telp" required></td>
					</tr>
					<tr>
						<td>Status</td>
						<td>
							<select name="status">
								<option>-- Status --</option>
								<option value="aktif">Aktif</option>
								<option value="belum her-reg">Belum Her-reg</option>
								<option value="cuti">cuti</option>
								<option value="non-aktif">non-aktif</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Angkatan</td>
						<td><input type="text" name="angkatan" required></td>
					</tr>
					<tr>
						<td>Semester</td>
						<td><input type="number" name="semester" required></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="submit" value="Add"></td>
					</tr>
				</table>
			</form>
		</div>
		<section>
			<h3>Tabel Mahasiswa</h3>
			<form action="" method="get" name="form">
				<table width="25%" border="0">
					<tr>
						<td>Cari</td>
						<td><input type="text" name="q" placeholder="Cari mahasiswa"></td>
						<td><button type="submit" name="cari">Cari</button></td>
					</tr>
				</table>
			</form>
			<br/>
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
				<th>Action</th>
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
					echo "<td><a href='/mahasiswa/editMahasiswa.php?nim=$item[nim]'>Edit</a> | <a href='/mahasiswa/deleteMahasiswa.php?nim=$item[nim]'>Delete</a></td>";
					echo "<tr>";
				}
			?>

			</table>
		</section>

		<section>
			<h3>Trash Mahasiswa</h3>
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
				<th>Action</th>
			</tr>

			<?php
				while($item = mysqli_fetch_array($mahasiswa_trash)) {
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
					echo "<td><a href='/mahasiswa/restoreMahasiswa.php?nim=$item[nim]'>Restore</a> | <a href='/mahasiswa/destroyMahasiswa.php?nim=$item[nim]'>Destroy</a></td>";
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

			$result = mysqli_query($mysqli, "INSERT INTO
			mahasiswa(nim,nama,jenis_kelamin,tgl_lahir,kota,provinsi,telp,status,angkatan,semester) VALUES('$nim','$nama','$jenis_kelamin','$tgl_lahir','$kota','$provinsi','$telp','$status','$angkatan','$semester')");
			header("Refresh:0");

		} catch (Exception $e) {
			echo $e->getMessage();
			die();
		}
	}
?>