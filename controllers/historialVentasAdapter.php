<?php
require_once __DIR__ . '/../models/coneccion.php';
require_once __DIR__ . '/../models/historial.php';
class HistorialVentasAdapter
{
  static function historialByDate($date)
  {
    $db = new ConeccionProyectoModular();
    $sql = "SELECT 
        venta.idVenta,
        cliente.nombres,
        cliente.apellidos,
        venta.fechaHora,
        plato.nombrePlato,
        plato.precioPlato

        FROM tiendamike.venta 
        inner join tiendamike.clientes as cliente
        on venta.idCliente = cliente.idCliente
        inner join tiendamike.ventadetalle as ventadetalle
        on venta.idVenta = ventadetalle.idVenta
        inner join platos as plato
        on ventadetalle.idPlato = plato.idPlato
        WHERE fechaHora LIKE '%$date%';";
    $tabla = $db->consulta($sql);
    // echo $sql;
    $historiales = [];
    foreach ($tabla as $fila) {
      $historiales[] = HistorialVentas::desdeFila($fila);
    }
    return $historiales;
  }
}
