<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bantuan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="bantuan.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.44.0/apexcharts.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.44.0/apexcharts.min.css">
    <link rel="icon" href="gambar/favicon.png">
</head>
<body>
    <?php
        include "proses_dasbor.php";
    ?>
    <div class="container">
        <div class="sidebar">
            <div class="header">
                <div class="logolaundry">
                    <img src="gambar/logo_dasbor.svg" alt="">
                </div>
            </div>
            <div class="main">
                <a href="dasbor.php">
                    <div class="list-menu">
                        <img src="gambar/dasbor_hitam.svg" alt="" class="icon">
                        <span class="description">Dasbor</span>
                    </div>
                </a>
                <a href="data_transaksi.php">
                    <div class="list-menu">
                        <img src="gambar/data_transaksi.svg" alt="" class="icon">
                        <span class="description">Data Transaksi</span>
                    </div>
                </a>
                <a href="riwayat_transaksi.php">
                    <div class="list-menu">
                        <img src="gambar/riwayat_transaksi.svg" alt="" class="icon">
                        <span class="description">Riwayat Transaksi</span>
                    </div>
                </a>
                <a href="laporan_keuangan.php">
                    <div class="list-menu">
                        <img src="gambar/laporan_keuangan.svg" alt="" class="icon">
                        <span class="description">Laporan Keuangan</span>
                    </div>
                </a>
            </div>
        </div>
        <div class="wrap-header">
            <header>
                <div class="icon-header">
                    <a href="bantuan.php" title="Bantuan"><img src="gambar/bantuan.svg"></a>
                    <a href="mailto:e.laundry.contact@gmail.com" title="Hubungi Kami"><img src="gambar/hubungi_kami.svg"></a>
                    <a href="#" onclick="openKeluarPopup();" title="Keluar"><img src="gambar/keluar.svg"></a>
                </div>
            </header>
        </div>
        <div class="main-content">
            <div class="wrap-content">
                <h1>Bantuan</h1>
                <br>
                <ol class="angka">
                    <li class="nomor">Membuka Situs E-Laundy
                        <ul class="bullet">
                            <li>Buka situs E-Laundy melalui link berikut</li>
                            <li>Ketika membuka link tersebut, maka muncul halaman login</li>
                            <li>Untuk login, baca bagian login ke E-Laundry</li>
                        </ul>
                    </li>
                    <li class="nomor">Login Ke E-Laundry
                        <ul class="bullet">
                            <li>Hubungi developer melalui email <a href="mailto:e.laundry.contact@gmail.com">e.laundry.contact@gmail.com</a> untuk meminta username dan password</li>
                            <li>Masukkan Username dan Password yang telah diberikan ketika membuka website</li>
                            <li>Anda Berhasil masuk ke perangkat E-Laundry berbasis web</li>
                        </ul>
                    </li>
                    <li class="nomor">Fungsi Halaman Dasbor
                        <ul class="bullet">
                            <li>Halaman <b>Dasbor</b> adalah halaman yang tampil setelah berhasil melakukan login</li>
                            <li>Di dalam fitur dasbor, terdapat informasi terkait jumlah transaksi yang masuk per bulan dan per minggu</li>
                        </ul>
                    </li>
                    <li class="nomor">Fungsi Fitur Tambah Data Pada Halaman Data Transaksi
                        <ul class="bullet">
                            <li>Navigasi ke halaman <b>Data Transaksi</b></li>
                            <li>Klik tombol <strong>Tambah Data</strong> untuk menampilkan formulir Tambah Data</li>
                            <li>Isi formulir atau data yang diperlukan untuk menambahkan transaksi baru</li>
                            <li>Simpan data dan akan ada notifikasi setelah berhasil menambahkan data</li>
                        </ul>
                    </li>
                    <li class="nomor">Fungsi Fitur Edit Data Pada Halaman Data Transaksi
                        <ul class="bullet">
                            <li>Temukan dan pilih transaksi yang ingin diedit</li>
                            <li>Pilih opsi edit dan lakukan perubahan sesuai kebutuhan</li>
                            <li>Simpan perubahan dan akan ada notifikasi data berhasil diedit</li>
                        </ul>
                    </li>
                    <li class="nomor">Fungsi Fitur Hapus Pada Halaman Data Transaksi
                        <ul class="bullet">
                            <li>Temukan dan pilih transaksi yang ingin dihapus</li>
                            <li>Pilih opsi hapus pada kolom aksi</li>
                            <li>Data akan terhapus dan akan ada notifikasi data berhasil dihapus</li>
                        </ul>
                    </li>
                    <li class="nomor">Fungsi Fitur Selesai Pada Halaman Data Transaksi
                        <ul class="bullet">
                            <li>Klik ikon ceklis di kolom aksi dari data transaksi</li>
                            <li>Fitur selesai adalah fitur dengan lambang ceklis yang ada pada tiap data transaksi</li>
                            <li>Fitur selesai akan memindahkan data yang sudah selesai menuju ke <b>Riwayat transksi</b> dan <b>Laporan Keuangan</b></li>
                        </ul>
                    </li>
                    <li class="nomor">Halaman Riwayat Transaksi dan Laporan Keuangan
                        <ul class="bullet">
                            <li>Buka halaman Riwayat Transaksi atau Laporan Keuangan pada menu navigasi</li>
                            <li>Halaman Riwayat transkasi adalah halaman dengan data transaksi yang sudah selesai</li>
                            <li>Halaman Laporan Keuangan adalah halaman data transaksi yang sudah selesai yang menampilkan tanggal dan harga sebagai uang masuk</li>
                        </ul>
                    </li>
                </ol>
            </div>
            <footer>Create at 2023;&copy; CADMAN.
                <p></p>
            </footer>
        </div>
    </div>
    <div class="modal" id="keluar">
        <div class="keluarku">
            <p>Anda yakin ingin keluar?</p>
            <a href="keluar.php"><button class="simpan">Ya</button></a>
            <button class="close" id="tidak">Tidak</button>
        </div>
    </div>
<script>
var keluar = document.getElementById("keluar");
var tidak = document.getElementById("tidak");

tidak.onclick = function() {
    keluar.style.display = "none";
}

function openKeluarPopup() {
    keluar.style.display = "flex";
}        
</script>

</body>
</html>

<?php
}else{
    header("Location:index.php");
    exit();
}
?>