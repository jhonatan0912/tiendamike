<?php
require_once __DIR__ . '/../models/coneccion.php';
require_once __DIR__ . '/../models/venta.php';

class VentaAdapter
{
  static function crear($venta)
  {
    $db = new ConeccionProyectoModular();
    $sql = "INSERT INTO `proyecto_modular`.`venta`
            (`idCliente`,
            `celular`,
            `indicaciones`,
            `idDireccion`,
            `fechaHora`,
            `idComprobante`,
            `numeroDocumento`)
            VALUES
            (
            $venta->idCliente,
            '$venta->celular',
            '$venta->indicaciones',
            $venta->idDireccion,
            '$venta->fechaHora',
            $venta->idComprobante,
            '$venta->numeroDocumento'
);";
    // echo $sql;
    $id = $db->insert($sql);
    $db->cerrar();
    return $id;
  }
  /**
   * Funcion para traer cantidad de platos
   */
  static function getNumberOfSales()
  {
    $db = new ConeccionProyectoModular();
    $sql = "SELECT * FROM proyecto_modular.venta;";
    $numberSales = $db->getNumberData($sql);
    return $numberSales;
  }

  static function yAxis($dateFechaHora)
  {
    $db = new ConeccionProyectoModular();
    $sql = "SELECT * from proyecto_modular.venta WHERE fechaHora like '%$dateFechaHora';";
    $yAxis = $db->getNumberData($sql);
    return $yAxis;
  }
  static function salesChart($date)
  {
    $db = new ConeccionProyectoModular();
    // $sql = "SELECT * FROM proyecto_modular.venta
    // WHERE fechaHora LIKE '%$date%';
    // ";
    $sql = "SELECT * from proyecto_modular.venta WHERE fechaHora >= '$date' GROUP BY fechaHora LIMIT 7;";
    echo $sql;
    $tabla = $db->consulta($sql);
    $db->cerrar();
    $dias = [];
    foreach ($tabla as $fila) {
      $dias[] = Venta::desdeVenta($fila);
    }
    return $dias;
  }
}
