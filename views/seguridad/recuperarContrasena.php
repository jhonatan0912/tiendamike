<?php
require_once __DIR__ . '/../../tools/mailTools.php';

if (isset($_POST['correo'])) {
  $correo = $_POST['correo'];
  $body = "";
  MailTools::enviar($correo, "Reestablecimiento de contraseña", $body);
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
  </form>
</div>