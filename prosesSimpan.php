<?php
	include"db_conn.php";
	session_start();

	if (isset($_POST['tblsubmit'])) {
		$no_pesanan = $_POST['no_pesanan'];
		$berat = $_POST['berat'];
		$jenis = $_POST['jenis_pesanan'];
		$harga = $_POST['harga'];
		$tanggal = $_POST['tanggal'];
		$status = 'Proses';

		$harga = preg_replace('/[^0-9]/', '', $harga);
	

	$sql = "insert into transaksi values ('$no_pesanan', '$berat', '$jenis', '$harga', '$tanggal','$status')";
	// $simpan = mysqli_query($conn, $sql);
	if (mysqli_query($conn, $sql)) {
        // Pesan notifikasi jika data berhasil ditambahkan
        $_SESSION['notif'] = '<div class="notif" id="notif">
								Data <b>'.$no_pesanan.'</b> berhasil ditambah !
								<button class="clsnotif"><i class="fa-solid fa-xmark"></i></button>
								</div>';
    } else {
        // Pesan notifikasi jika terjadi kesalahan
        $_SESSION['notif'] = '<div class="notif" id="notif">
								Gagal menambahkan data: '. mysqli_error($conn).'
								<button class="clsnotif"><i class="fa-solid fa-xmark"></i></button>
								</div>';
    }

	header("Location: data_transaksi.php");
	exit();
	}  

	mysqli_close($conn);
?>