<?php
include('../../conexion_bd.php');

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM productos WHERE id = $id";
    $result = $conexion->query($query);

    if ($result->num_rows > 0) {
        $producto = $result->fetch_assoc();
    } else {
        echo "Producto no encontrado.";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'editar') {
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $stock = $_POST['stock'];
    $precio = $_POST['precio'];

    $query = "UPDATE productos SET nombre = '$nombre', stock = '$stock', precio = '$precio' WHERE id = $id";
    if ($conexion->query($query) === TRUE) {
        header("Location: ../index.php?msg=Producto actualizado con éxito");
    } else {
        echo "Error: " . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Editar Producto</title>
    <link rel="stylesheet" href="../estilos.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container mt-5 pt-4">
        <h3 class="header-title mb-4">Editar Producto</h3>
        <div class="card p-4 mb-4">
            <form action="editar.php?id=<?php echo $producto['id']; ?>" method="POST">
                <input type="hidden" name="action" value="editar">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $producto['nombre']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" value="<?php echo $producto['stock']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="number" class="form-control" id="precio" name="precio" value="<?php echo $producto['precio']; ?>" step="0.01" required>
                </div>
                <button type="submit" class="btn btn-primary">Actualizar Producto</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
