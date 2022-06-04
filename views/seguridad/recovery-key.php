<?php
require_once __DIR__ . '/../../controllers/recoverPasswordAdapter.php';
require_once __DIR__ . '/../../controllers/clienteAdapter.php';

$tokenCorrecto = FALSE;
if (isset($_GET['token'])) {
  $token = $_GET['token'];
  $correo = RecoverPasswordAdapter::validarToken($token);
  if ($correo != null) {
    $tokenCorrecto = TRUE;
  } else {
    $tokenCorrecto = FALSE;
  }
}
?>
<?php if ($tokenCorrecto) :
?>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
      * {
        margin: 0;
        padding: 0;
      }

      body {
        width: 100vw;
      }

      .container {
        width: 480px;
        margin: 10% auto;
        /* background-color: green; */
        height: 300px;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px solid #000;
        border-radius: 10px;
        background-color: #CB0620;
      }

      form {
        width: 400px;
        margin: auto;
        /* background-color: blue; */
        text-align: center;
      }

      h2 {
        color: #fff;
      }

      label {
        font-size: 1.5em;
        color: #fff;
        text-shadow: 0 0 3px #000, 0 0 5px #000;
      }

      form>div {
        display: flex;
        flex-direction: column;
        margin: 20px;
      }

      input[type="password"] {
        width: 300px;
        margin: 5px auto;
        height: 30px;
        border-radius: 6px;
        outline: none;
        border: 1px solid #000;
      }

      input[type="submit"] {
        width: 350px;
        height: 40px;
        margin: auto;
        background-color: #000;
        color: #fff;
        font-weight: 900;
        border-radius: 10px;
      }
    </style>
  </head>

  <body>
    <div class="container">
      <form action="formCambiarClave.php" method="POST">
        <input type="hidden" name="token" value="<?php echo $token ?>">
        <div>
          <label for="password">Contraseña</label>
          <input type="password" name="password">
        </div>
        <div>
          <label for="re-password">Confirmar contraseña</label>
          <input type="password" name="rePassword">
        </div>
        <div>
          <input type="submit" value="Cambiar la contraseña">
        </div>
      </form>
    </div>
  </body>

  </html>
<?php else : ?>
  <p>
    El token de recuperacion es invalido o expiró.
    Genere un codigo nuevamente
    <br>
    <a href="/views/seguridad/recuperarContrasena.php">Generar nuevo correo de recuperación</a>
  </p>
<?php endif; ?>