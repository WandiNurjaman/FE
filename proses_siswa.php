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
    $jurusan = $_POST['jurusan'];
    $email = $_POST['email']; // Ambil nilai email dari formulir

    // Periksa apakah semua kolom telah diisi
    if (empty($nisn) || empty($nik) || empty($nama) || empty($tempat_lahir) || empty($tanggal_lahir) ||
        empty($jenis_kelamin) || empty($anak_ke) || empty($jumlah_saudara) || empty($status_anak) ||
        empty($alamat) || empty($rt) || empty($rw) || empty($desa) || empty($kecamatan) ||
        empty($kab_kota) || empty($provinsi) || empty($jurusan) || empty($email)) { // Tambahkan pemeriksaan email
        echo '<script>alert("Harap lengkapi semua kolom sebelum melanjutkan."); window.history.back();</script>';
    } else {
        // Perintah SQL untuk memasukkan data ke dalam tabel data_siswa
        $sql = "INSERT INTO data_siswa (nisn, nik, nama, tempat_lahir, tanggal_lahir, jenis_kelamin, anak_ke, jumlah_saudara, status_anak, alamat, rt, rw, desa, kecamatan, kab_kota, provinsi, jurusan, email) 
                VALUES ('$nisn', '$nik', '$nama', '$tempat_lahir', '$tanggal_lahir', '$jenis_kelamin', '$anak_ke', '$jumlah_saudara', '$status_anak', '$alamat', '$rt', '$rw', '$desa', '$kecamatan', '$kab_kota', '$provinsi', '$jurusan', '$email')";

        // Eksekusi perintah SQL dan periksa apakah berhasil
        if ($conn->query($sql) === TRUE) {
            header("Location: form2.html"); // Redirect ke halaman selanjutnya setelah berhasil disimpan
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>