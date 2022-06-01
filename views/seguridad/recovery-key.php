<?php
require_once __DIR__ . '/../../controllers/recoverPasswordAdapter.php';
require_once __DIR__ . '/../../controllers/clienteAdapter.php';

$tokenCorrecto = FALSE;
if (
  isset($_POST['token'])
  && isset($_POST['password'])
  && isset($_POST['re-password'])

) {
  $recoveryToken = $_GET['token'];
  $password = $_POST['password'];
  $rePassword = $_POST['re-password'];
  $correo = RecoverPasswordAdapter::validarToken($recoveryToken);
  if ($correo != null && $password == $rePassword) {
    $tokenCorrecto = TRUE;
    ClienteAdapter::cambiarClave($correo, $password);
  }
}
?>
<?php if ($tokenCorrecto) : ?>
  <div>
    <form action="" method="POST">
      <input type="hidden" name="token" value="<?php echo $recoveryToken ?>">
      <div>
        <label for="password">Contraseña</label>
        <input type="password" name="password">
      </div>
      <div>
        <label for="re-password">Confirmar contraseña</label>
        <input type="password" name="re-password">
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