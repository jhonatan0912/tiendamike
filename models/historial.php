<?php

class HistorialVentas
{
  public $idVenta;
  public $nombres;
  public $apellidos;
  public $correo;
  public $celular;
  public $indicaciones;
  public $direccion;
  public $fechaHora;
  public $tipoComprobante;
  public $numeroDocumento;
  public $nombreVariedad;
  public $idZapatilla;
  public $nombreZapatilla;
  public $precioZapatilla;
  function __construct(
    $idVenta,
    $nombres,
    $apellidos,
    $correo,
    $celular,
    $indicaciones,
    $direccion,
    $fechaHora,
    $tipoComprobante,
    $numeroDocumento,
    $nombreVariedad,
    $idZapatilla,
    $nombreZapatilla,
    $precioZapatilla
  ) {
    $this->idVenta = $idVenta;
    $this->nombres = $nombres;
    $this->apellidos = $apellidos;
    $this->correo = $correo;
    $this->celular = $celular;
    $this->indicaciones = $indicaciones;
    $this->direccion = $direccion;
    $this->fechaHora = $fechaHora;
    $this->tipoComprobante = $tipoComprobante;
    $this->numeroDocumento = $numeroDocumento;
    $this->nombreVariedad = $nombreVariedad;
    $this->idZapatilla = $idZapatilla;
    $this->nombreZapatilla = $nombreZapatilla;
    $this->precioZapatilla = $precioZapatilla;
  }
  static function desdeFila($fila)
  {
    $historial = new HistorialVentas(
      $fila['idVenta'],
      $fila['nombres'],
      $fila['apellidos'],
      $fila['correo'],
      $fila['celular'],
      $fila['indicaciones'],
      $fila['direccion'],
      $fila['fechaHora'],
      $fila['tipoComprobante'],
      $fila['numeroDocumento'],
      $fila['nombreVariedad'],
      $fila['idZapatilla'],
      $fila['nombreZapatilla'],
      $fila['precioZapatilla']
    );
    return $historial;
  }
  static function desdeHistorial($fila)
  {
    $historial = HistorialVentas::desdeFila($fila);
    $historial->idVenta = $fila['idVenta'];
    $historial->nombres = $fila['nombres'];
    $historial->apellidos = $fila['apellidos'];
    $historial->correo = $fila['correo'];
    $historial->celular = $fila['celular'];
    $historial->indicaciones = $fila['indicaciones'];
    $historial->direccion = $fila['direccion'];
    $historial->fechaHora = $fila['fechaHora'];
    $historial->tipoComprobante = $fila['tipoComprobante'];
    $historial->numeroDocumento = $fila['numeroDocumento'];
    $historial->nombreVariedad = $fila['nombreVariedad'];
    $historial->idZapatilla = $fila['idZapatilla'];
    $historial->nombreZapatilla = $fila['nombreZapatilla'];
    $historial->precioZapatilla = $fila['precioZapatilla'];
  }
}
