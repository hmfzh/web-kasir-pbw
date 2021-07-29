<?php
require 'config/koneksi.php';
$idUser = $_GET['idUser'];


$sql = "DELETE FROM users WHERE id_user = $idUser";
$result = mysqli_query($koneksi, $sql);

if ($result) {
	echo '
	<script>
	alert("Hapus berhasil!");
	window.location.href="admin.php"
	</script>
	';
} else {
	echo '
	<script>
	alert("Hapus gagal!");
	window.location.href="hapus.php"
	</script>
	';
}


?>