<?php
// prosesEditData.php

// Lakukan koneksi ke database (gunakan koneksi yang sesuai dengan konfigurasi Anda)
include "db_conn.php";

// Cek apakah ID transaksi dikirimkan melalui metode GET
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Tangkap ID transaksi dari parameter GET
    $id_transaksi = $_GET['id'];

    // Query untuk mengambil data transaksi berdasarkan ID yang diberikan
    $sql = "SELECT * FROM transaksi WHERE no_pesanan = $id_transaksi";


    // Lakukan query ke database
    $result = mysqli_query($conn, $sql);
    

    if (mysqli_num_rows($result) > 0) {
        // Ubah hasil query menjadi array asosiatif
        $data = mysqli_fetch_assoc($result);

        // Keluarkan data dalam format JSON
        header('Content-Type: application/json');
        echo json_encode($data);
    } else {
        // Jika tidak ada hasil dari query, kembalikan pesan error
        http_response_code(404); // Not Found
        echo json_encode(array("message" => "Data transaksi tidak ditemukan."));
    }
} else {
    // Jika tidak ada ID transaksi yang diberikan, kembalikan pesan error
    http_response_code(400); // Bad Request
    echo json_encode(array("message" => "ID transaksi tidak valid."));
}

// Tutup koneksi ke database
mysqli_close($conn);
?>
