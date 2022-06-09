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
        zapatilla.nombreZapatilla,
        zapatilla.precioZapatilla

        FROM tiendamike.venta 
        inner join tiendamike.clientes as cliente
        on venta.idCliente = cliente.idCliente
        inner join tiendamike.ventadetalle as ventadetalle
        on venta.idVenta = ventadetalle.idVenta
        inner join zapatilla as zapatilla
        on ventadetalle.idZapatilla = zapatilla.idZapatilla
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
