<nav class="px-4 py-2 border nav justify-content-between">
	<div class="my-2">
		<b>SIA TEKKOM</b>, Hallo <?= $_SESSION["nama"] . "!" ?>
	</div>
	<ul class="nav">
		<li class="nav-item">
			<a class="nav-link" href="/">Home</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/mahasiswa">Mahasiswa</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/mata_kuliah">Mata Kuliah</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/dosen">Dosen</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/rencana_studi">Rencana Studi</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/logout.php">Logout</a>
		</li>
	</ul>
</nav>