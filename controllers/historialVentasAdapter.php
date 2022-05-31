<?php
require_once __DIR__ . '/../models/coneccion.php';
require_once __DIR__ . '/../models/historial.php';
class HistorialVentasAdapter
{
  static function historialByDate($date)
  {
    $db = new ConeccionProyectoModular();
    $sql = "SELECT 
            venta.idVenta AS idVenta,
            cliente.nombres,
            cliente.apellidos,
            cliente.correo,
            venta.celular,
            venta.indicaciones,
            direccion.direccion,
            venta.fechaHora,
            tipoComprobante.tipoComprobante,
            venta.numeroDocumento,
            variedades.nombreVariedad,
            platos.imagenPlato,
            platos.idPlato,
            platos.nombrePlato,
            platos.precioPlato

            FROM proyecto_modular.venta AS venta
            INNER JOIN proyecto_modular.ventadetalle AS detalle
              on venta.idVenta = detalle.idVenta
            INNER JOIN proyecto_modular.direccion AS direccion
            on venta.idDireccion = direccion.idDireccion
            INNER JOIN proyecto_modular.platos AS platos
              on detalle.idPlato = platos.idPlato
            INNER JOIN proyecto_modular.variedades AS variedades
              on platos.idVariedad = variedades.idVariedad
            INNER JOIN proyecto_modular.clientes AS cliente
              on venta.idCliente = cliente.idCliente
            INNER JOIN proyecto_modular.tipocombrobante AS tipoComprobante
            on venta.idComprobante = tipoComprobante.idComprobante
            WHERE  fechaHora LIKE '%$date%';";
    $tabla = $db->consulta($sql);
    // echo $sql;
    $historiales = [];
    foreach ($tabla as $fila) {
      $historiales[] = HistorialVentas::desdeFila($fila);
    }
    return $historiales;
  }
}
