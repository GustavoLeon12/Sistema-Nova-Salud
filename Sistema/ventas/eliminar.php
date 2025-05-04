<?php
include('../../conexion_bd.php');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID de venta no especificado.");
}

$id_venta = intval($_GET['id']);

// Obtener venta para revertir stock
$query_venta = "SELECT * FROM ventas WHERE id = $id_venta";
$result_venta = $conexion->query($query_venta);

if ($result_venta->num_rows === 0) {
    die("Venta no encontrada.");
}

$venta = $result_venta->fetch_assoc();

// Devolver stock
$conexion->query("UPDATE productos SET stock = stock + {$venta['cantidad']} WHERE id = {$venta['producto_id']}");

// Eliminar venta
$query_eliminar = "DELETE FROM ventas WHERE id = $id_venta";
if ($conexion->query($query_eliminar) === TRUE) {
    header("Location: ../ventas.php?msg=Venta eliminada correctamente");
    exit;
} else {
    echo "Error al eliminar venta: " . $conexion->error;
}
