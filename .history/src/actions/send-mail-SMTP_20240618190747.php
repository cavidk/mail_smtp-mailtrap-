<?php

$subject = "Here is a new test Client Registration";

$name = $_POST['name'];
$surname = $_POST['surname'];
$patronymic = $_POST['patronymic'];
$gender = $_POST['gender'];
$bloodGroup = $_POST['bloodGroup'];
$phone = $_POST['phone'];
$nationality = $_POST['nationality'];
$dob = $_POST['dob'];
$expiryDate = $_POST['expiryDate'];
$personalNo = $_POST['personalNo'];
$cardNo = $_POST['cardNo'];
$address = $_POST['address'];


$message = <<<EMAIL
Here is all registration details:
Name : $name
Surname : $surname
Patronymic : $patronymic
Gender : $gender
Blood Group : $bloodGroup
Phone : $phone
Nationality : $nationality
Date of Birth : $dob
EMAIL;

$passportFace = $_FILES['passportFace']['name'];
$passportBack = $_FILES['passportBack']['name'];
$passportFaceName = 'front_'. time() . '.jpg';
$passportBackName = 'back_'. time() . '.jpg';
move_uploaded_file($_FILES['passportFace']['tmp_name'], "uploads/" . $passportFaceName);
move_uploaded_file($_FILES['passportFace']['tmp_name'], "uploads/" . $passportBackName); 
    
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;


$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->SMTPAuth = true;


$mail->Host = 'smtp.gmail.co';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;



$mail->Username = "mailer@gmail.com";
$mail->Password = '*****';

 
$mail->setFrom($mail->Username, 'Test Mailer');
$mail->addAddress('testmailer@gmail.com', 'Mailer Test');
$mail->addAddress('testmailer@gmail.com', 'Mailer Test');

    //Attachments
    $mail->addAttachment("/path to file");         //Add attachments
    $mail->addAttachment('/path to file');    //Optional name

$mail->Subject = $subject;
$mail->Body = $message;


if ($mail->send()) {
    echo "Registration successful, email sent.";
} else {
    echo "Failed to send email.";
}