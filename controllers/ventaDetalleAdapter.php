<?php
require_once __DIR__ . '/../models/coneccion.php';
require_once __DIR__ . '/../models/historial.php';
require_once __DIR__ . '/../models/ventaDetalle.php';


class VentaDetalleAdapter
{
  static function listar($idVenta)
  {
    $db = new ConeccionProyectoModular();
    $sql = "SELECT
     *
     FROM proyecto_modular.ventadetalle
     WHERE idVenta=$idVenta;";
    $tabla = $db->consulta($sql);
    // echo $sql;
    $ventaDetalles = [];
    foreach ($tabla as $fila) {
      $ventaDetalles[] = VentaDetalle::desdeFila($fila);
    }
    return $ventaDetalles;
  }
  static function crear($ventaDetalle)
  {
    $db = new ConeccionProyectoModular();
    $sql = "INSERT INTO `proyecto_modular`.`ventadetalle`
          (
          `idVenta`,
          `idPlato`,
          `cantidad`,
          `precioUnitario`)
          VALUES
          (
          $ventaDetalle->idVenta,
          $ventaDetalle->idPlato,
          $ventaDetalle->cantidad,
          $ventaDetalle->precioUnitario
          );";
    $id = $db->insert($sql);
    // echo "<br>" . $sql;
    return $id;
  }
}
