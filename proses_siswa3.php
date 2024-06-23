<?php
include 'koneksi.php';

$nama_sekolah = $_POST['nama_sekolah'];
$npsn_sekolah = $_POST['npsn_sekolah'];
$status_sekolah = $_POST['status_sekolah'];
$jenis_sekolah = $_POST['jenis_sekolah'];
$upload_foto = $_FILES['upload_foto']['name']; // Nama file upload
$scan_kk = $_FILES['scan_kk']['name']; // Nama file upload


if (empty($nama_sekolah) || empty($npsn_sekolah) || empty($status_sekolah) || empty($jenis_sekolah) || empty($upload_foto) || empty($scan_kk)) {
    echo '<script>alert("Harap lengkapi semua kolom sebelum melanjutkan."); window.history.back();</script>';
    exit;
}

$target_dir = "C:/xampp/htdocs/FE/uploads/";
$target_file_foto = $target_dir . basename($_FILES["upload_foto"]["name"]);
$target_file_kk = $target_dir . basename($_FILES["scan_kk"]["name"]);

move_uploaded_file($_FILES["upload_foto"]["tmp_name"], $target_file_foto);
move_uploaded_file($_FILES["scan_kk"]["tmp_name"], $target_file_kk);

$sql = "INSERT INTO data_sekolah_asal1 (nama_sekolah, npsn_sekolah, status_sekolah, jenis_sekolah, upload_foto, scan_kk)
        VALUES ('$nama_sekolah', '$npsn_sekolah', '$status_sekolah', '$jenis_sekolah', '$upload_foto', '$scan_kk')";

if ($conn->query($sql) === TRUE) {
    echo '<div style="text-align: center; margin-top: 20px;">';
    echo "<p>Data Siswa Berhasil Disimpan Cek E-mail Untuk Pemberitahuan Selanjutnya.</p>";
    
    
    echo '<button onclick="window.location.href=\'index.html\'">Kembali ke Halaman Utama</button>';
    echo '</div>';
} else {
    if (strpos($conn->error, "Table 'db_profile.data_sekolah_asal1' doesn't exist") !== false) {
        echo "Error: Tabel 'data_sekolah_asal1' tidak ditemukan. Pastikan tabel sudah dibuat.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();

