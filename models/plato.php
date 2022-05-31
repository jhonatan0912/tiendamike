<?php

class Plato
{
    public $idVariedad;
    public $idPlato;
    public $imagenPlato;
    public $nombrePlato;
    public $descripcionPlato;
    public $precioPlato;    

    function __construct($idVariedad, $idPlato, $imagenPlato, $nombrePlato, $descripcionPlato, $precioPlato)
    {
        $this->idVariedad = $idVariedad;
        $this->idPlato = $idPlato;
        $this->imagenPlato = $imagenPlato;
        $this->nombrePlato = $nombrePlato;
        $this->descripcionPlato = $descripcionPlato;
        $this->precioPlato = $precioPlato;
    }
    static function desdeFila($fila)
    {
        $plato = new Plato(
            $fila['idVariedad'],
            $fila['idPlato'],
            $fila['imagenPlato'],
            $fila['nombrePlato'],
            $fila['descripcionPlato'],
            $fila['precioPlato']
        );
        return $plato;
    }
    static function desdePlato($fila)
    {
        $plato = Plato::desdeFila($fila);
        $plato->idVariedad = $fila["idVariedad"];
        $plato->idPlato = $fila["idPlato"];
        $plato->imagenPlato = $fila["imagenPlato"];
        $plato->nombrePlato = $fila["nombrePlato"];
        $plato->descripcionPlato = $fila["descripcionPlato"];
        $plato->precioPlato = $fila["precioPlato"];
        return $plato;
    }
}
