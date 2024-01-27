<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi - E-Laundry</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="riwayat_transaksi.css">
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
                    <div class="list-menu-active">
                        <img src="gambar/riwayat_transaksi_a.svg" alt="" class="icon">
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
            <div class="popbox">
            <table class="table_dt" cellspacing="0" width="100%">

                <thead>
                    <tr>
                        <th>No Transaksi</th>
                        <th>Berat (Kg)</th>
                        <th>Jenis</th>
                        <th>Harga</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 

                        include"db_conn.php";
                        $sql = "select * from transaksi where status = 'Selesai' ORDER BY tanggal DESC, no_pesanan DESC";
                        $no = 0;
                        
                        $ambil = mysqli_query($conn , $sql);
                        // Periksa apakah ada baris hasil dari query atau tidak
                        if (mysqli_num_rows($ambil) > 0) {
                            // Jika ada hasil, tampilkan data seperti yang Anda lakukan sebelumnya
                            while ($data = mysqli_fetch_array($ambil)) {      
                                $harga_rupiah = "Rp" . number_format($data['harga'], 0, ',', '.');
                                $tanggal = date("d-M-Y", strtotime($data['tanggal']));
                        ?>
                        <tr>
                            <td><?php echo $data['no_pesanan']?></td>
                            <td><?php echo $data['berat'];?></td>
                            <td><?php echo $data['jenis_pesanan'];?></td>
                            <td><?php echo $harga_rupiah;?></td>
                            <td><?php echo $tanggal;?></td>
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