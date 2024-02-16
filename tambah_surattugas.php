<?php
session_start();
include 'koneksi.php';

// Periksa apakah session username telah diatur
if (!isset($_SESSION['pengguna_type'])) {
    ?>
    <script>
        alert("Anda Tidak Berhak Masuk Kehalaman Ini!");
        window.location.href = "index.php";
    </script>
    <?php
    exit;
}
    
// Tombol submit pada form tambah data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Periksa dan tambahkan data ke database
    if (isset($_POST['nama']) && isset($_POST['departemen']) && isset($_POST['hari']) && isset($_POST['tanggal']) && isset($_POST['lokasi']) && isset($_POST['keterangan']) && isset($_POST['jam_berangkat']) && isset($_POST['jam_pulang']) && isset($_POST['menugaskan'])) {
        $nama = $_POST['nama'];
        $departemen = $_POST['departemen'];
        $hari = $_POST['hari'];
        $tanggal = $_POST['tanggal'];
        $lokasi = $_POST['lokasi'];
        $keterangan = $_POST['keterangan'];
        $jam_berangkat = $_POST['jam_berangkat'];
        $jam_pulang = $_POST['jam_pulang'];
        $menugaskan = $_POST['menugaskan'];

        // Check if the data already exists
        $checkQuery = "SELECT * FROM surat_tugas WHERE nama='$nama'";
        $result = mysqli_query($koneksi, $checkQuery);

        if (mysqli_num_rows($result) > 0) {
            // Data already exists, show an alert or handle it as needed
            echo '<script language="javascript" type="text/javascript">
                alert("Data dengan nama tersebut sudah ada!");
            </script>';
             echo "<meta http-equiv='refresh' content='0; url=surattugas.php'>";
        } else {
            // Lakukan penambahan data ke database, sesuaikan dengan struktur tabel
            $queryTambah = "INSERT INTO surat_tugas (nama, departemen, hari, tanggal, lokasi, keterangan, jam_berangkat, jam_pulang, menugaskan) VALUES ('$nama', '$departemen', '$hari', '$tanggal', '$lokasi', '$keterangan', '$jam_berangkat', '$jam_pulang', '$menugaskan')";
           

            // Eksekusi query tambah data
            if ($koneksi->query($queryTambah) === TRUE) {
                echo '<script language="javascript" type="text/javascript">
                    alert("Tambah data berhasil!");
                </script>';
                echo "<meta http-equiv='refresh' content='0; url=surattugas.php'>";
            } else {
                echo "Error adding record: " . $koneksi->error;
            }
        }
    }
}
?>