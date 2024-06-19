<?php
// Sertakan file koneksi ke database
include 'koneksi.php';

// Ambil nilai dari formulir
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $no_kk = $_POST['no_kk'];
    $nik_ayah = $_POST['nik_ayah'];
    $nama_ayah = $_POST['nama_ayah'];
    $pendidikan_ayah = $_POST['pendidikan_ayah'];
    $pekerjaan_ayah = $_POST['pekerjaan_ayah'];
    $penghasilan_ayah = $_POST['penghasilan_ayah'];
    $nik_ibu = $_POST['nik_ibu'];
    $nama_ibu = $_POST['nama_ibu'];
    $pendidikan_ibu = $_POST['pendidikan_ibu'];
    $pekerjaan_ibu = $_POST['pekerjaan_ibu'];
    $penghasilan_ibu = $_POST['penghasilan_ibu'];

    // Validasi jika ada field yang kosong (opsional)
     if (empty($no_kk) || empty($nik_ayah) || empty($nama_ayah) || empty($pendidikan_ayah) ||
         empty($pekerjaan_ayah) || empty($penghasilan_ayah) || empty($nik_ibu) ||
         empty($nama_ibu) || empty($pendidikan_ibu) || empty($pekerjaan_ibu) ||
         empty($penghasilan_ibu)) {
         echo '<script>alert("Harap lengkapi semua kolom sebelum melanjutkan."); window.history.back();</script>';
         exit;
     }

    // Query SQL untuk menyimpan data ke database
    $sql = "INSERT INTO data_orang_tua (no_kk, nik_ayah, nama_ayah, pendidikan_ayah, pekerjaan_ayah, penghasilan_ayah, nik_ibu, nama_ibu, pendidikan_ibu, pekerjaan_ibu, penghasilan_ibu) 
            VALUES ('$no_kk', '$nik_ayah', '$nama_ayah', '$pendidikan_ayah', '$pekerjaan_ayah', '$penghasilan_ayah', '$nik_ibu', '$nama_ibu', '$pendidikan_ibu', '$pekerjaan_ibu', '$penghasilan_ibu')";

    if ($conn->query($sql) === TRUE) {
        header("Location: form3.html"); // Redirect to the next form
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Tutup koneksi
$conn->close();
?>
