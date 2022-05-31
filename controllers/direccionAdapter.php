<?php
require_once __DIR__ . '/../models/coneccion.php';
require_once __DIR__ . '/../models/direccion.php';

class DireccionAdapter
{
  static function crear($direccion)
  {
    $db = new ConeccionProyectoModular();
    $sql = "INSERT INTO `proyecto_modular`.`direccion`
          (
          `idCliente`,
          `direccion`)
          VALUES
          (
          '$direccion->idCliente',
          '$direccion->direccion'
          );";
    $id = $db->insert($sql);
    $db->cerrar();
    return $id;
  }
  static function listar($idCliente)
  {
    $db = new ConeccionProyectoModular();
    $sql = "SELECT 
    * 
    FROM proyecto_modular.direccion
    WHERE idCliente=$idCliente;";
    $tabla = $db->consulta($sql);
    // echo $sql;
    $direcciones = [];
    foreach ($tabla as $fila) {
      $direcciones[] = Direccion::desdeFila($fila);
    }
    return $direcciones;
  }
}
