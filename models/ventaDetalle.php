<?php

class VentaDetalle
{
  public $idVenta;
  public $idVentaDetalle;
  public $idZapatilla;
  public $cantidad;
  public $precioUnitario;

  function __construct(

    $idVenta,
    $idVentaDetalle,
    $idZapatilla,
    $cantidad,
    $precioUnitario


  ) {
    $this->idVenta = $idVenta;
    $this->idVentaDetalle = $idVentaDetalle;
    $this->idZapatilla = $idZapatilla;
    $this->cantidad = $cantidad;
    $this->precioUnitario = $precioUnitario;
  }
  static function desdeFila($fila)
  {
    $ventaDetalle = new VentaDetalle(
      $fila['idVenta'],
      $fila['idVentaDetalle'],
      $fila['idZapatilla'],
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
    $ventaDetalle->idZapatilla = $fila["idZapatilla"];
    $ventaDetalle->cantidad = $fila["cantidad"];
    $ventaDetalle->precioUnitario = $fila["precioUnitario"];
    return $ventaDetalle;
  }
}
