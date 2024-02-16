<?php
<<<<<<< HEAD
$host = "localhost"; // Ganti sesuai dengan host database Anda
$user = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$database = "surat_tugas"; // Ganti dengan nama database Anda

$koneksi = mysqli_connect($host, $user, $password, $database);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
=======
$host = "localhost"; // Ganti dengan nama host atau alamat IP server database Anda
$username = "root"; // Ganti dengan nama pengguna database Anda
$password = ""; // Ganti dengan kata sandi database Anda
$database = "login_register_db"; // Ganti dengan nama database yang Anda buat

// Buat koneksi
$conn = new mysqli($host, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
}

// Set timezone (opsional)
date_default_timezone_set('Asia/Jakarta');
>>>>>>> ea5e0cabedd1594caf637df5f4fd7094bc89f2c0
?>
