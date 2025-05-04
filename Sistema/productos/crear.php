<?php
include('../../conexion_bd.php');

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'agregar') {
    // Recoger y sanitizar los datos del formulario
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $stock = $_POST['stock'];
    $precio = $_POST['precio'];

    // Validar si los campos son vacíos
    if (empty($nombre) || empty($stock) || empty($precio)) {
        echo "Todos los campos son obligatorios.";
    } else {
        // Insertar el nuevo producto
        $query = "INSERT INTO productos (nombre, stock, precio) VALUES ('$nombre', '$stock', '$precio')";

        if ($conexion->query($query) === TRUE) {
            // Redirigir al listado de productos después de agregar
            header("Location: ../index.php?msg=Producto agregado con éxito");
            exit(); // Asegurarnos de que la redirección sea la última acción
        } else {
            echo "Error: " . $conexion->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Agregar Producto - Botica Nova Salud</title>
    <link rel="icon" type="image/ico" href="../imgindex/case_medical_18048.ico" />
    <link rel="stylesheet" href="../style.css" />
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container mt-5">
        <h2>Agregar Nuevo Producto</h2>
        <form method="POST" action="crear.php">
            <input type="hidden" name="action" value="agregar">
            
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Producto</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            
            <div class="mb-3">
                <label for="stock" class="form-label">Cantidad en Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" required>
            </div>
            
            <div class="mb-3">
                <label for="precio" class="form-label">Precio (USD)</label>
                <input type="number" class="form-control" id="precio" name="precio" step="0.01" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Agregar Producto</button>
        </form>
    </div>

    <!-- Bootstrap Bundle with Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
