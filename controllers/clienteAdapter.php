<?php
require_once __DIR__ . '/../models/coneccion.php';
require_once __DIR__ . '/../models/cliente.php';

class ClienteAdapter
{
    /**
     * Funcion para logear a cliente
     */
    static function validarDatos($correo, $password)
    {
        $hash = hash('sha512', $password);
        $sql = "SELECT idCliente FROM proyecto_modular.clientes
                WHERE correo ='$correo'
                AND password ='$hash'
                ";
        $db = new ConeccionProyectoModular();
        $tabla = $db->consulta($sql);
        $db->cerrar();
        if (count($tabla) > 0) {
            return $tabla[0]['idCliente'];
        }
        return false;
    }
    /**
     * Funcion para registrar usuarios
     */
    static function registrarUsuario($nombres, $apellidos, $correo, $password)
    {

        $conn = new ConeccionProyectoModular();
        if (!$conn) {
            die("Coneccion fallida" . mysqli_connect_error());
        } else {
            $hash = hash('sha512', $password);

            $sql = "INSERT INTO `proyecto_modular`.`clientes`
                     (`nombres`, `apellidos`, `correo`, `password`) 
                    VALUES ('$nombres', '$apellidos', '$correo', '$hash');";

            $conn->insert($sql);
        }
        $conn->cerrar();
    }
    /**
     * funcion para traer datos del perfil-cliente
     */
    static function perfilCliente($id)
    {
        $db = new ConeccionProyectoModular();
        $sql = "SELECT idCliente,
                        nombres,
                        apellidos,
                        correo
        FROM proyecto_modular.clientes
        WHERE idCliente=$id";
        $tabla = $db->consulta($sql);
        if (count($tabla) > 0) {
            return Cliente::desdeCliente($tabla[0]);
        }
        return null;
    }
    /**
     * Funcion para traer datos del perfil-cliente por correo
     */
    static function perfilClientePorCorreo($correo)
    {
        $db = new ConeccionProyectoModular();
        $sql = "SELECT idCliente,
                        nombres,
                        apellidos,
                        correo
        FROM proyecto_modular.clientes
        WHERE correo='$correo'";
        $tabla = $db->consulta($sql);
        if (count($tabla) > 0) {
            return Cliente::desdeCliente($tabla[0]);
        }
        return null;
    }
    /**
     * Funcion para traer cantidad de clientes
     */
    static function getNumberOfClients()
    {
        $db = new ConeccionProyectoModular();
        $sql = "SELECT * FROM proyecto_modular.clientes;";
        $numberClients = $db->getNumberData($sql);
        return $numberClients;
    }

    static function cambiarClave($correo, $password)
    {
        $db = new ConeccionProyectoModular();
        $hash = hash('sha512', $password);
        $sql = "UPDATE proyecto_modular.clientes
        SET `password` = '$password'
        WHERE
        `correo`='$correo';    
        ";
        $esCorrecto = $db->actualizar($sql);
        return $esCorrecto;
    }
}
