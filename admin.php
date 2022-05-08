<?php
	// Create database connection using config file
	include_once("config.php");
	error_reporting(0);
 	session_start();

	 if (isset($_SESSION['nama'])) {
		header("Location:/");
	}

	// Check If form submitted, insert form data into users table.
	if(isset($_POST['submit'])) {
		try {
			$email = $_POST['email'];
    		$password = $_POST['password'];

			// include database connection file
			include_once("../config.php");
			// Insert user data into table

			$result = mysqli_query($mysqli, "SELECT * FROM admin WHERE email='$email'");
			if ($result->num_rows > 0){
				$row = mysqli_fetch_array($result);
				if (password_verify($password, $row['password'])){
					$_SESSION['nama'] = $row['nama'];
					echo 'Berhasil Login!';
					header("Location:/");
				} else {
					echo 'Password salah!';
				}
			} else {
				echo 'Email tidak valid!';
			}

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

<title>Admin Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
	<main>
	<div class="">
			<form class="mt-4" action="" method="post" name="form">
				<h3 class="text-center">Login SIA Tekkom</h3>
				<table class="mx-auto mt-4" width="25%" border="0">
					<tr>
						<td>Email</td>
						<td><input class="form-control" type="text" name="email" required></td>
					</tr>
					<tr>
						<td>Password</td>
						<td><input class="form-control" type="password" name="password" required></td>
					</tr>
					<tr>
						<td></td>
						<td><input class="btn btn-primary" type="submit" name="submit" value="Login"></td>
					</tr>
				</table>
			</form>
		</div>
	</main>
</html>