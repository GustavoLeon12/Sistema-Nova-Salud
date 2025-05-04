<?php
include('../conexion_bd.php');

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Agregar cliente
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'agregar') {
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $visitas = $_POST['visitas'];
    $ultima_visita = $_POST['ultima_visita'];

    $query = "INSERT INTO clientes (nombre, visitas, ultima_visita) VALUES ('$nombre', '$visitas', '$ultima_visita')";
    if ($conexion->query($query) === TRUE) {
        header("Location: cliente.php?msg=Cliente agregado con éxito");
    } else {
        echo "Error: " . $conexion->error;
    }
}

// Eliminar cliente
if (isset($_GET['action']) && $_GET['action'] === 'eliminar' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM clientes WHERE id = $id";
    if ($conexion->query($query) === TRUE) {
        header("Location: cliente.php?msg=Cliente eliminado con éxito");
    } else {
        echo "Error: " . $conexion->error;
    }
}

// Editar cliente
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'editar') {
    $id = $_POST['id'];
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $visitas = $_POST['visitas'];
    $ultima_visita = $_POST['ultima_visita'];

    $query = "UPDATE clientes SET nombre = '$nombre', visitas = '$visitas', ultima_visita = '$ultima_visita' WHERE id = $id";
    if ($conexion->query($query) === TRUE) {
        header("Location: cliente.php?msg=Cliente actualizado con éxito");
    } else {
        echo "Error: " . $conexion->error;
    }
}

// Obtener todos los clientes
$clientes_recurrentes = [];
$query = "SELECT * FROM clientes";
$result = $conexion->query($query);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $clientes_recurrentes[] = $row;
    }
}

// Verificar si es una edición
$cliente_a_editar = null;
if (isset($_GET['action']) && $_GET['action'] === 'editar' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM clientes WHERE id = $id";
    $result = $conexion->query($query);
    $cliente_a_editar = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Clientes Recurrentes - Botica Nova Salud</title>
    <link rel="icon" type="image/ico" href="../imgindex/case_medical_18048.ico" />
    <link rel="stylesheet" href="style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <!-- Navbar coherente con index.php -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">Botica Nova Salud</a>
            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="cliente.php">Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ventas.php" data-section="ventas">Ventas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Stock</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-3 pt-4">
        <h3 class="header-title mb-4" style="text-align: center;">GESTION DE CLIENTES RECURRENTES</h3>

        <!-- Formulario para agregar o editar cliente -->
        <div class="card p-4 mb-4">
            <h5 class="mb-3"><?php echo $cliente_a_editar ? 'Editar Cliente' : 'Agregar Cliente'; ?></h5>
            <form action="cliente.php" method="POST">
                <input type="hidden" name="action" value="<?php echo $cliente_a_editar ? 'editar' : 'agregar'; ?>">
                <?php if ($cliente_a_editar): ?>
                    <input type="hidden" name="id" value="<?php echo $cliente_a_editar['id']; ?>">
                <?php endif; ?>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $cliente_a_editar ? htmlspecialchars($cliente_a_editar['nombre']) : ''; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="visitas" class="form-label">Visitas</label>
                    <input type="number" class="form-control" id="visitas" name="visitas" value="<?php echo $cliente_a_editar ? $cliente_a_editar['visitas'] : ''; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="ultima_visita" class="form-label">Última Visita</label>
                    <input type="date" class="form-control" id="ultima_visita" name="ultima_visita" value="<?php echo $cliente_a_editar ? $cliente_a_editar['ultima_visita'] : ''; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary"><?php echo $cliente_a_editar ? 'Actualizar Cliente' : 'Agregar Cliente'; ?></button>
            </form>
        </div>

        <!-- Mostrar mensaje si hay una acción exitosa -->
        <?php if (isset($_GET['msg'])): ?>
            <div class="alert alert-success" role="alert">
                <?php echo htmlspecialchars($_GET['msg']); ?>
            </div>
        <?php endif; ?>

        <!-- Tabla de clientes -->
        <div class="card p-4">
            <h5 class="mb-3">Clientes Recurrentes</h5>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Visitas</th>
                            <th>Última Visita</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clientes_recurrentes as $c): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($c['nombre']); ?></td>
                                <td><?php echo $c['visitas']; ?></td>
                                <td><?php echo $c['ultima_visita']; ?></td>
                                <td>
                                    <a href="cliente.php?action=editar&id=<?php echo $c['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                    <a href="cliente.php?action=eliminar&id=<?php echo $c['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este cliente?');">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
