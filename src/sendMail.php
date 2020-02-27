<?php

use PHPMailer\PHPMailer\PHPMailer;

require('lib/PHPMailer/src/SMTP.php');
require('lib/PHPMailer/src/PHPMailer.php');
require('lib/PHPMailer/src/OAuth.php');
require('lib/PHPMailer/src/Exception.php');

require_once('lib/PHPMailer/composer/ClassLoader.php');



$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.mailtrap.io';  //MailTrap SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = "2af026b2ac86b4";
    $mail->Password = "21e246fe9ff2f0";
    $mail->Port = 465;                    //SMTP port

    $mail->setFrom('fromTruc@gmail.com', 'Web Dev');
    $mail->addAddress('ToMachin@gmail.com', 'Society');

    $mail->isHTML(true);

    $mail->Subject = 'Email incoming FROM MailTrap ';
    $mail->Body    = 'Hello User, <p>test mail sent through Mailtrap SMTP</p><br>Thank you';

    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}

?>