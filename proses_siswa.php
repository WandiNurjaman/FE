<?php
// Sertakan file koneksi ke database
include 'koneksi.php';

// Ambil nilai dari formulir
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nisn = $_POST['nisn'];
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $anak_ke = $_POST['anak_ke'];
    $jumlah_saudara = $_POST['jumlah_saudara'];
    $status_anak = $_POST['status_anak'];
    $alamat = $_POST['alamat'];
    $rt = $_POST['rt'];
    $rw = $_POST['rw'];
    $desa = $_POST['desa'];
    $kecamatan = $_POST['kecamatan'];
    $kab_kota = $_POST['kab_kota'];
    $provinsi = $_POST['provinsi'];

    // Query SQL untuk menyimpan data ke database
    $sql = "INSERT INTO data_siswa (nisn, nik, nama, tempat_lahir, tanggal_lahir, jenis_kelamin, anak_ke, jumlah_saudara, status_anak, alamat, rt, rw, desa, kecamatan, kab_kota, provinsi) 
            VALUES ('$nisn', '$nik', '$nama', '$tempat_lahir', '$tanggal_lahir', '$jenis_kelamin', '$anak_ke', '$jumlah_saudara', '$status_anak', '$alamat', '$rt', '$rw', '$desa', '$kecamatan', '$kab_kota', '$provinsi')";

    if ($conn->query($sql) === TRUE) {
        
        header("Location: form2.html");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Tutup koneksi
$conn->close();
?>
