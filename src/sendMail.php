<?php

use PHPMailer\PHPMailer\PHPMailer;

require('../lib/PHPMailer/src/SMTP.php');
require('../lib/PHPMailer/src/PHPMailer.php');
require('../lib/PHPMailer/src/OAuth.php');
require('../lib/PHPMailer/src/Exception.php');

require('../src/getCurrentURL.php');
require_once('../lib/PHPMailer/composer/ClassLoader.php');
?>

<?php
function sendTheMail()
{
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';  //MailTrap SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = "a94e87967e8d9c";
        $mail->Password = "1552cb672907bb";
        $mail->Port = 465;                    //SMTP port (465 // 587 // 25)


        $mail->setFrom($_POST['mailTo'], 'Web Dev');
        $mail->addAddress('ToMachin@gmail.com', 'Society');

        $mail->isHTML(true);
        $lien = getCurrentURL();

        //mailTo

        $mail->Subject = $_POST['subject'];
        //echo $_POST['mailTo'];
        //echo $_POST['contentInMail'];
        $mail->Body = utf8_decode($_POST['contentInMail']. $lien ."<br><br>Bon appétit!");

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
}

sendTheMail();

?>