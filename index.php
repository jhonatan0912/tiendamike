<?php
require_once __DIR__ . '/tools/httpTools.php';
$personalLogeado = HttpTools::validarPersonalLogeado();
$clienteLogeado = HttpTools::validarClienteLogeado();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Palacio Chino Premium</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/style--index.css?ver=1.2">
	<link rel="icon" href="/assets/imagenes/logochifa.png">
</head>

<body>
	<div class="container">
		<div class="main-high">
			<div class="main-high__logo-title">
				<img src="/assets/imagenes/logochifa.png" class="main-high__img">
				<div class="main-high__title">
					Palacio Chino Premium
				</div>
			</div>
			<div class="main-high__options">
				<div class="main-high__firstOption">
					<a href="/views/carta/p-menu-variedades.php" class="main-high__hyperlink">
						Menú
					</a>
				</div>
				<div class="main-high__secondOption">
					<a href="#" class="main-high__hyperlink">
						Contacto
					</a>
				</div>
				<div class="main-high__thirdOption">
					<a href="/views/nosotros.php" class="main-high__hyperlink">
						Nosotros
					</a>
				</div>
				<?php if ($clienteLogeado) : ?>
					<div class="main-high__fourthOption">
						<a href="/views/shopping/checkout.php" class="main-high__hyperlink">
							<img class="img-login" src="/assets/imagenes/user-login.png">
						</a>
					</div>
				<?php else : ?>
					<div class="main-high__fourthOption">
						<a href="/views/seguridad/p-login-clientes.php" class="main-high__hyperlink">
							<img class="img-login" src="/assets/imagenes/user-login.png">
						</a>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<div class="mid">
			<div id="local">
				<img id="localimg" src="/assets/imagenes/ilustracion--index.png" alt="">
			</div>
			<div id="map">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1950.8804646113465!2d-75.20332574561867!3d-12.059963354660924!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x910e9635440c8a4b%3A0x5f68b088a072f7f7!2sChifa%20Palacio%20Chino%20Premium!5e0!3m2!1ses!2spe!4v1641223443255!5m2!1ses!2spe" width="400" height="300" style="border:2;" allowfullscreen="" loading="lazy">
				</iframe>
			</div>
		</div>

		<footer>
			<div class="footerlow">
				<a href="https://www.facebook.com/chifapalaciochino/">
					<img id="logof" src="/assets/imagenes/facebook.png">
				</a>
			</div>
			<div class="footerlow">
				<a href="https://api.whatsapp.com/send?phone=(+51)979024975&text=Quiero%20pedir...&fbclid=IwAR0OWka2E4J2dy41za0dbYT2AuIZHTc7rRi43gtQWGrQB0OUD4YtKr573xM">
					<img id="logow" src="/assets/imagenes/whatsapp1.png">
				</a>
			</div>
			<div class="manage">
				<?php if ($personalLogeado) : ?>
					<a href="/views/administrador/index.php" style="color:#fff;text-decoration:none">
						Administrar
					</a>
				<?php else : ?>
					<a href="/views/administrador/p-login-personal.php" style="color:#fff;text-decoration:none">
						Administrar
					</a>
				<?php endif; ?>
			</div>

			<div>
				<p id="footer--words">
					© Palacio Chino Premium 2022
				</p>
			</div>
		</footer>
	</div>
</body>

</html>