<?php
require_once __DIR__ . '/../../controllers/recoverPasswordAdapter.php';
require_once __DIR__ . '/../../controllers/clienteAdapter.php';


$esCorrecto = FALSE;
if (
  isset($_POST['token'])
  && isset($_POST['password'])
  && isset($_POST['rePassword'])
) {
  $token = $_POST['token'];
  $password = $_POST['password'];
  $rePassword = $_POST['rePassword'];

  $correo = RecoverPasswordAdapter::validarToken($token);

  if ($correo != null && $password == $rePassword) {
    RecoverPasswordAdapter::usarToken($token);
    $res = ClienteAdapter::cambiarClave($correo, $password);
    if ($res) {
      $esCorrecto = TRUE;
    }
  }
}
?>
<div>
  <?php if ($esCorrecto) : ?>
    <p>
      Tu clave se cambio correctamente,
      vuelve a ingresar con tu nueva clave
      <br>
      <a href="/views/seguridad/p-login-clientes.php">ingresar</a>
    </p>
  <?php else : ?>
    <p>
      Algo salio mal intentalo de nuevo
    </p>
  <?php endif; ?>
</div>