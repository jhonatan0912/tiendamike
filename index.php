<?php
require_once __DIR__ . '/tools/httpTools.php';
require_once __DIR__ . '/controllers/listaIndexAdapter.php';
$personalLogeado = HttpTools::validarPersonalLogeado();
$clienteLogeado = HttpTools::validarClienteLogeado();
$listaIndexes = listaIndexAdapter::listar();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mike</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/style--index.css">
	<link rel="icon" href="/assets/imagenes/logoTienda.png">
</head>

<body>
	<div class="container">
		<div class="main-high">
			<div class="main-high__logo-title">
				<div class="main-high__title">
					Calzados Mike
				</div>
			</div>
			<div class="varietys">
				<div class="main-high__firstOption">
					<a href="/views/carta/catalogo.php" class="main-high__hyperlink">
						Catalogo
					</a>
				</div>
				<div class="main-high__thirdOption">
					<a href="/views/contactanos.php" class="main-high__hyperlink">
						Contactanos
					</a>
				</div>
				<div class="main-high__thirdOption">
					<a href="/views/carta/marcas.php" class="main-high__hyperlink">
						Marcas
					</a>
				</div>
			</div>
			<div class="main-high__options">
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
				<div class="main-high__thirdOption">
					<?php include_once __DIR__ . '/views/plantilla/shoppingCart.php'; ?>
				</div>
			</div>
		</div>
		<div class="mid">
			<div class="marquee center">
				Lo más nuevo....
			</div>
			<div class="marquee zapatillas">
				<?php foreach ($listaIndexes as $ls) : ?>
					<div class="images-index-container">
						<img src="<?php echo $ls->imagenUrl ?>" width="295px" height="295px">
						<div class="marquee-description">
							<p>
								<?php echo ucwords($ls->descripcion) ?>
							</p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>

		<footer>
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
		</footer>
	</div>

</body>

</html>