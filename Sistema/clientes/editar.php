<?php
require_once('../../conexion_bd.php');

if (!isset($_GET['id'])) {
    header("Location: listar.php");
    exit;
}

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $visitas = $_POST['visitas'];
    $ultima_visita = $_POST['ultima_visita'];

    $sql = "UPDATE clientes SET nombre=?, telefono=?, correo=?, visitas=?, ultima_visita=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssisi", $nombre, $telefono, $correo, $visitas, $ultima_visita, $id);
    $stmt->execute();

    header("Location: listar.php");
    exit;
}

$sql = "SELECT * FROM clientes WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$cliente = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="container mt-5">
    <h2>Editar Cliente</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" value="<?= htmlspecialchars($cliente['nombre']) ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Teléfono</label>
            <input type="text" name="telefono" value="<?= htmlspecialchars($cliente['telefono']) ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label>Correo</label>
            <input type="email" name="correo" value="<?= htmlspecialchars($cliente['correo']) ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label>Visitas</label>
            <input type="number" name="visitas" value="<?= $cliente['visitas'] ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label>Última visita</label>
            <input type="date" name="ultima_visita" value="<?= $cliente['ultima_visita'] ?>" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="listar.php" class="btn btn-secondary">Cancelar</a>
    </form>
</body>
</html>
