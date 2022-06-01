<?php
require_once __DIR__ . '/../models/coneccion.php';
require_once __DIR__ . '/../models/recoverPassword.php';
class RecoverPasswordAdapter
{
  static function insertar($recoverPassword)
  {
    $db = new ConeccionProyectoModular();
    $sql = "INSERT INTO `proyecto_modular`.`recoverpassword`
          (`idCliente`,
          `recoveryToken`,
          `fueUsado`,
          `fechaVencimiento`)
          VALUES
          ($recoverPassword->idCliente,
          '$recoverPassword->recoveryToken',
          $recoverPassword->fueUsado,
          '$recoverPassword->fechaVencimiento'
          );";
    $id = $db->insert($sql);
    // echo $sql;
    $db->cerrar();
    return $id;
  }

  static function validarToken($token)
  {
    $db = new ConeccionProyectoModular();
    $sql = "SELECT cli.correo
      FROM proyecto_modular.recoverpassword as re
      INNER JOIN proyecto_modular.clientes as cli
      on re.idCliente = cli.idCliente
      WHERE 
      re.recoveryToken = '$token'
      AND re.fueUsado = 0 
      AND re.fechaVencimiento > NOW()
      ;";
    $tabla = $db->consulta($sql);
    // echo $sql;
    $db->cerrar();
    if (count($tabla) > 0) {
      return $tabla[0]['correo'];
    } else {
      return null;
    }
  }

  static function usarToken($token)
  {
    $sql = "UPDATE proyecto_modular.recoverpassword
    SET fueUsado = 1
    WHERE recoveryToken = '$token'
    ";
    $db = new ConeccionProyectoModular();
    $esCorrecto = $db->actualizar($sql);
    $db->cerrar();
    return $esCorrecto;
  }
}
