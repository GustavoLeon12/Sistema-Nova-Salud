<?php
include('../../conexion_bd.php');

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$productos = [];
$query = "SELECT * FROM productos";
$result = $conexion->query($query);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }
}
?>
