    <?php
    require_once __DIR__ . '/../models/coneccion.php';
    require_once __DIR__ . '/../models/zapatilla.php';

    class ZapatillaAdapter
    {
        static function listar()
        {
            $db = new ConeccionProyectoModular();
            $sql = "SELECT * FROM tiendamike.zapatilla;";
            $tabla = $db->consulta($sql);
            $db->cerrar();
            $platos = [];
            foreach ($tabla as $fila) {
                $platos[] = Zapatilla::desdeFila($fila);
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
            idZapatilla,
            imagenZapatilla,
            nombreZapatilla,
            descripcionZapatilla,
            precioZapatilla
            FROM tiendamike.zapatilla 
            WHERE idVariedad=$idVariedad;";
            $tabla = $db->consulta($sql);
            $db->cerrar();
            $platos = [];
            foreach ($tabla as $fila) {
                $platos[] = Zapatilla::desdeFila($fila);
            }
            return $platos;
        }
        /**
         * Funcion para obtener un plato por id
         */
        static function obtenerUno($idZapatilla)
        {
            $db = new ConeccionProyectoModular();
            $sql = "SELECT * FROM tiendamike.zapatilla
                     WHERE idZapatilla=$idZapatilla";
            $tabla = $db->consulta($sql);
            if (count($tabla) > 0) {
                return Zapatilla::desdeFila($tabla[0]);
            } else {
                return NULL;
            }
        }
        /**
         * Funcion para registrar plato
         */
        static function crearZapatilla($plato)
        {
            $db = new ConeccionProyectoModular();
            $sql = "INSERT INTO tiendamike.zapatilla
                (`idVariedad`,
                `imagenZapatilla`,
                `nombreZapatilla`,
                `descripcionZapatilla`,
                `precioZapatilla`) 
                VALUES 
                ($plato->idVariedad,
                '$plato->imagenZapatilla', 
                '$plato->nombreZapatilla', 
                '$plato->descripcionZapatilla',
                '$plato->precioZapatilla');
                ";
            $id = $db->insert($sql);
            // echo $id;
            $db->cerrar();
            return $id;
        }
        /**
         * Funcion para actualizar datos del plato
         */
        static function actualizarZapatilla($plato)
        {
            $db = new ConeccionProyectoModular();
            $sql = "UPDATE tiendamike.zapatilla
                    SET
                    `idVariedad` = $plato->idVariedad,
                    `imagenZapatilla`='$plato->imagenZapatilla',
                    `nombreZapatilla` = '$plato->nombreZapatilla',
                    `precioZapatilla`='$plato->precioZapatilla'
                    WHERE `idZapatilla` = $plato->idZapatilla;
                    ";
            // echo $sql;
            $esCorrecto = $db->actualizar($sql);
            $db->cerrar();
            return $esCorrecto;
        }
        /**
         * Funcion para eliminar plato
         */
        static function eliminar($idZapatilla)
        {
            $db = new ConeccionProyectoModular();
            $sql = "DELETE  FROM tiendamike.zapatilla
                    WHERE idZapatilla=$idZapatilla;";
            $respuesta = $db->eliminar($sql);
            return $respuesta;
        }
        /**
         * Funcion para traer cantidad de platos
         */
        static function getNumberOfProducts()
        {
            $db = new ConeccionProyectoModular();
            $sql = "SELECT * FROM tiendamike.zapatilla;";
            $numberProducts = $db->getNumberData($sql);
            return $numberProducts;
        }
    }
