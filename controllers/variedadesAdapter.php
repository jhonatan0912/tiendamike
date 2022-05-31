<?php
require_once __DIR__ . '/../models/coneccion.php';
require_once __DIR__ . '/../models/variedades.php';

class VariedadAdapter
{
  /**
   * Funcion para listar variedades
   */
  static function listar()
  {
    $db = new ConeccionProyectoModular();
    $sql = "SELECT * FROM proyecto_modular.variedades;";
    $tabla = $db->consulta($sql);
    $db->cerrar();
    $variedades = [];
    foreach ($tabla as $fila) {
      $variedades[] = Variedad::desdeFila($fila);
    }
    return $variedades;
  }
}
