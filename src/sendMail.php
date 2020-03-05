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


        $mail->setFrom("lesrecettesdudev@lacuisine.fr", 'Web Dev');
        $mail->addAddress($_POST['mailTo'], 'Society');

        $mail->isHTML(true);
        $lien = getCurrentURL();

        //mailTo

        $mail->Subject = $_POST['subject'];
        //echo $_POST['mailTo'];
        //echo $_POST['contentInMail'];
        $mail->Body = utf8_decode($_POST['contentInMail']. $lien ."<br><br>Bon appétit!");

        if (!$mail->send()) {
            echo 'Un problème est survenu.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Le message a bien été envoyé';
        }
    } catch (Exception $e) {
        echo 'Un problème est survenu.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
}

sendTheMail();

?>