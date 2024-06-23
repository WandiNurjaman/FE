<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';


$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'your-email@gmail.com';
$mail->Password = 'your-password';
$mail->SMTPSecure = 'tls'; 
$mail->Port = 587; 

    $mail->setFrom('dikkiero@gmail.com', 'dikki');
    $mail->addAddress('rizaldikki@gmail.com', 'dik');

    $mail->isHTML(true);  
    $mail->Subject = 'Test Email';
    $mail->Body    = 'This is a test email from PHPMailer';

    
    $mail->send();
    echo 'Email has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
