    <?php
    require_once __DIR__ . '/../models/coneccion.php';
    require_once __DIR__ . '/../models/plato.php';

    class PlatoAdapter
    {
        static function listar()
        {
            $db = new ConeccionProyectoModular();
            $sql = "SELECT * FROM proyecto_modular.platos;";
            $tabla = $db->consulta($sql);
            $db->cerrar();
            $platos = [];
            foreach ($tabla as $fila) {
                $platos[] = Plato::desdeFila($fila);
            }
            return $platos;
        }
        /**
         * Funcion para listar platos por IdVariedad
         */
        static function listarPorIdVariedad($idVariedad)
        {
            $db = new ConeccionProyectoModular();
            $sql = "SELECT 
            idVariedad,
            idPlato,
            imagenPlato,
            nombrePlato,
            descripcionPlato,
            precioPlato
            FROM proyecto_modular.platos 
            WHERE idVariedad=$idVariedad;";
            $tabla = $db->consulta($sql);
            $db->cerrar();
            $platos = [];
            foreach ($tabla as $fila) {
                $platos[] = Plato::desdeFila($fila);
            }
            return $platos;
        }
        /**
         * Funcion para obtener un plato por id
         */
        static function obtenerUno($idPlato)
        {
            $db = new ConeccionProyectoModular();
            $sql = "SELECT * FROM proyecto_modular.platos
                     WHERE idPlato=$idPlato";
            $tabla = $db->consulta($sql);
            if (count($tabla) > 0) {
                return Plato::desdeFila($tabla[0]);
            } else {
                return NULL;
            }
        }
        /**
         * Funcion para registrar plato
         */
        static function crearPlato($plato)
        {
            $db = new ConeccionProyectoModular();
            $sql = "INSERT INTO `proyecto_modular`.`platos`
                (`idVariedad`,
                `imagenPlato`,
                `nombrePlato`,
                `descripcionPlato`,
                `precioPlato`) 
                VALUES 
                ($plato->idVariedad,
                '$plato->imagenPlato', 
                '$plato->nombrePlato', 
                '$plato->descripcionPlato',
                '$plato->precioPlato');
                ";
            // echo  $sql . "<br>";
            $id = $db->insert($sql);
            // echo $id;
            $db->cerrar();
            return $id;
        }
        /**
         * Funcion para actualizar datos del plato
         */
        static function actualizarPlato($plato)
        {
            $db = new ConeccionProyectoModular();
            $sql = "UPDATE `proyecto_modular`.`platos`
                    SET
                    `idVariedad` = $plato->idVariedad,
                    `imagenPlato`='$plato->imagenPlato',
                    `nombrePlato` = '$plato->nombrePlato',
                    `descripcionPlato`='$plato->descripcionPlato',
                    `precioPlato`='$plato->precioPlato'
                    WHERE `idPlato` = $plato->idPlato;
                    ";
            $esCorrecto = $db->actualizar($sql);
            $db->cerrar();
            return $esCorrecto;
        }
        /**
         * Funcion para eliminar plato
         */
        static function eliminar($idPlato)
        {
            $db = new ConeccionProyectoModular();
            $sql = "DELETE  FROM `proyecto_modular`.`platos`
                    WHERE idPlato=$idPlato;";
            $respuesta = $db->eliminar($sql);
            return $respuesta;
        }
        /**
         * Funcion para traer cantidad de platos
         */
        static function getNumberOfProducts()
        {
            $db = new ConeccionProyectoModular();
            $sql = "SELECT * FROM proyecto_modular.platos;";
            $numberProducts = $db->getNumberData($sql);
            return $numberProducts;
        }
    }
