<?php

namespace Models;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class MailManager
{
    public function sendMail($email, $subject, $body)
    {


    //MAIL : phpblog@commerce-lille.com
        //MAIL MDP : kC2_YRxK4T

        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        //Create a new SMTP instance
        $smtp = new SMTP;
        $smtp->do_debug = SMTP::DEBUG_CONNECTION;


        //Server settings
    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'mail11.lwspanel.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'phpblog@commerce-lille.com';                     // SMTP username
    $mail->Password   = 'kC2_YRxK4T';                               // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;
        $mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

        //Recipients
        $mail->setFrom('phpblog@commerce-lille.com', 'phpblog');
        $mail->addAddress($email);     // Add a recipient
    
        // Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
    }
}
