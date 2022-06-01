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
<?php if ($tokenCorrecto) : ?>
  <div>
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
<?php else : ?>
  <p>
    El token de recuperacion es invalido o expiró.
    Genere un codigo nuevamente
    <br>
    <a href="/views/seguridad/recuperarContrasena.php">Generar nuevo correo de recuperación</a>
  </p>
<?php endif; ?>