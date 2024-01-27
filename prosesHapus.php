<?php
include "db_conn.php";
session_start();

if (isset($_GET['id'])) {
    $id_to_delete = $_GET['id'];
    $sql = "DELETE FROM transaksi WHERE no_pesanan = '$id_to_delete'";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['notif'] = '<div class="notif" id="notif">
								Data <b>'.$id_to_delete.'</b> berhasil dihapus !
								<button class="clsnotif"><i class="fa-solid fa-xmark"></i></button>
								</div>';
        header("Location: data_transaksi.php"); // Redirect ke halaman utama setelah penghapusan
        exit();
    } else {
        $_SESSION['notif'] = '<div class="notif" id="notif">
								Gagal menghapus data: '. mysqli_error($conn).'
								<button class="clsnotif"><i class="fa-solid fa-xmark"></i></button>
								</div>';
    }
}

mysqli_close($conn);
?>
