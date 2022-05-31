<?php

class Direccion
{
  public $idCliente;
  public $idDireccion;
  public $direccion;

  function __construct($idCliente, $idDireccion, $direccion)
  {
    $this->idCliente = $idCliente;
    $this->idDireccion = $idDireccion;
    $this->direccion = $direccion;
  }

  static function desdeFila($fila)
  {
    $direccion = new Direccion(
      $fila['idCliente'],
      $fila['idDireccion'],
      $fila['direccion']
    );
    return $direccion;
  }

  static function desdeDireccion($fila)
  {
    $direccion = Direccion::desdeFila($fila);
    $direccion->idCliente = $fila['idCliente'];
    $direccion->idDireccion = $fila['idDireccion'];
    $direccion->direccion = $fila['direccion'];
    return $direccion;
  }
}
