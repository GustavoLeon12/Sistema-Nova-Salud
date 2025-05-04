<?php
// ACTIVA los errores para depurar
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluye primero la conexión y el controlador
include("conexion_bd.php");
include("controlador.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login al Sistema</title>
    <link rel="icon" type="image/ico" href="imgindex/case_medical_18048.ico" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            background-image: url('imgindex/fondologin.jpg');
            /* Puedes usar otra ruta o imagen */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            width: 100%;
        }

        .form-control {
            margin-bottom: 15px;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        .register-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #0d6efd;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .register-link:hover {
            color: #084298;
            text-decoration: underline;
        }
    </style>
</head>
<script>
    // Ocultar mensaje de error automáticamente luego de 4 segundos
    window.addEventListener("DOMContentLoaded", () => {
        const errorMsg = document.getElementById("errorMsg");
        if (errorMsg) {
            setTimeout(() => {
                errorMsg.style.display = "none";
            }, 4000);

            // También lo ocultamos si el usuario interactúa con cualquier input
            document.querySelectorAll("input").forEach(input => {
                input.addEventListener("focus", () => {
                    errorMsg.style.display = "none";
                });
            });
        }
    });
    function togglePassword() {
        const passwordInput = document.getElementById('input');
        const toggleBtn = document.getElementById('toggleBtn').querySelector('i');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleBtn.classList.remove('bi-eye');
            toggleBtn.classList.add('bi-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleBtn.classList.remove('bi-eye-slash');
            toggleBtn.classList.add('bi-eye');
        }
    }
</script>


<body>

    <div class="login-card">
        <h2>Iniciar Sesión</h2>
        <form method="POST">
            <input id="usuario" type="email" name="usuario" class="form-control" placeholder="Usuario" required>
            <div class="input-group mb-3">
                <input id="input" type="password" name="contraseña" class="form-control" placeholder="Contraseña"
                    minlength="8" required>
                <span class="input-group-text" style="cursor: pointer;" onclick="togglePassword()" id="toggleBtn">
                    <i class="bi bi-eye"></i>
                </span>
            </div>
            <input name="btningresar" type="submit" value="Entrar" class="btn btn-primary w-100">
        </form>
        <a class="register-link" href="registrar.php">¿No tienes cuenta? Regístrate</a>
        <a href="index.html"
            class="btn btn-outline-secondary w-100 mt-2 d-flex align-items-center justify-content-center gap-2">
            <i class="bi bi-house-door-fill"></i> Volver al inicio
        </a>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>