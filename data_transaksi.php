<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi - E-Laundry</title>

    <!-- Link Style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css" integrity="sha384-BY+fdrpOd3gfeRvTSMT+VUZmA728cfF9Z2G42xpaRkUGu2i3DyzpTURDo5A6CaLK" crossorigin="anonymous">
    <link rel="stylesheet" href="data_transaksi.css">
    <link rel="icon" href="gambar/favicon.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

    <!-- Container Start -->
    <div class="container">

        <!-- Sidebar Start -->
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
                    <div class="list-menu-active">
                        <img src="gambar/data_transaksi_a.svg" alt="" class="icon">
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
        <!-- Sidebar End -->

        <!-- Header Start -->
        <div class="wrap-header">
            <header>
                <div class="icon-header">
                    <a href="bantuan.php" title="Bantuan"><img src="gambar/bantuan.svg"></a>
                    <a href="mailto:e.laundry.contact@gmail.com" title="Hubungi Kami"><img src="gambar/hubungi_kami.svg"></a>
                    <a href="#" onclick="openKeluarPopup();" title="Keluar"><img src="gambar/keluar.svg"></a>
                </div>
            </header>
        </div>
        <!-- Header End -->

        <!-- Main Content Start -->
        <div class="main-content">
            <?php
                if(isset($_SESSION['notif'])): echo $_SESSION['notif'];
                $_SESSION['notif'] = '';
                endif;
            ?>
            <div class="popbox">
                <button type="button" id="myBtn" class="tambah">
                    <img src="gambar/tambah.svg">
                    <p>Tambah</p> 
                </button>
            <table class="table_dt" cellspacing="0" width="100%">

                <thead>
                    <tr>
                        <th>No Transaksi</th>
                        <th>Berat (Kg)</th>
                        <th>Jenis</th>
                        <th>Harga</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        include"db_conn.php";
                        setlocale(LC_TIME, 'id_ID'); 
                        $sql = "select * from transaksi where status = 'Proses' ORDER BY tanggal DESC, no_pesanan DESC";
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
                            <td class="action">
                                <a onclick="openEditPopup(<?php echo $data['no_pesanan']; ?>);" title="Edit"><button class="edit"><i class="fa-regular fa-pen-to-square"></i></button></a> 
                                <button title="Hapus" class="btnHapus" onclick="openHapusPopup(<?php echo $data['no_pesanan']; ?>, '<?php echo $data['no_pesanan']; ?>');"><i class="fa-regular fa-trash-can"></i></button>
                                <button title="Selesai" class="btnSelesai" onclick="openSelesaiPopup(<?php echo $data['no_pesanan']; ?>, '<?php echo $data['no_pesanan']; ?>');"><i class="fa-regular fa-square-check"></i></button>
                            </td>
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
        <!-- Main Content End -->
    </div>
    <!-- Container End -->

    <!-- Popup Tambah Start -->
    <?php include "prosesTambah.php";?>
    <div id="myModal" class="modal">
        <div class="modal-content">
        <p>Formulir Tambah Transaksi</p>
            <form class="ftambah" action="prosesSimpan.php" method="POST">
                <div class="form-box">
                    <label id="notrans">Nomor Transaksi</label><br>
                    <input type="text" name="no_pesanan" value="<?php echo $nomor_transaksi; ?>" readonly><br>
                </div>
                <div class="form-box">
                    <label id="berat">Berat (KG)</label><br>
                    <input type="number" name="berat" placeholder="Berat (KG)" autocomplete="off"><br>
                </div>
                <div class="form-box">
                    <label id="jenis">Jenis Pesanan</label><br>
                    <select name="jenis_pesanan" required>
                        <option value="" disabled selected hidden>-- Jenis Pesanan --</option>
                        <option value="Express">Express</option>
                        <option value="Regular">Regular</option>
                    </select><br>                    
                </div>
                <div class="form-box">
                    <label id="harga">Harga (Rp) </label><br>
                    <input type="text" name="harga" placeholder="Harga (Rp)" autocomplete="off" onkeyup="formatRupiah(this)"><br>                    
                </div>
                <div class="form-box">
                    <label id="tanggal">Tanggal Pesanan</label><br>
                    <input type="text" name="tanggal" placeholder="dd/mm/yyyy" onfocus="(this.type='date')">                    
                </div>
                <button type="submit" class="simpan" name="tblsubmit"><i class="fa-regular fa-floppy-disk"></i>  Tambah</button>
                <button type="button" class="close"><i class="fa-solid fa-xmark"></i>  Batal</button> 
            </form>
        </div>
    </div>
    <!-- Popup Tambah Start -->

    <!-- Popup Edit Start -->
    <div id="myModalEdit" class="modal">
        <div class="modal-content">
        <p>Formulir Edit Transaksi</p>
            <form class="fedit" action="prosesEdit.php" method="POST">
                <div class="form-box">
                    <label id="notrans">Nomor Transaksi</label><br>
                    <input type="text" name="no_pesanan" readonly><br>
                </div>
                <div class="form-box">
                    <label id="berat">Berat (KG)</label><br>
                    <input type="number" name="berat" placeholder="Berat (KG)" autocomplete="off"><br>
                </div>
                <div class="form-box">
                    <label id="jenis">Jenis Pesanan</label><br>
                    <select name="jenis_pesanan" required>
                        <option value="" disabled selected hidden>-- Jenis Pesanan --</option>
                        <option value="Express">Express</option>
                        <option value="Regular">Regular</option>
                    </select><br>                    
                </div>
                <div class="form-box">
                    <label id="harga">Harga (Rp) </label><br>
                    <input type="text" name="harga" placeholder="Harga (Rp)" onkeyup="formatRupiah(this)" autocomplete="off"><br>                    
                </div>
                <div class="form-box">
                    <label id="tanggal">Tanggal Pesanan</label><br>
                    <input type="text" name="tanggal" placeholder="dd/mm/yyyy" onfocus="(this.type='date')">                    
                </div>
                <button type="submit" class="simpan" name="tblsubmit"><i class="fa-regular fa-floppy-disk"></i>  Simpan</button>
                <button type="button" class="close"><i class="fa-solid fa-xmark"></i>  Batal</button> 
            </form>
        </div>
    </div>
    <!-- Popup Edit End -->

    <!-- Popup Keluar Start -->
    <div class="modal" id="modalKeluar">
        <div class="keluarku">
            <p>Anda yakin ingin keluar?</p>
            <a href="keluar.php"><button class="simpan">Ya</button></a>
            <button class="close" id="tidakKeluar">Tidak</button>
        </div>
    </div>
    <!-- Popup Keluar End -->

    <!-- Popup Hapus Start -->
    <div class="modal" id="modalHapus">
        <div class="keluarku" style="padding-top: 25px">
            <p id="pesanHapus" style="font-size: 20px;">Anda yakin ingin menghapus data?</p>
            <a id="hapusLink" href="#"><button class="simpan">Ya</button></a>
            <button class="close" id="tidakHapus">Tidak</button>
        </div>
    </div>
    <!-- Popup Hapus End -->
    
    <!-- Popup Selesai Start -->
    <div class="modal" id="modalSelesai">
        <div class="keluarku" style="padding-top: 25px">
            <p id="pesanSelesai" style="font-size: 22px;">Apakah transaksi sudah selesai?</p>
            <a id="selesaiLink" href="#"><button class="simpan">Ya</button></a>
            <button class="close" id="tidakSelesai">Tidak</button>
        </div>
    </div>
    <!-- Popup Hapus End -->

<!-- Javascript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
//Konfirmasi Keluar
var keluar = document.getElementById("modalKeluar");
var tidak = document.getElementById("tidakKeluar");
function openKeluarPopup() {
    keluar.style.display = "flex";
}
tidak.onclick = function() {
    keluar.style.display = "none";
}


//Popup Tambah
var modal = document.getElementById("myModal");
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];
btn.onclick = function() {          //Tampil Popup
  modal.style.display = "flex";
}
span.onclick = function() {         //Tutup Popup Tambah dan Reset
    var form = document.querySelector('.ftambah');
    form.reset(); // Reset form sebelum menampilkan
  modal.style.display = "none";
}

//Popup Edit
var modal2 = document.getElementById("myModalEdit");
var span2 = document.getElementsByClassName("close")[1];
span2.onclick = function() {
  modal2.style.display = "none";
}

//Konfirmasi Hapus
var btnHapus = document.getElementsByClassName("btnHapus")[0];
var modalHapus = document.getElementById("modalHapus");
var tidakHapus = document.getElementById("tidakHapus");
function openHapusPopup(id, no_pesanan) {
    var hapusLink = document.getElementById('hapusLink');
    hapusLink.href = 'prosesHapus.php?id=' + id;

    var pesanHapus = document.getElementById('pesanHapus');
    pesanHapus.innerHTML = "Apakah Anda yakin akan menghapus data <b>" + no_pesanan + "</b>?";

    modalHapus.style.display = "flex";
}
tidakHapus.onclick = function() {
    modalHapus.style.display = "none";
}

//Konfirmasi Selesai
var btnSelesai = document.getElementsByClassName("btnSelesai")[0];
var modalSelesai = document.getElementById("modalSelesai");
var tidakSelesai = document.getElementById("tidakSelesai");
function openSelesaiPopup(id, no_pesanan) {
    var selesaiLink = document.getElementById('selesaiLink');
    selesaiLink.href = 'prosesSelesai.php?id=' + id;

    var pesanSelesai = document.getElementById('pesanSelesai');
    pesanSelesai.innerHTML = "Apakah transaksi <b>" + no_pesanan + "</b><br>sudah selesai?";

    modalSelesai.style.display = "flex";
}
tidakSelesai.onclick = function() {
    modalSelesai.style.display = "none";
}



//Menutup Notifikasi
var clsnotif = document.getElementsByClassName("clsnotif")[0];
clsnotif.onclick = function() {
  notif.style.display = "none";
}

//Popup Edit
function openEditPopup(no_pesanan) {
    var modal = document.getElementById("myModalEdit");
    modal.style.display = "flex";

    var form = document.querySelector('.fedit');
    form.reset(); // Reset form sebelum menampilkan

    // Fetch data transaksi yang dipilih untuk diedit
    fetch('prosesAmbilData.php?id=' + no_pesanan)
        .then(response => {
            if (!response.ok) {
                throw new Error('Gagal mengambil data dari server');
            }
            return response.json();
        })
        .then(data => {
            // Mengisi nilai form dengan data yang diterima
            document.querySelector('.fedit input[name="no_pesanan"]').value = data.no_pesanan;
            document.querySelector('.fedit input[name="berat"]').value = data.berat;
            document.querySelector('.fedit select[name="jenis_pesanan"]').value = data.jenis_pesanan;
            var formattedHarga = new Intl.NumberFormat('id-ID').format(data.harga);
            document.querySelector('.fedit input[name="harga"]').value = formattedHarga;
            document.querySelector('.fedit input[name="tanggal"]').value = data.tanggal;
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

//Merubah format harga
function formatRupiah(input) {
    // Mengambil nilai tanpa karakter non-digit
    let nominal = input.value.replace(/\D/g, '');

    // Memastikan nilai yang dimasukkan bukan karakter kosong atau non-digit
    if (nominal !== "") {
        // Menambahkan pemisah ribuan
        nominal = parseInt(nominal, 10).toLocaleString('in-id');

        // Menetapkan nilai yang sudah diformat kembali ke input
        input.value = nominal;
    }
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