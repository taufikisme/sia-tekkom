<?php
	include_once("../is_logged_in.php");
	// Create database connection using config file
	include_once("../config.php");
	
	// Fetch data
	$home_rs = mysqli_query($mysqli, "SELECT rs.tahun_ajaran, rs.nim, m.nama, SUM(mk.sks_mk) AS total_sks FROM rencana_studi AS rs LEFT JOIN mahasiswa AS m ON rs.nim = m.nim LEFT JOIN mata_kuliah AS mk ON rs.kode_mk = mk.kode_mk GROUP BY rs.tahun_ajaran;");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-
scale=1.0">

<title>Rencana Studi</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
	<?php include('../navbar.php') ?>
	<main class="px-4 py-4">
		<section>
			<h3>Tabel Rencana Studi</h3>
			<table class="table" width='80%' border=1>
			<tr>
				<th>Nama Mahasiswa</th>
				<th>Tahun Ajaran</th>
				<th>Total SKS</th>
				<th>Action</th>
			</tr>

			<?php
				while($item = mysqli_fetch_array($home_rs)) {
					echo "<tr>";
					echo "<td>".$item['nama']."</td>";
					echo "<td>".$item['tahun_ajaran']."</td>";
					echo "<td>".$item['total_sks']."</td>";
					echo "<td><a href='/rencana_studi/addRencanaStudi.php?nim=$item[nim]'>Lihat IRS</a></td>";
					echo "<tr>";
				}
			?>

			</table>
		</section>
	</main>
</html>