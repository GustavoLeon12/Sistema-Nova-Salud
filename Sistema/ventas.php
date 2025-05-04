<?php
include('../conexion_bd.php');

// Consultar ventas unidas con productos
$query = "
    SELECT v.id, v.fecha, v.producto_id, v.cantidad, v.total, 
           p.nombre, p.precio, p.stock
    FROM ventas v
    JOIN productos p ON v.producto_id = p.id
    ORDER BY v.fecha DESC
";
$result = mysqli_query($conexion, $query);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Ventas - Botica Nova Salud</title>
    <link rel="icon" type="image/ico" href="../imgindex/case_medical_18048.ico" />
    <link rel="stylesheet" href="style.css" />
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">Botica Nova Salud</a>
        <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="cliente.php">Clientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="ventas.php">Ventas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Stock</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5 pt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Ventas Realizadas</h2>
        <a href="ventas/crear.php" class="btn btn-success">Registrar Nueva Venta</a>
    </div>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>Fecha</th>
                <th>Producto</th>
                <th>Precio Unitario (USD)</th>
                <th>Stock Actual</th>
                <th>Cantidad Vendida</th>
                <th>Total Venta (USD)</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($v = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($v['fecha']); ?></td>
                    <td><?php echo htmlspecialchars($v['nombre']); ?></td>
                    <td><?php echo number_format($v['precio'], 2); ?></td>
                    <td><?php echo $v['stock']; ?></td>
                    <td><?php echo $v['cantidad']; ?></td>
                    <td><?php echo number_format($v['total'], 2); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap Bundle with Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
