<?php
require_once __DIR__ . '/../../controllers/personalAdapter.php';
require_once __DIR__ . '/../../tools/httpTools.php';
session_start();
$falloLogueo = false;

if (isset($_POST['dni']) && isset($_POST['password'])) {
	$dni = $_POST['dni'];
	$password = $_POST['password'];
	//validar login
	$id = PersonalAdapter::validarPersonal($dni, $password);
	if ($id != 0) {
		$perfilPersonal = PersonalAdapter::perfilPersonal($id);
		$_SESSION['personal'] = $perfilPersonal;
		HttpTools::redireccionar('index.php');
	} else {
		$falloLogueo = true;
		session_destroy();
	}
}

?>
<!DOCTYPE html>
<html lang="ES">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>LOGIN</title>
	<link rel="stylesheet" href="../../assets/css/style--login--personal.css?=ver1">
	<link rel="shortcut icon" href="/assets/imagenes/logoTienda.png" type="image/x-icon">
</head>

<body>
	<div class="logo">
		<a href="/">
			<img src="../../assets/imagenes/logoTienda.png" width="162px" height="162px">
		</a>

	</div>

	<form class="box" action="p-login-personal.php" method="POST">

		<h1>Login</h1>

		<input type="text" name="dni" placeholder="Nombre" required>

		<input type="password" name="password" placeholder="Password" required>

		<input type="submit" name="login" value="Login">

		<div class="error">
			<?php if ($falloLogueo) : ?>
				<p style="color:#fff;">DNI o contraseña invalidos<br>intentelo nuevamente</p>
			<?php endif; ?>
		</div>

	</form>
</body>

</html>