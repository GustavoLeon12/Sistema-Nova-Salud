<?php
include('../../conexion_bd.php');

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM productos WHERE id = $id";
    if ($conexion->query($query) === TRUE) {
        header("Location: ../index.php?msg=Producto eliminado con éxito");
    } else {
        echo "Error: " . $conexion->error;
    }
}
?>
