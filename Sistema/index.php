<?/*php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}*/
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sistema de Botica Nova Salud</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            padding-top: 4.5rem;
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .nav-link {
            cursor: pointer;
        }

        .section {
            display: none;
        }

        .section.active {
            display: block;
        }

        .header-title {
            font-weight: 700;
            color: #2c3e50;
        }

        .table thead {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Botica</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu"
                aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link active" data-section="stock" aria-current="page">Stock Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-section="ventas">Ventas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-section="clientes">Clientes Recurrentes</a>
                    </li>
                </ul>
    <!--              <form class="d-flex" action="../cerrar_sesion.php" method="post">
                    <button class="btn btn-outline-light" type="submit">Cerrar Sesión</button>
                </form>-->
            </div>
        </div>
    </nav>

    <div class="container">

        <?php
        // Datos simulados para la maqueta
        $productos = [
            ['id' => 1, 'nombre' => 'Paracetamol 500mg', 'stock' => 150, 'precio' => 0.50],
            ['id' => 2, 'nombre' => 'Ibuprofeno 400mg', 'stock' => 85, 'precio' => 0.75],
            ['id' => 3, 'nombre' => 'Jarabe para la tos', 'stock' => 45, 'precio' => 3.20],
            ['id' => 4, 'nombre' => 'Antiséptico', 'stock' => 60, 'precio' => 1.50],
        ];

        $ventas = [
            ['fecha' => '2024-06-01', 'producto' => 'Paracetamol 500mg', 'cantidad' => 20, 'total' => 10.00],
            ['fecha' => '2024-06-02', 'producto' => 'Ibuprofeno 400mg', 'cantidad' => 15, 'total' => 11.25],
            ['fecha' => '2024-06-04', 'producto' => 'Jarabe para la tos', 'cantidad' => 5, 'total' => 16.00],
            ['fecha' => '2024-06-05', 'producto' => 'Antiséptico', 'cantidad' => 10, 'total' => 15.00],
        ];

        $clientes_recurrentes = [
            ['nombre' => 'María López', 'visitas' => 12, 'ultima_visita' => '2024-06-03'],
            ['nombre' => 'Carlos García', 'visitas' => 8, 'ultima_visita' => '2024-06-02'],
            ['nombre' => 'Ana Martínez', 'visitas' => 15, 'ultima_visita' => '2024-06-05'],
        ];
        ?>

        <!-- Sección Stock de productos -->
        <div id="stock" class="section active">
            <h2 class="header-title mb-4">Stock de Productos</h2>
            <table class="table table-striped table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Producto</th>
                        <th>Cantidad en Stock</th>
                        <th>Precio (USD)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $p): ?>
                        <tr>
                            <td><?php echo $p['id']; ?></td>
                            <td><?php echo htmlspecialchars($p['nombre']); ?></td>
                            <td><?php echo $p['stock']; ?></td>
                            <td><?php echo number_format($p['precio'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Sección Ventas -->
        <div id="ventas" class="section">
            <h2 class="header-title mb-4">Ventas Recientes</h2>
            <table class="table table-striped table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Total (USD)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ventas as $v): ?>
                        <tr>
                            <td><?php echo $v['fecha']; ?></td>
                            <td><?php echo htmlspecialchars($v['producto']); ?></td>
                            <td><?php echo $v['cantidad']; ?></td>
                            <td><?php echo number_format($v['total'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Sección Clientes Recurrentes -->
        <div id="clientes" class="section">
            <h2 class="header-title mb-4">Clientes Recurrentes</h2>
            <table class="table table-striped table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Visitas</th>
                        <th>Última Visita</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes_recurrentes as $c): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($c['nombre']); ?></td>
                            <td><?php echo $c['visitas']; ?></td>
                            <td><?php echo $c['ultima_visita']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>

    <!-- Bootstrap Bundle with Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Código para control de navegación entre secciones
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function () {
                // Quitar clase active de todos enlaces y secciones
                document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));

                // Activar enlace clicado
                this.classList.add('active');

                // Mostrar la sección correspondiente
                const section = this.getAttribute('data-section');
                document.getElementById(section).classList.add('active');
            });
        });
    </script>
</body>

</html>