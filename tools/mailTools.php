<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../vendor/autoload.php';
class MailTools
{
  static function createMailer()
  {

    $mail = new PHPMailer();

    $mail->isSMTP();
    $mail->CharSet = "UTF-8";
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'i2125575@continental.edu.pe';
    $mail->Password = 'elhvqyjivasecrwp';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    return $mail;
  }

  static function enviar($para, $asunto, $cuerpo)
  {
    $mail = MailTools::createMailer();
    $mail->CharSet = "UTF-8";
    $mail->addAddress($para);     //? $para -> receptor de mail
    $mail->isHTML(true);
    $mail->Subject = $asunto;     //? $asunto -> asunto del mail
    $mail->Body    = $cuerpo;     //?$cuerpo -> cuerpo del mail
    if (!$mail->send()) {
      return true;
    } else {
      return false;
    }
  }
}
