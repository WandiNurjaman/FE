<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Untuk Composer
// require 'path/to/PHPMailerAutoload.php'; // Untuk manual

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nisn = $_POST['nisn'];
    $message = $_POST['message'];

    // Ambil data email berdasarkan NISN
    $sql = "SELECT email FROM data_siswa WHERE nisn = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nisn);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $email = $row['email'];

    // Konfigurasi PHPMailer
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 2; // Atau 3 untuk lebih banyak detail
        $mail->Debugoutput = 'html';

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'kiriseki202@gmail.com';
        $mail->Password = 'okis jydn osvr jvng'; // Kata sandi aplikasi Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        //Recipients
        $mail->setFrom('kiriseki202@gmail.com', 'SMK Darul Hidayat');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Pesan dari SMK Darul Hidayat';
        $mail->Body    = nl2br($message);

        $mail->send();
         // Set pesan sukses dalam sesi
         $_SESSION['success_message'] = 'Pesan telah terkirim';

         // Redirect kembali ke dataemail.php setelah pengiriman berhasil
         header('Location: dataemail.php');
         exit;
     } catch (Exception $e) {
         echo "Pesan tidak dapat dikirim. Mailer Error: {$mail->ErrorInfo}";
     }
}
?>
