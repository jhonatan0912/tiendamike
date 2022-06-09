<?php

require_once __DIR__ . '/../../controllers/clienteAdapter.php';
require_once __DIR__ . '/../../tools/httpTools.php';
require_once __DIR__ . '/../../tools/oauthTools.php';

$correo;
$nombres;
$errores = [];
HttpTools::iniciarSesion();

if (
  isset($_POST['nombres']) &&
  isset($_POST['email']) &&
  isset($_POST['token']) &&
  isset($_POST['proveedor'])
) {
  $correo = $_POST['email'];
  $nombres = $_POST['nombres'];
  $token = $_POST['token'];
  $proveedor = $_POST['proveedor'];

  $response = OauthTools::validarToken($token, $proveedor);

  $codigoEstado = $response->getStatusCode();
  if ($codigoEstado == 200) {
    $datos = json_decode($response->getBody());
    $perfil = ClienteAdapter::perfilClientePorCorreo($correo);
    if ($perfil == null) {
      // echo "CREAR USUARIO";
    } else {
      $_SESSION['perfil'] = $perfil;
      if (isset($_GET['redireccionar'])) {
        HttpTools::redireccionar($_GET['redireccionar']);
      } else {
        HttpTools::redireccionar("/views/shopping/checkout.php");
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="ES">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>REGISTRO CLIENTES</title>
  <link rel="stylesheet" href="../../assets/css/style--registro--clientes.css">
  <link rel="icon" href="../imagenes/logoTienda.png">
</head>

<body>
  <p style="color:#000;">
    Intentando logearse con la cuenta "<?php echo $correo; ?>", para continuar es necesario que verifique sus datos
  </p>
  <center>
    <h1>REGISTRARSE</h1>
  </center>
  <div class="container--mid">
    <div>
      <img src="/assets/imagenes/imagen--registro.png">
    </div>
    <form action="p-registro-clientes.php" method="POST">
      <table class="tabla">
        <tr>
          <td>NOMBRES:</td>
        </tr>
        <tr>
          <td>
            <input type="text" name="nombres" required value="<?php echo $nombres; ?>">
          </td>
        </tr>

        <tr>
          <td>APELLIDOS:</td>
        </tr>
        <tr>
          <td>
            <input type="text" name="apellidos" required>
          </td>
        </tr>
        <tr>
          <td>CORREO ELECTRÓNICO:</td>
        </tr>
        <tr>
          <td>
            <input type="email" name="correo" readonly value="<?php echo $correo; ?>">
          </td>
        </tr>
        <tr>
          <td>CONTRASEÑA</td>
        </tr>
        <tr>
          <td>
            <input type="password" name="password" required pattern="[A-Z a-z 0-9]{A-Z }">
          </td>
        </tr>
        <!--BOTON SUBMIT-->
        <tr>
          <td>
            <input type="submit" name="registrarCliente" value="PROCESAR">
          </td>
        </tr>
        <tr>
          <td>
            <a style="color:#fff; text-decoration:none;" href="/views/seguridad/p-login-clientes.php">
              Ya tienes una cuenta?<br>Ingresa aqui
            </a>
          </td>
        </tr>
      </table>
    </form>
    <div>
      <img src="/assets/imagenes/imagen--registro.png">
    </div>
  </div>
</body>

</html>