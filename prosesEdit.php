<?php
// prosesEdit.php

// Lakukan koneksi ke database (gunakan koneksi yang sesuai dengan konfigurasi Anda)
include "db_conn.php";
session_start();

if (isset($_POST['tblsubmit'])) {
    $no_pesanan = $_POST['no_pesanan'];
    $berat = $_POST['berat'];
    $jenis_pesanan = $_POST['jenis_pesanan'];
    $harga = $_POST['harga'];
    $tanggal = $_POST['tanggal'];

    $harga = preg_replace('/[^0-9]/', '', $harga);

    // Lakukan query untuk memperbarui data transaksi berdasarkan ID yang diberikan
    $sql = "UPDATE transaksi SET 
                no_pesanan = '$no_pesanan', 
                berat = '$berat', 
                jenis_pesanan = '$jenis_pesanan', 
                harga = '$harga', 
                tanggal = '$tanggal' 
            WHERE no_pesanan = $no_pesanan";

    // Jalankan query ke database
    if (mysqli_query($conn, $sql)) {
        // Jika query berhasil dieksekusi, redirect ke halaman data transaksi dengan pesan sukses
        $_SESSION['notif'] = '<div class="notif" id="notif">
								Data <b>'.$no_pesanan.'</b> berhasil diedit !
								<button class="clsnotif"><i class="fa-solid fa-xmark"></i></button>
								</div>';
    
    } else {
        // Jika query gagal dieksekusi, tampilkan pesan error
        $_SESSION['notif'] = '<div class="notif" id="notif">
								Gagak mengedit data: '. mysqli_error($conn).'
								<button class="clsnotif"><i class="fa-solid fa-xmark"></i></button>
								</div>';
    }

    header("Location: data_transaksi.php");
        exit();
}

// Tutup koneksi ke database
mysqli_close($conn);
?>
