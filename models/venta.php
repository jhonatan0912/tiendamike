<?php

class Venta
{
  public $idCliente;
  public $idVenta;
  public $celular;
  public $indicaciones;
  public $idDireccion;
  public $fechaHora;
  public $idComprobante;
  public $numeroDocumento;

  function __construct(
    $idCliente,
    $idVenta,
    $celular,
    $indicaciones,
    $idDireccion,
    $fechaHora,
    $idComprobante,
    $numeroDocumento
  ) {
    $this->idCliente = $idCliente;
    $this->idVenta = $idVenta;
    $this->celular = $celular;
    $this->indicaciones = $indicaciones;
    $this->idDireccion = $idDireccion;
    $this->fechaHora = $fechaHora;
    $this->idComprobante = $idComprobante;
    $this->numeroDocumento = $numeroDocumento;
  }
  static function desdeFila($fila)
  {
    $venta = new Venta(
      $fila['idCliente'],
      $fila['idVenta'],
      $fila['celular'],
      $fila['indicaciones'],
      $fila['idDireccion'],
      $fila['fechaHora'],
      $fila['idComprobante'],
      $fila['numeroDocumento']
    );
    return $venta;
  }
  static function desdeVenta($fila)
  {
    $venta = Venta::desdeFila($fila);
    $venta->idCliente = $fila["idCliente"];
    $venta->idVenta = $fila["idVenta"];
    $venta->celular = $fila["celular"];
    $venta->indicaciones = $fila["indicaciones"];
    $venta->idDireccion = $fila["idDireccion"];
    $venta->fechaHora = $fila["fechaHora"];
    $venta->idComprobante = $fila["idComprobante"];
    $venta->numeroDocumento = $fila["numeroDocumento"];
    return $venta;
  }
}
