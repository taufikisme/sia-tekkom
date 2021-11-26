<?php
	include_once("../is_logged_in.php");
	// Create database connection using config file
	include_once("../config.php");
	
	// Fetch data
	if(isset($_GET['cari'])) {
		try {
			$q = $_GET['q'];
			// include database connection file
			include_once("../config.php");
			// Insert user data into table
			$dosen = mysqli_query($mysqli, "SELECT * FROM dosen WHERE is_delete=0 AND nama LIKE '%$q%'");
		} catch (Exception $e) {
			echo $e->getMessage();
			die();
		}
	} else {
		$dosen = mysqli_query($mysqli, "SELECT * FROM dosen WHERE is_delete=0");
	}
	$dosen_trash = mysqli_query($mysqli, "SELECT * FROM dosen WHERE is_delete=1");
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
				<h3>Add Dosen</h3>
				<table width="25%" border="0">
					<tr>
						<td>NIDN</td>
						<td><input type="num" name="nidn" required></td>
					</tr>
					<tr>
						<td>Nama</td>
						<td><input type="text" name="nama" required></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td><input type="text" name="alamat" required></td>
					</tr>
					<tr>
						<td>Telp</td>
						<td><input type="text" name="telp" required></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="submit" value="Add"></td>
					</tr>
				</table>
			</form>
		</div>
		<section>
			<h3>Tabel Dosen</h3>
			<form action="" method="get" name="form">
				<table width="25%" border="0">
					<tr>
						<td>Cari</td>
						<td><input type="text" name="q" placeholder="Cari Dosen"></td>
						<td><button type="submit" name="cari">Cari</button></td>
					</tr>
				</table>
			</form>
			<br/>
			<table width='80%' border=1>
			<tr>
				<th>NIDN</th>
				<th>Nama</th>
				<th>Alamat</th>
				<th>Telp</th>
				<th>Action</th>
			</tr>

			<?php
				while($item = mysqli_fetch_array($dosen)) {
					echo "<tr>";
					echo "<td>".$item['nidn']."</td>";
					echo "<td>".$item['nama']."</td>";
					echo "<td>".$item['alamat']."</td>";
					echo "<td>".$item['telp']."</td>";
					echo "<td><a href='/dosen/editDosen.php?nidn=$item[nidn]'>Edit</a> | <a href='/dosen/deleteDosen.php?nidn=$item[nidn]'>Delete</a></td>";
					echo "</tr>";
				}
			?>

			</table>
		</section>

		<section>
			<h3>Trash Dosen</h3>
			<table width='80%' border=1>
			<tr>
				<th>NIDN</th>
				<th>Nama</th>
				<th>Alamat</th>
				<th>Telp</th>
				<th>Action</th>
			</tr>

			<?php
				while($item = mysqli_fetch_array($dosen_trash)) {
					echo "<tr>";
					echo "<td>".$item['nidn']."</td>";
					echo "<td>".$item['nama']."</td>";
					echo "<td>".$item['alamat']."</td>";
					echo "<td>".$item['telp']."</td>";
					echo "<td><a href='/dosen/restoreDosen.php?nidn=$item[nidn]'>Restore</a> | <a href='/dosen/destroyDosen.php?nidn=$item[nidn]'>Destroy</a></td>";
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
			$nidn = $_POST['nidn'];
			$nama = $_POST['nama'];
			$alamat = $_POST['alamat'];
			$telp = $_POST['telp'];

			// include database connection file
			include_once("../config.php");
			// Insert user data into table

			$result = mysqli_query($mysqli, "INSERT INTO
			dosen(nidn,nama,alamat,telp) VALUES('$nidn','$nama','$alamat','$telp')");
			header("Refresh:0");

		} catch (Exception $e) {
			echo $e->getMessage();
			die();
		}
	}
?>