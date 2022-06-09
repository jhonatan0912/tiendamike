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
    $sql = "SELECT * FROM tiendamike.variedades;";
    $tabla = $db->consulta($sql);
    $db->cerrar();
    $variedades = [];
    foreach ($tabla as $fila) {
      $variedades[] = Variedad::desdeFila($fila);
    }
    return $variedades;
  }
  static function searcher($nombreVariedad)
  {
    $db = new ConeccionProyectoModular();
    $sql = "SELECT * FROM  tiendamike.variedades
            WHERE nombreVariedad 
            LIKE '%$nombreVariedad%'";
    echo $sql;
    $tabla = $db->consulta($sql);
    if (count($tabla) > 0) {
      return Variedad::desdeFila($tabla[0]);
    } else {
      return null;
    }
  }
}
