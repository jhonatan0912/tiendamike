<?php
//?Import PHPMailer classes into the global namespace
//?These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//?Load Composer's autoloader
require 'vendor/autoload.php';

//! /////////////////////////////////////////////////////////////////////////////
//? Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
  //?Server settings
  $mail->SMTPDebug = SMTP::DEBUG_SERVER;                                //?Enable verbose debug output
  $mail->isSMTP();                                                      //?Send using SMTP
  $mail->Host       = 'smtp.gmail.com';                                 //?Set the SMTP server to send through
  $mail->SMTPAuth   = true;                                             //?Enable SMTP authentication
  $mail->Username   = 'i2125575@continental.edu.pe';                    //?SMTP username //MAIL EMISOR
  $mail->Password   = 'elhvqyjivasecrwp';                               //?SMTP password
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;                      //?Enable implicit TLS encryption
  $mail->Port       = 465;                                              //?TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

  //?Recipients
  // $mail->setFrom('exampleexample', 'Mailer');
  $mail->addAddress('jhoonatan_0912@hotmail.com', 'jhonatan');            //?Add a recipient //MAIL RECEPTOR
  // $mail->addAddress('ellen@example.com');                            //?Name is optional
  // $mail->addReplyTo('info@example.com', 'Information');
  // $mail->addCC('cc@example.com');
  // $mail->addBCC('bcc@example.com');
  //! /////////////////////////////////////////////////////////////////////////////


  //! /////////////////////////////////////////////////////////////////////////////
  //? Attachments //ARCHIVOS ADJUNTOS
  // $mail->addAttachment('/var/tmp/file.tar.gz');                         //?Add attachments
  // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');                    //?Optional name
  //! /////////////////////////////////////////////////////////////////////////////


  //! /////////////////////////////////////////////////////////////////////////////
  //?Content
  $mail->isHTML(true);                                                  //?Set email format to HTML
  $mail->Subject = 'test 6';
  $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
  // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
  echo "<br>";
  $mail->send();
  echo '<br>Se envio el mail correctamente';
} catch (Exception $e) {
  echo "<br> No se pudo enviar el mail: {$mail->ErrorInfo}";
}
//! /////////////////////////////////////////////////////////////////////////////
