<?php

class VentaDetalle
{
  public $idVenta;
  public $idVentaDetalle;
  public $idPlato;
  public $cantidad;
  public $precioUnitario;

  function __construct(

    $idVenta,
    $idVentaDetalle,
    $idPlato,
    $cantidad,
    $precioUnitario


  ) {
    $this->idVenta = $idVenta;
    $this->idVentaDetalle = $idVentaDetalle;
    $this->idPlato = $idPlato;
    $this->cantidad = $cantidad;
    $this->precioUnitario = $precioUnitario;
  }
  static function desdeFila($fila)
  {
    $ventaDetalle = new VentaDetalle(
      $fila['idVenta'],
      $fila['idVentaDetalle'],
      $fila['idPlato'],
      $fila['cantidad'],
      $fila['precioUnitario']
    );
    return $ventaDetalle;
  }
  static function desdeCliente($fila)
  {
    $ventaDetalle = VentaDetalle::desdeFila($fila);
    $ventaDetalle->idVenta = $fila["idVenta"];
    $ventaDetalle->idVentaDetalle = $fila["idVentaDetalle"];
    $ventaDetalle->idPlato = $fila["idPlato"];
    $ventaDetalle->cantidad = $fila["cantidad"];
    $ventaDetalle->precioUnitario = $fila["precioUnitario"];
    return $ventaDetalle;
  }
}
