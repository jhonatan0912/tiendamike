<?php
require_once __DIR__ . '/../../tools/mailTools.php';
require_once __DIR__ . '/../../controllers/clienteAdapter.php';
require_once __DIR__ . '/../../controllers/recoverPasswordAdapter.php';

$error = "";
if (isset($_POST['correo'])) {
  $correo = $_POST['correo'];
  $cliente = ClienteAdapter::perfilClientePorCorreo($correo);
  if ($cliente != null) {
    //?create recovery key
    $recoveryToken = uniqid('', true);
    //create current datime + 5
    $minutosExtra = 5;
    $tiempo = new DateTime();
    $tiempo->add(new DateInterval('PT' . $minutosExtra . 'M'));
    $fechaVencimiento = $tiempo->format('Y-m-d H:i:s');
    $recoverPassword = new RecoverPassword(0, $cliente->idCliente, $recoveryToken, 0, $fechaVencimiento);
    $id = RecoverPasswordAdapter::insertar($recoverPassword);
    if ($id != null) {
      $body = '
<html lang="ES-PE">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    *{
      margin:0;
      padding: 0;
    }
    body{
      text-align: center;
    }
    p{
      margin: 40px 0;
    }
    .container{
    border: 1px solid;
    width: 600px;
    min-height: 800px;
    margin:2em auto;  
    border-radius: 15px;
    background-color: rgb(255, 255, 255);
    }
    .container__logo{
    margin: 20px 0;
    }
    .container__body-mail{
      font-size: 1.3em;
    }
    .subject{
      font-weight: 900;
    }
    .secondary__hyperlink{
      background-color: rgb(219, 226, 231);
      border: 1px solid rgb(221, 219, 219);
    }
  </style>
</head>
<body>
<div class="container">
  <div class="container__logo">
    <img src="https://lh3.googleusercontent.com/2GxKiMQc2mnPmm-4K7FKigT7fbDnIr15oTPaM1I1jqPfNu9fS1tfYIFLp21i_MD1PZFN=s85">
  </div>
  <hr>
  <div class="container__body-mail">
  <p class="subject">
    Correo de reestablecimiento de contraseña
  </p>
  <p>
    Recibimos una solicitud para restablecer tu contraseña de la página "Palacio Chino Premium" <br>
    Si no hiciste dicha solicitud, ignora este correo.
  </p>
  <p>
    Para reestablecer su contraseña, haga click en el siguiente enlace.
  </p>
  <small>
    <a href="http://localhost:8000/views/seguridad/recovery-key.php?token=' . $recoveryToken . '">
     Recuperar contraseña
    </a>
  </small>
  <p>
    Si no funciona el link, copie este enlace y pegelo en el navegador.
  </p>
      <small class="secondary__hyperlink">
        http://localhost:8000/views/seguridad/recovery-key.php?token=' . $recoveryToken . '
    </small>
</div>
</div>
</body>
</html>
';
      MailTools::enviar($correo, "Reestablecimiento de contraseña", $body);
    }
  } else {
    $error = "El correo $correo no existe en esta aplicación";
  }
}
?>



<div>
  <form action="" method="POST">
    <div>
      <label for="correo">Ingresa tu Correo</label>
      <input type="email" name="correo" required>
    </div>
    <div>
      <input type="submit" value="Recibir correo para restablecer contraseña">
    </div>
    <div class="error">
      <?php echo $error; ?>
    </div>
  </form>
</div>