<?php
// Parameter koneksi ke database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'db_profile';

// Buat koneksi
$conn = new mysqli($host, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
