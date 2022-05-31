<?php
require_once __DIR__ . '/httpTools.php';

class CarritoTools
{
  static function obtener()
  {
    HttpTools::iniciarSesion();
    /**
     * Existe un producto en la sesion de carrito de compras
     * sesion carrito = []
     * si hay, devuelve el valor
     * sino devuelve el array vacio
     *  */
    if (!isset($_SESSION['carrito-compras'])) {
      $_SESSION['carrito-compras'] = [];
    }
    return $_SESSION['carrito-compras'];
  }

  /**
   * Funcion para agregar productos al carrito de compras
   * Si el producto se agrega dos veces, no se lista dos veces
   */
  static function agregarProducto($producto)
  {
    //buscamos si se repite el producto agregado al carrito
    $carrito = CarritoTools::obtener();
    $existe = false;

    foreach ($carrito as $id => $item) {
      if ($item['producto']->idPlato == $producto->idPlato) {
        $carrito[$id]['cantidad'] = $item['cantidad'] + 1;
        $existe = true;
      }
    }

    if (!$existe) {
      $carrito[] = ['producto' => $producto, 'cantidad' => 1];
    }

    $_SESSION['carrito-compras'] = $carrito;
    return $carrito;
  }

  /**
   * Funcion para quitar un producto del carrito de compras
   */
  static function eliminarProducto($productoId)
  {
    //buscamos si se repite el producto agregado al carrito
    $carrito = CarritoTools::obtener();

    foreach ($carrito as $id => $item) {
      if ($item['producto']->idPlato == $productoId) {
        unset($carrito[$id]);
      }
    }
    $_SESSION['carrito-compras'] = $carrito;
    return $carrito;
  }


  static function elmininarTodosProductos()
  {
    $_SESSION['carrito-compras'] = [];
  }

  static function actualizarProducto()
  {
  }
}
