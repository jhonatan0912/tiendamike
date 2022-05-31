<!DOCTYPE html>
<html lang="ES">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PEDIDOS</title>
	<link rel="stylesheet" href="../assets/css/style--eliminar--usuario.css?=ver1">
	<link rel="icon" href="../imagenes/logochifa.png">
</head>

<body>
	<center>
		<form action="../bd/bd--eliminar--cuenta" method="POST">

			<h1>ELIMINAR CUENTA</h1>

			<table class="tabla">
				<tr>
					<td>CORREO ELECTRÓNICO:</td>
				</tr>
				<tr>
					<td><input type="email" name="correo" value="<?php echo $correo ?>" required></td>
				</tr>
				<tr>
					<td>CONTRASEÑA</td>
				</tr>
				<tr>
					<td><input type="password" name="password" pattern="[A-Z a-z 0-9]{A-Z }" value="<?php echo $password ?>" required></td>
				</tr>
				<tr>
					<td><input type="submit" value="ELIMINAR"></td>
				</tr>
			</table>
		</form>
		<div>
			<img src="../imagenes/delete--account.png" alt="">
		</div>
	</center>
</body>

</html>