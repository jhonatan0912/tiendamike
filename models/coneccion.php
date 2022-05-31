<?php
class ConeccionProyectoModular
{
    private $con;

    function __construct()
    {
        $this->con = mysqli_connect(
            '127.0.0.1', //localhost
            'root', //user
            '1234', //password 
            'proyecto_modular', //name DB
            3306 //port
        );
    }
    /**
     * Funcion para hacer la consulta SELECT
     */
    function consulta($sql)
    {
        $respuesta = mysqli_query($this->con, $sql);
        $tabla = [];
        while ($fila = mysqli_fetch_assoc($respuesta)) {
            $tabla[] = $fila;
        }
        return $tabla;
    }
    /**
     * Funcion para hacer la consulta INSERT
     */
    function insert($sql)
    {
        $respuesta = mysqli_query($this->con, $sql);
        if ($respuesta === TRUE) {
            //retorna un ID
            return mysqli_insert_id($this->con);
        } else {
            //no se guardan registros
            return false;
        }
    }
    /**
     * Funcion para hacer la consulta UPDATE
     */
    function actualizar($sql)
    {
        $respuesta = mysqli_query($this->con, $sql);
        return $respuesta;
    }
    /**
     * Funcion para hacer la consulta DELETE
     */
    function eliminar($sql)
    {
        $respuesta = mysqli_query($this->con, $sql);
        return $respuesta;
    }
    /**
     * Funcion para contar numero de filas tabla
     */
    function getNumberData($sql)
    {
        $respuesta = mysqli_query($this->con, $sql);
        $numberData = mysqli_num_rows($respuesta);
        return $numberData;
    }

    /**
     * Funcion para cerrar conexion a la DB
     */
    function cerrar()
    {
        mysqli_close($this->con);
    }
}
