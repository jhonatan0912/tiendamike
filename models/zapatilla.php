<?php

class Zapatilla
{
    public $idVariedad;
    public $idZapatilla;
    public $imagenZapatilla;
    public $nombreZapatilla;
    public $descripcionZapatilla;
    public $precioZapatilla;

    function __construct($idVariedad, $idZapatilla, $imagenZapatilla, $nombreZapatilla, $descripcionZapatilla, $precioZapatilla)
    {
        $this->idVariedad = $idVariedad;
        $this->idZapatilla = $idZapatilla;
        $this->imagenZapatilla = $imagenZapatilla;
        $this->nombreZapatilla = $nombreZapatilla;
        $this->descripcionZapatilla = $descripcionZapatilla;
        $this->precioZapatilla = $precioZapatilla;
    }
    static function desdeFila($fila)
    {
        $plato = new Zapatilla(
            $fila['idVariedad'],
            $fila['idZapatilla'],
            $fila['imagenZapatilla'],
            $fila['nombreZapatilla'],
            $fila['descripcionZapatilla'],
            $fila['precioZapatilla']
        );
        return $plato;
    }
    static function desdeZapatilla($fila)
    {
        $plato = Zapatilla::desdeFila($fila);
        $plato->idVariedad = $fila["idVariedad"];
        $plato->idZapatilla = $fila["idZapatilla"];
        $plato->imagenZapatilla = $fila["imagenZapatilla"];
        $plato->nombreZapatilla = $fila["nombreZapatilla"];
        $plato->descripcionZapatilla = $fila["descripcionZapatilla"];
        $plato->precioZapatilla = $fila["precioZapatilla"];
        return $plato;
    }
}
