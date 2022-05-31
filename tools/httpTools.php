<?php
class HttpTools
{
    /**
     * Funcion para redireccionar hacia una página
     */
    static function redireccionar($ruta)
    {
        header("Location: $ruta");
        die();
    }

    /**
     * Valida si hay un cliente logeado 
     */
    static function validarClienteLogeado()
    {
        HttpTools::iniciarSesion();
        if (isset($_SESSION["perfil"])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Valida personal logeado
     */
    static function validarPersonalLogeado()
    {
        HttpTools::iniciarSesion();
        if (isset($_SESSION['personal'])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Funcion que retorna SESION de cliente
     */

    static function getCliente()
    {
        return $_SESSION["perfil"];
    }
    
    /**
     * Esta funcion valida si hay un cliente logeado
     * Si no esta logeado lo lleva a una pagina 403
     */
    static function soloCliente()
    {
        $estaLogeado = HttpTools::validarClienteLogeado();
        if ($estaLogeado) {
            return;
        } else {
            HttpTools::redireccionar("/p/errores/p403.php");
        }
    }

    static function iniciarSesion()
    {
        $status = session_status();
        if ($status != PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    static function cerrarSesion()
    {
        HttpTools::iniciarSesion();
        $status = session_status();
        if ($status == PHP_SESSION_ACTIVE) {
            session_destroy();
        }
    }
}
