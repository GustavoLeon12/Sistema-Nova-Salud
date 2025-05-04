<?php
include('../conexion_bd.php');

// Consultar productos desde la base de datos
$query = "SELECT * FROM productos";
$result = mysqli_query($conexion, $query);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sistema de Botica Nova Salud</title>
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
                    <a class="nav-link" href="ventas.php" data-section="ventas">Ventas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Stock</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <!-- Sección Stock de productos -->
    <div id="stock" class="section active">
        <h2 class="header-title" style="text-align: center;">STOCK DE PRODUCTOS</h2>
        
        <!-- Botón para agregar un nuevo producto -->
        <a href="productos/crear.php" class="btn btn-primary mb-3" style="text-align: center;">Agregar Producto</a>
        
        <table class="table table-striped table-bordered align-middle">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Producto</th>
                    <th>Cantidad en Stock</th>
                    <th>Precio (USD)</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($p = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $p['id']; ?></td>
                        <td><?php echo htmlspecialchars($p['nombre']); ?></td>
                        <td><?php echo $p['stock']; ?></td>
                        <td><?php echo number_format($p['precio'], 2); ?></td>
                        <td>
                            <!-- Enlace para editar el producto -->
                            <a href="productos/editar.php?id=<?php echo $p['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                            
                            <!-- Enlace para eliminar el producto -->
                            <a href="productos/eliminar.php?id=<?php echo $p['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este producto?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap Bundle with Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Navegación entre secciones
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', function () {
            document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
            document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
            this.classList.add('active');
            const section = this.getAttribute('data-section');
            document.getElementById(section).classList.add('active');
        });
    });
</script>
</body>

</html>
