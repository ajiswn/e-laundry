<?php
include "db_conn.php";

    // Set zona waktu sesuai kebutuhan
    date_default_timezone_set('Asia/Jakarta');
    // Mendapatkan waktu saat ini
    $currentDateTime = new DateTime();
    $formatter = new IntlDateFormatter('id_ID', IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'Asia/Jakarta');
    // Menghilangkan informasi zona waktu
    $formatter->setPattern('EEEE, dd MMMM y, HH:mm:ss');

    // Query untuk mengambil jumlah orderan selesai
    $query = "SELECT COUNT(*) AS jumlah_orderan_selesai FROM transaksi WHERE status = 'Selesai'";
    $result = mysqli_query($conn, $query);

    // Query untuk mengambil jumlah orderan diproses
    $query = "SELECT COUNT(*) AS jumlah_orderan_diproses FROM transaksi WHERE status = 'Proses'";
    $result2 = mysqli_query($conn, $query);

    // Ambil data dari hasil query
    $jumlah_orderan_selesai = mysqli_fetch_assoc($result)['jumlah_orderan_selesai'];
    $jumlah_orderan_diproses = mysqli_fetch_assoc($result2)['jumlah_orderan_diproses'];

    $jumlahHari = cal_days_in_month(CAL_GREGORIAN, date('n'), date('Y'));

    $query = "SELECT DAY(tanggal) as hari, COUNT(*) as jml
    FROM transaksi
    WHERE 
        MONTH(tanggal) = MONTH(NOW()) 
        AND YEAR(tanggal) = YEAR(NOW()) 
    GROUP BY DAY(tanggal)
    ORDER BY DAY(tanggal)";

    $resultHari = $conn->query($query);

    // Inisialisasi array asosiatif untuk menyimpan jumlah transaksi per hari
    $data_per_hari = array_fill(1, $jumlahHari, 0); // Untuk memperhitungkan maksimal 31 hari dalam sebulan

    // Memproses hasil kueri untuk mengisi array dengan jumlah transaksi per hari
    while ($rowHari = $resultHari->fetch_assoc()) {
        $hari = $rowHari['hari'];
        $jumlah = $rowHari['jml'];
        $data_per_hari[$hari] = $jumlah;
    }

    // Mengkonversi array menjadi string untuk digunakan dalam grafik atau tampilan data lainnya
    $nilai = implode(',', $data_per_hari);
    $tanggal = implode(',', range(1, $jumlahHari));

    $query = "SELECT MONTH(tanggal) AS bulan, COUNT(*) AS jml
    FROM transaksi
    WHERE 
        YEAR(tanggal) = YEAR(NOW()) 
    GROUP BY MONTH(tanggal)
    ORDER BY MONTH(tanggal)";

    $result = $conn->query($query);

    // Inisialisasi array asosiatif untuk menyimpan jumlah transaksi per bulan
    $data_per_bulan = array_fill(1, 12, 0);

    // Memproses hasil kueri untuk mengisi array dengan jumlah transaksi per bulan
    while ($row = $result->fetch_assoc()) {
        $bulan = $row['bulan'];
        $jumlah = $row['jml'];
        $data_per_bulan[$bulan] = $jumlah;
    }

    // Mengkonversi array menjadi string untuk digunakan dalam grafik atau tampilan data lainnya
    $nilaiB = implode(',', $data_per_bulan);

?>