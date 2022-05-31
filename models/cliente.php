<?php

class Cliente
{
    public $idCliente;
    public $nombres;
    public $apellidos;
    public $correo;
    public $password;

    function __construct($idCliente, $nombres, $apellidos, $correo)
    {
        $this->idCliente = $idCliente;
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->correo = $correo;
        // $this->password=$password;
    }
    static function desdeFila($fila)
    {
        $cliente = new Cliente(
            $fila['idCliente'],
            $fila['nombres'],
            $fila['apellidos'],
            $fila['correo'],
            // $fila['$password']
        );
        return $cliente;
    }
    static function desdeCliente($fila)
    {
        $cliente = Cliente::desdeFila($fila);
        $cliente->idCliente = $fila["idCliente"];
        $cliente->nombres = $fila["nombres"];
        $cliente->apellidos = $fila["apellidos"];
        $cliente->correo = $fila["correo"];
        return $cliente;
    }
}
