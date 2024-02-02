<?php
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
?>
