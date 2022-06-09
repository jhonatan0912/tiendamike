<?php
require_once __DIR__ . '/../../models/cliente.php';
require_once __DIR__ . '/../../controllers/platoAdapter.php';
require_once __DIR__ . '/../../tools/carritoTools.php';
require_once __DIR__ . '/../../tools/httpTools.php';
HttpTools::iniciarSesion();
//CARRITO DE COMPRAS
$carrito = CarritoTools::obtener();
/**
 * Si el boton de comprar se pulsa, se envia el id a esta pagina, listamos el producto por su ID y lo agregamos al [] carrito de compras
 */
if (isset($_GET['agregar'])) {
    $producto = PlatoAdapter::obtenerUno($_GET['agregar']);
    $carrito = CarritoTools::agregarProducto($producto);
}
/**
 * Si se pulsa en boton ELIMINAR, se elmina el producto del carrito de compras con la funcion eliminarProducto
 */
if (isset($_GET['eliminar'])) {
    $carrito = CarritoTools::eliminarProducto($_GET['eliminar']);
}

/**
 * Resumen/precio pedido
 */
$subtotal = 0;
foreach ($carrito as $item) {
    $precio = $item['producto']->precioPlato;
    $cantidad = $item['cantidad'];
    $costo = $precio * $cantidad;
    $subtotal = $subtotal + $costo;
}
/**
 * Fin reumen/ precio 
 */
?>
<html lang="ES">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style--carrito--compras.css">
    <link rel="shortcut icon" href="/assets/imagenes/logoTienda.png" type="image/x-icon">
    <script src="https://kit.fontawesome.com/a413ea44fb.js" crossorigin="anonymous"></script>
    <title>Carrito de compras</title>
</head>

<body>
    <div class="nav--high">
        <div class="logo">
            <?php if ($carrito == null) : ?>
                <a class="hyperlink__logo" href="/views/carta/marcas.php">
                    Calzados Mike
                </a>
            <?php else : ?>
                <a class="hyperlink__logo" href="<?= $_SERVER["HTTP_REFERER"] ?>">
                    Calzados Mike
                </a>
            <?php endif; ?>
        </div>

        <div class="container-title-page">
            <h1 class="title-shopping-cart">CARRITO</h1>
        </div>
    </div>
    <div class="order-p">
        Productos
    </div>
    <!-- lista de productos del carrito de compras -->
    <div class="products-container">
        <div class="orders-container">
            <table>
                <?php foreach ($carrito as $item) : ?>
                    <tr>
                        <!-- imagen -->
                        <td>
                            <img class="imagen-producto" src="<?php echo $item['producto']->imagenPlato; ?>" width="100px">
                        </td>
                        <!-- nombreproducto -->
                        <td><strong>
                                <?php echo ucwords($item['producto']->nombrePlato); ?>
                            </strong>
                        </td>
                        <!-- descripcion producto -->
                        <!-- precio producto -->
                        <td>
                            S/<?php echo $item['producto']->precioPlato; ?>
                        </td>
                        <!-- cantidad de productos deseado -->
                        <td>
                            <input type="number" step="1" value="<?php echo  $item['cantidad']; ?>" min="1" readonly>
                        </td>
                        <!-- boton eliminar producto del carrito de compras  -->
                        <td>
                            <a href="/views/shopping/p-carrito-compras.php?eliminar=<?php echo $item['producto']->idPlato; ?>">
                                <i class="fas fa-times-circle"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="resumen-pedido-container">
            <div class="resumen-pedido">
                <div class="subtotal-container">
                    <strong>Subtotal:</strong>
                    <span>S/<?php echo $subtotal; ?></span>
                </div>
                <div class="btn-continuar">
                    <a href="/views/shopping/checkout.php">
                        Procesar pedido
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>