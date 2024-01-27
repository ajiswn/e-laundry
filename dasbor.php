<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasbor - E-Laundry</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="dasbor.css">
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
                    <div class="list-menu-active">
                        <img src="gambar/dasbor_a.svg" alt="" class="icon">
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
            <div class="laundry_dataku">
                <div class="laundry_data" style="width:40rem">
                    <p class="welcome">Selamat Datang, <?php echo $_SESSION['name']; ?></p>
                    <p class="tgl" style="font-weight:300" ><?php echo $formatter->format($currentDateTime)?></p>
                </div>
                <div class="laundry_data">
                    <h5><?php echo $jumlah_orderan_diproses; ?></h5>
                    <img src="gambar/laundry_masuk.svg" alt="">
                    <p>Laundry Proses</p>
                </div>
                <div class="laundry_data">
                    <h5><?php echo $jumlah_orderan_selesai;?></h5>
                    <img src="gambar/laundry_selesai.svg" alt="">
                    <p>Laundry Selesai</p>
                </div>
            </div>
            <div class="data">
                <div class="data_harian">
                    <p>Data Laundry Masuk Per-hari</p>
                    <div id="data-hari"></div>
                </div>
                <div class="data_bulanan">
                    <p>Data Laundry Masuk Per-bulan</p>
                    <div id="data-bulan"></div>
                </div>
            </div>
            <footer>Create at 2023;&copy; CADMAN.
                <p></p>
            </footer>
        </div>
        <div class="modal" id="keluar">
            <div class="keluarku">
                <p>Anda yakin ingin keluar?</p>
                <a href="keluar.php"><button class="simpan">Ya</button></a>
                <button class="close" id="tidak">Tidak</button>
            </div>
        </div>
    </div>
    <script>
        var $primary = '#7367F0';
        var $label_color = '#e7eef7';
        var $purple = '#6f6cec';
        var $strok_color = '#000000';
        var MONTHS = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        var dataNilaiB = "<?php echo $nilaiB; ?>";
        var dataNilai = "<?php echo $nilai; ?>";
        var dataTanggal = "<?php echo $tanggal; ?>";
        var values = dataNilai.split(',').map(Number);
        var labels = dataTanggal.split(',');
        var valuesB = dataNilaiB.split(',').map(Number);

        // Bar perbulan
        var optionsB = {
            chart: {
                height: 300,
                width: 460,
                type: 'line',
                toolbar: {show: false},
                dropShadow: {
                    enabled: true,
                    top: 20,
                    left: 2,
                    blur: 6,
                    opacity: 0.20
                },
            },
            stroke: {
                curve: 'smooth',
                width: 4,
            },
            grid: {
                borderColor: $label_color,
            },
            legend: {
                show: false,
            },
            colors: [$purple],
            markers: {
                size: 0,
                hover: {size: 5}
            },
            series: [{
                name: "Laundry Masuk",
                data: valuesB
            }],
            xaxis: {
                labels: {
                    style: {colors: $strok_color,}
                },
                axisTicks: {
                    show: false,
                },
                categories: MONTHS,
                axisBorder: {
                    show: false,
                },
                tickPlacement: 'on'
            },
            yaxis: {
                tickAmount: 4,
                labels: {
                    style: {color: $strok_color,},
                    formatter: function(val) {
                        return val > 999 ? (val / 1000).toFixed(1) + 'rb' : val;
                    }
                }
            },
            tooltip: {
                x: { show: false }
            },
        };

        // Menampilkan grafik line per bulan
        var chartBulan = new ApexCharts(document.querySelector("#data-bulan"), optionsB);
        chartBulan.render();

        // Bar Data Hari
        var options = {
            chart: {
                height: 300,
                width: 600,
                type: 'line',
                toolbar: {show: false},
                dropShadow: {
                    enabled: true,
                    top: 20,
                    left: 2,
                    blur: 6,
                    opacity: 0.20
                },
            },
            stroke: {
                curve: 'smooth',
                width: 4,
            },
            grid: {
                borderColor: $label_color,
            },
            legend: {
                show: false,
            },
            colors: [$purple],
            markers: {
                size: 0,
                hover: {size: 5}
            },
            series: [{
                name: "Laundry Masuk",
                data: values
            }],
            xaxis: {
                labels: {
                    style: {colors: $strok_color,}
                },
                axisTicks: {
                    show: false,
                },
                categories: labels,
                axisBorder: {
                    show: false,
                },
                tickPlacement: 'on'
            },
            yaxis: {
                tickAmount: 4,
                labels: {
                    style: {color: $strok_color,},
                    formatter: function(val) {
                        return val > 999 ? (val / 1000).toFixed(1) + 'rb' : val;
                    }
                }
            },
            tooltip: {
                x: { show: false }
            },
        };

        // Menampilkan grafik line per hari
        var chartHari = new ApexCharts(document.querySelector("#data-hari"), options);
        chartHari.render();

        var keluar = document.getElementById("keluar");
        var tidak = document.getElementById("keluar");
        tidak.onclick = function() {
        keluar.style.display = "none";
        }

        function openKeluarPopup() {
            var keluar = document.getElementById("keluar");
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