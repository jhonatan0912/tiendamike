  <?php
  require_once __DIR__ . '/../models/coneccion.php';
  require_once __DIR__ . '/../models/listaIndex.php';

  class listaIndexAdapter
  {

    static function registrarImagen($listaIndex)
    {
      $db = new ConeccionProyectoModular();
      $sql = "INSERT INTO `tiendamike`.`listaindex`
            (
            `imagenUrl`,
            `descripcion`)
            VALUES
            ('$listaIndex->imagenUrl',
            '$listaIndex->descripcion'
            );
    ";
      $id = $db->insert($sql);
      // echo $sql;
      return  $id;
    }
    static function obtenerUno($idImagen)
    {
      $db = new ConeccionProyectoModular();
      $sql = "SELECT * FROM tiendamike.listaindex
                     WHERE idImagen=$idImagen";
      $tabla = $db->consulta($sql);
      if (count($tabla) > 0) {
        return listaIndex::desdeFila($tabla[0]);
      } else {
        return NULL;
      }
    }

    static function actualizarImg($listaIndex)
    {
      $db = new ConeccionProyectoModular();
      $sql = "UPDATE `tiendamike`.`listaindex`
            SET
            `imagenUrl` = '$listaIndex->imagenUrl'
            WHERE `idImagen` =$listaIndex->idImagen;
                    ";
      $esCorrecto = $db->actualizar($sql);
      $db->cerrar();
      return $esCorrecto;
    }

    static function listar()
    {
      $db = new ConeccionProyectoModular();
      $sql = "SELECT * FROM tiendamike.listaindex;";
      $tabla = $db->consulta($sql);
      $db->cerrar();
      $listaIndex = [];
      foreach ($tabla as $fila) {
        $listaIndex[] = listaIndex::desdeFila($fila);
      }
      return $listaIndex;
    }
    static function eliminar($idImagen)
    {
      $db = new ConeccionProyectoModular();
      $sql = "DELETE  FROM `tiendamike`.`listaindex`
            WHERE idImagen=$idImagen ;
            ";
      echo $sql;
      $respuesta = $db->eliminar($sql);
      return $respuesta;
    }
  }
