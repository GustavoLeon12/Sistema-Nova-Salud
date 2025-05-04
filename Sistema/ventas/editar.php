<?php
include('../../conexion_bd.php');

// Verificar si se envió un ID válido por GET
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID de venta no especificado.");
}

$id_venta = intval($_GET['id']);

// Obtener los datos de la venta
$query_venta = "SELECT * FROM ventas WHERE id = $id_venta";
$result_venta = $conexion->query($query_venta);

if (!$result_venta || $result_venta->num_rows === 0) {
    die("Venta no encontrada.");
}

$venta = $result_venta->fetch_assoc();

// Obtener todos los productos
$query_productos = "SELECT * FROM productos";
$result_productos = $conexion->query($query_productos);

$productos = [];
while ($row = $result_productos->fetch_assoc()) {
    $productos[] = $row;
}

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fecha = $_POST['fecha'];
    $producto_id_nuevo = intval($_POST['producto_id']);
    $cantidad_nueva = intval($_POST['cantidad']);

    // Obtener datos actuales del producto
    $producto_anterior_id = $venta['producto_id'];
    $cantidad_anterior = $venta['cantidad'];

    // Si cambia el producto o la cantidad, ajustar stock
    if ($producto_anterior_id == $producto_id_nuevo) {
        // Mismo producto: revertir y aplicar nueva cantidad
        $diferencia = $cantidad_nueva - $cantidad_anterior;
        $conexion->query("UPDATE productos SET stock = stock - $diferencia WHERE id = $producto_id_nuevo");
    } else {
        // Producto distinto: devolver stock anterior y descontar del nuevo
        $conexion->query("UPDATE productos SET stock = stock + $cantidad_anterior WHERE id = $producto_anterior_id");
        $conexion->query("UPDATE productos SET stock = stock - $cantidad_nueva WHERE id = $producto_id_nuevo");
    }

    // Obtener precio actual del nuevo producto
    $query_precio = "SELECT precio FROM productos WHERE id = $producto_id_nuevo";
    $res_precio = $conexion->query($query_precio);
    $precio_unitario = $res_precio->fetch_assoc()['precio'];
    $total = $cantidad_nueva * $precio_unitario;

    // Actualizar la venta
    $query_update = "UPDATE ventas 
                     SET fecha = '$fecha', producto_id = $producto_id_nuevo, cantidad = $cantidad_nueva, total = $total 
                     WHERE id = $id_venta";

    if ($conexion->query($query_update) === TRUE) {
        header("Location: ../ventas.php?msg=Venta actualizada correctamente");
        exit;
    } else {
        echo "Error al actualizar la venta: " . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Venta</title>
    <link rel="stylesheet" href="../style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container mt-5">
        <h2>Editar Venta</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Fecha</label>
                <input type="date" class="form-control" name="fecha" value="<?= $venta['fecha'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Producto</label>
                <select class="form-select" name="producto_id" required>
                    <?php foreach ($productos as $producto): ?>
                        <option value="<?= $producto['id'] ?>" <?= $producto['id'] == $venta['producto_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($producto['nombre']) ?> (Stock: <?= $producto['stock'] ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Cantidad</label>
                <input type="number" class="form-control" name="cantidad" value="<?= $venta['cantidad'] ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Actualizar Venta</button>
            <a href="listar.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>

</html>
