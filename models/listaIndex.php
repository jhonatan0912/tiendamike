<?php

class listaIndex
{
  public $idImagen;
  public $imagenUrl;
  public $descripcion;

  function __construct($idImagen, $imagenUrl, $descripcion)
  {
    $this->idImagen = $idImagen;
    $this->imagenUrl = $imagenUrl;
    $this->descripcion = $descripcion;
  }

  static function desdeFila($fila)
  {
    $listaIndex = new listaIndex(
      $fila['idImagen'],
      $fila['imagenUrl'],
      $fila['descripcion'],
    );
    return $listaIndex;
  }
  static function desdeListaIndex($fila)
  {
    $listaIndex = listaIndex::desdeFila($fila);
    $listaIndex->idImagen = $fila['idImagen'];
    $listaIndex->imagenUrl = $fila['imagenUrl'];
    $listaIndex->descripcion = $fila['descripcion'];
    return $listaIndex;
  }
}
