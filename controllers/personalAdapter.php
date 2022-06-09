<?php

require_once __DIR__ . '/../models/coneccion.php';
require_once __DIR__ . '/../models/personal.php';

class PersonalAdapter
{
	/**
	 * Funcion para registrar personal
	 */
	static function registrarPersonal($personal)
	{
		$hash	= hash('sha512', $personal->password);
		$db = new ConeccionProyectoModular();
		$sql = "INSERT INTO `tiendamike`.`personal`
		(`dni`,
		`password`)
		VALUES
		('$personal->dni',
		'$hash');
		";
		$id = $db->insert($sql);
		return $id;
	}
	/**
	 * Funcion para logear personal
	 */
	static function validarPersonal($dni, $password)
	{
		$hash = hash('sha512', $password);
		$sql = "SELECT idPersonal
		 FROM tiendamike.personal
		 WHERE dni='$dni' 
		 AND
		 password ='$hash';
		";
		$db = new ConeccionProyectoModular();
		echo $sql;
		$tabla = $db->consulta($sql);
		$db->cerrar();
		if (count($tabla) > 0) {
			return $tabla[0]['idPersonal'];
		}
		return false;
	}
	/**
	 * Funcion para obtener datos de personal(DNI)
	 */

	static function perfilPersonal($id)
	{
		$sql = "SELECT idPersonal,dni
		 	FROM tiendamike.personal
			 WHERE idPersonal=$id;";
		// echo $sql;
		$db = new ConeccionProyectoModular();
		$tabla = $db->consulta($sql);
		if (count($tabla) > 0) {
			return Personal::desdePersonal($tabla[0]);
		}
		return null;
	}

	/**
	 * Funcion para traer cantidad de personal
	 */
	static function getNumberOfStaff()
	{
		$db = new ConeccionProyectoModular();
		$sql = "SELECT * FROM tiendamike.personal;";
		$numberOfStaff = $db->getNumberData($sql);
		return $numberOfStaff;
	}
}
