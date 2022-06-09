<?php
require_once __DIR__ . '/../../models/coneccion.php';
require_once __DIR__ . '/../../controllers/clienteAdapter.php';
require_once __DIR__ . '/../../tools/httpTools.php';

if (isset($_POST['registrarCliente'])) {
	$nombres = $_POST['nombres'];
	$apellidos = $_POST['apellidos'];
	$correo = $_POST['correo'];
	$password = $_POST['password'];

	$registroCorrecto = ClienteAdapter::registrarUsuario($nombres, $apellidos, $correo, $password);

	if (!$registroCorrecto) {
		HttpTools::redireccionar('/views/shopping/checkout.php');
	} else {
		echo "error";
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
	<link rel="icon" href="/assets/imagenes/logoTienda.png">
</head>

<body>
	<center>
		<h1>REGISTRARSE</h1>
	</center>
	<div class="container--mid">

		<form action="p-registro-clientes.php" method="POST">
			<table class="tabla">
				<div class="already-registered">
					<a href="/views/seguridad/p-login-clientes.php">
						¿YA ERES USUARIO? &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
						INICIA SESIÓN
					</a>

				</div>
				<tr>
					<td>NOMBRES:</td>
				</tr>
				<tr>
					<td>
						<input type="text" name="nombres" required>
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
						<input type="email" name="correo" required>
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
			</table>
		</form>
	</div>



</body>

</html>