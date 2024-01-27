<?php
include "db_conn.php";
session_start();

if (isset($_GET['id'])) {
    $id_to_done = $_GET['id'];
    $sql = "UPDATE transaksi SET status = 'Selesai' WHERE no_pesanan = '$id_to_done'";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['notif'] = '<div class="notif" id="notif">
								Transaksi <b>'.$id_to_done.'</b> telah diselesaikan ! 
								<button class="clsnotif"><i class="fa-solid fa-xmark"></i></button>
								</div>';
        header("Location: data_transaksi.php"); // Redirect ke halaman utama setelah penghapusan
        exit();
    } else {
        $_SESSION['notif'] = '<div class="notif" id="notif">
								Gagal menyelesaikan transaksi: '. mysqli_error($conn).'
								<button class="clsnotif"><i class="fa-solid fa-xmark"></i></button>
								</div>';
    }
}

mysqli_close($conn);
?>
