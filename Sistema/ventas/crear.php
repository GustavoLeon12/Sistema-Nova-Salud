<?php
include('../../conexion_bd.php');

// Obtener productos para el formulario
$productos = [];
$query_productos = "SELECT * FROM productos";
$resultado = $conexion->query($query_productos);
if ($resultado) {
    while ($row = $resultado->fetch_assoc()) {
        $productos[] = $row;
    }
}

// Procesar el formulario de venta
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['producto_id'], $_POST['cantidad'])) {
    $producto_id = intval($_POST['producto_id']);
    $cantidad = intval($_POST['cantidad']);
    $fecha = date('Y-m-d');

    // Verificar stock actual
    $query_stock = "SELECT stock, precio FROM productos WHERE id = $producto_id";
    $res = $conexion->query($query_stock);
    $producto = $res->fetch_assoc();

    if (!$producto) {
        echo "Producto no encontrado.";
        exit;
    }

    $stock_actual = $producto['stock'];
    $precio_unitario = $producto['precio'];

    if ($cantidad <= 0) {
        echo "La cantidad debe ser mayor que cero.";
        exit;
    }

    if ($cantidad > $stock_actual) {
        echo "Stock insuficiente. Solo hay $stock_actual unidades disponibles.";
        exit;
    }

    $total = $cantidad * $precio_unitario;

    // Registrar la venta
    $query_venta = "INSERT INTO ventas (fecha, producto_id, cantidad, total) VALUES ('$fecha', $producto_id, $cantidad, $total)";
    if ($conexion->query($query_venta)) {
        // Descontar del stock
        $nuevo_stock = $stock_actual - $cantidad;
        $conexion->query("UPDATE productos SET stock = $nuevo_stock WHERE id = $producto_id");

        header("Location: ../ventas.php?msg=Venta registrada con éxito");
        exit;
    } else {
        echo "Error al registrar venta: " . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registrar Venta</title>
    <link rel="stylesheet" href="../style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container mt-5">
        <h2>Registrar Nueva Venta</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="producto_id" class="form-label">Producto</label>
                <select name="producto_id" id="producto_id" class="form-select" required>
                    <option value="">Seleccione un producto</option>
                    <?php foreach ($productos as $p): ?>
                        <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['nombre']) ?> (Stock: <?= $p['stock'] ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad" class="form-control" min="1" required>
            </div>
            <button type="submit" class="btn btn-success">Registrar Venta</button>
        </form>
    </div>
</body>

</html>
