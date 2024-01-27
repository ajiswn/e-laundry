<?php
date_default_timezone_set('Asia/Jakarta');
$tanggal = date("Ymd");
include "db_conn.php";

// Lakukan query untuk mendapatkan nomor transaksi tertinggi pada tanggal tertentu
$query = "SELECT MAX(CAST(SUBSTRING(no_pesanan, 9) AS UNSIGNED)) AS max_transaksi FROM transaksi WHERE tanggal = '$tanggal'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$max_transaksi = $row['max_transaksi'];

// Jika tidak ada transaksi pada tanggal tertentu, atur nomor transaksi menjadi 1
if ($max_transaksi === null) {
    $jumlah_transaksi = 1;
} else {
    $jumlah_transaksi = $max_transaksi + 1;
}

$nomor_transaksi = $tanggal . str_pad($jumlah_transaksi, 3, '0', STR_PAD_LEFT);

// Tutup koneksi ke database
mysqli_close($conn);
?>
