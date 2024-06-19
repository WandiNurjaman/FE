<?php
// Sertakan file koneksi ke database
include 'koneksi.php';

// Fungsi untuk memeriksa apakah ada kolom yang kosong (kecuali no_kip dan no_kis)
function checkEmptyFields($fields) {
    $exclude_fields = array('no_kip', 'no_kis');
    foreach ($fields as $key => $value) {
        if (!in_array($key, $exclude_fields) && empty($value)) {
            return true;
        }
    }
    return false;
}

// Ambil data dari form
$nama_sekolah = $_POST['nama_sekolah'];
$npsn_sekolah = $_POST['npsn_sekolah'];
$status_sekolah = $_POST['status_sekolah'];
$jenis_sekolah = $_POST['jenis_sekolah'];
$pilihan_jurusan = $_POST['pilihan_jurusan'];
$ukuran_pakaian = $_POST['ukuran_pakaian'];
$upload_foto = $_FILES['upload_foto']['name']; // Nama file upload
$scan_kk = $_FILES['scan_kk']['name']; // Nama file upload

// Validasi jika ada kolom yang kosong (kecuali no_kip dan no_kis)
$fields = [
    'nama_sekolah' => $nama_sekolah,
    'npsn_sekolah' => $npsn_sekolah,
    'status_sekolah' => $status_sekolah,
    'jenis_sekolah' => $jenis_sekolah,
    'pilihan_jurusan' => $pilihan_jurusan,
    'ukuran_pakaian' => $ukuran_pakaian,
    'upload_foto' => $upload_foto,
    'scan_kk' => $scan_kk
];

if (checkEmptyFields($fields)) {
    echo '<script>alert("Harap lengkapi semua kolom (kecuali No KIP dan No KIS) sebelum melanjutkan."); window.history.back();</script>';
    exit;
}

// Lokasi penyimpanan file upload
$target_dir = "C:/xampp/htdocs/FE/FE/uploads/";
$target_file_foto = $target_dir . basename($_FILES["upload_foto"]["name"]);
$target_file_kk = $target_dir . basename($_FILES["scan_kk"]["name"]);

// Pindahkan file yang di-upload ke folder uploads (direkomendasikan untuk disertakan pengecekan validasi file)
move_uploaded_file($_FILES["upload_foto"]["tmp_name"], $target_file_foto);
move_uploaded_file($_FILES["scan_kk"]["tmp_name"], $target_file_kk);

// Query untuk menyimpan data ke database
$sql = "INSERT INTO siswa (nama_sekolah, npsn_sekolah, status_sekolah, jenis_sekolah, pilihan_jurusan, ukuran_pakaian, upload_foto, scan_kk)
        VALUES ('$nama_sekolah', '$npsn_sekolah', '$status_sekolah', '$jenis_sekolah', '$pilihan_jurusan', '$ukuran_pakaian', '$upload_foto', '$scan_kk')";

if ($conn->query($sql) === TRUE) {
    echo "Data siswa berhasil disimpan.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Tutup koneksi
$conn->close();
?>
