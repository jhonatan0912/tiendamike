<?php

class Personal
{
    public $idPersonal;
    public $dni;
    public $password;

    function __construct($idPersonal, $dni, $password)
    {
        $this->idPersonal = $idPersonal;
        $this->dni = $dni;
        $this->password = $password;
    }
    static function desdeFila($fila)
    {
        $personal = new Personal(
            $fila['idPersonal'],
            $fila['dni'],
            $fila['password']
        );
        return $personal;
    }
    static function desdePersonal($fila)
    {
        $personal = Personal::desdeFila($fila);
        $personal->idPersonal = $fila['idPersonal'];
        $personal->dni = $fila['dni'];
        return $personal;
    }
}
