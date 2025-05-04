<?php
include('../../conexion_bd.php');

// Consultar las ventas con información del producto
$query = "SELECT ventas.*, productos.nombre AS nombre_producto, productos.precio AS precio_unitario 
          FROM ventas 
          INNER JOIN productos ON ventas.producto_id = productos.id 
          ORDER BY ventas.id DESC";

$resultado = $conexion->query($query);
$ventas = [];

if ($resultado) {
    while ($fila = $resultado->fetch_assoc()) {
        $ventas[] = $fila;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Listado de Ventas</title>
    <link rel="stylesheet" href="../style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container mt-5">
        <h2>Listado de Ventas</h2>
        <a href="crear.php" class="btn btn-primary mb-3">Registrar Nueva Venta</a>
        <?php if (isset($_GET['msg'])): ?>
            <div class="alert alert-success"><?= htmlspecialchars($_GET['msg']) ?></div>
        <?php endif; ?>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID Venta</th>
                    <th>Fecha</th>
                    <th>Producto</th>
                    <th>Precio Unitario</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($ventas) > 0): ?>
                    <?php foreach ($ventas as $venta): ?>
                        <tr>
                            <td><?= $venta['id'] ?></td>
                            <td><?= $venta['fecha'] ?></td>
                            <td><?= htmlspecialchars($venta['nombre_producto']) ?></td>
                            <td>$<?= number_format($venta['precio_unitario'], 2) ?></td>
                            <td><?= $venta['cantidad'] ?></td>
                            <td>$<?= number_format($venta['total'], 2) ?></td>
                            <td>
                                <a href="editar.php?id=<?= $venta['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="eliminar.php?id=<?= $venta['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta venta?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">No hay ventas registradas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
