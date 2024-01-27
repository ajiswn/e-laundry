<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan - E-Laundry</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="laporan_keuangan.css">
    <link rel="icon" href="gambar/favicon.png">
</head>
<body>
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
                <div class="list-menu-active">
                    <img src="gambar/laporan_keuangan_a.svg" alt="" class="icon">
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
        <div class="popbox">
            <table class="table_dt" cellspacing="0" width="100%">

                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Uang Masuk</th>
                </thead>
                <tbody>
                    <?php 

                        include"db_conn.php";
                        $sql = "select tanggal, sum(harga) as 'pemasukan' from transaksi where status = 'Selesai' GROUP BY tanggal ORDER BY tanggal DESC";
                        $no = 0;
                        
                        $ambil = mysqli_query($conn , $sql);
                        // Periksa apakah ada baris hasil dari query atau tidak
                        if (mysqli_num_rows($ambil) > 0) {
                            // Jika ada hasil, tampilkan data seperti yang Anda lakukan sebelumnya
                            while ($data = mysqli_fetch_array($ambil)) {      
                                $pemasukan_rupiah = "Rp" . number_format($data['pemasukan'], 0, ',', '.');
                                $tanggal = date("d-M-Y", strtotime($data['tanggal']));
                        ?>
                        <tr>
                            <td><?php echo $tanggal;?></td>
                            <td><?php echo $pemasukan_rupiah;?></td>
                        </tr>
                        <?php 
                                } // Tutup while
                            } else {
                                // Jika hasil query kosong, tampilkan pesan "Data tidak tersedia" dalam satu baris
                        ?>
                            <tr>
                                <td style="text-align:center;font-weight: 350;" colspan="6">Data tidak tersedia di tabel</td>
                            </tr>
                        <?php } // Tutup else ?>
                </tbody>
            </table>
        </div>
        
            </div>
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