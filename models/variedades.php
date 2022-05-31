<?php

class Variedad
{
  public $idVariedad;
  public $imagenVariedad;
  public $nombreVariedad;

  function __construct($idVariedad, $imagenVariedad, $nombreVariedad)
  {
    $this->idVariedad = $idVariedad;
    $this->imagenVariedad = $imagenVariedad;
    $this->nombreVariedad = $nombreVariedad;
  }

  static function desdeFila($fila)
  {
    $variedad = new Variedad(
      $fila['idVariedad'],
      $fila['imagenVariedad'],
      $fila['nombreVariedad'],
    );
    return $variedad;
  }

  static function desdeVariedad($fila)
  {
    $variedad = Variedad::desdeFila($fila);
    $variedad->idVariedad = $fila['idVariedad'];
    $variedad->idVariedad = $fila['imagenVariedad'];
    $variedad->idVariedad = $fila['nombreVariedad'];
    return $variedad;
  }
}
