<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Registro de Usuario</title>
    <link rel="icon" type="image/ico" href="imgindex/case_medical_18048.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            background-image: url('imgindex/fondologin.jpg');
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

        .login-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #0d6efd;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .login-link:hover {
            color: #084298;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <h2>Crear Cuenta</h2>
        <form method="POST" action="procesar_registro.php">
            <input type="email" name="usuario" class="form-control" placeholder="Correo electrónico" required>

            <div class="input-group mb-3">
                <input id="pass1" type="password" name="contraseña" class="form-control" placeholder="Contraseña" minlength="8" required>
                <span class="input-group-text" style="cursor: pointer;" onclick="togglePassword('pass1', this)">
                    <i class="bi bi-eye"></i>
                </span>
            </div>

            <div class="input-group mb-3">
                <input id="pass2" type="password" name="confirmar" class="form-control" placeholder="Confirmar contraseña" minlength="8" required>
                <span class="input-group-text" style="cursor: pointer;" onclick="togglePassword('pass2', this)">
                    <i class="bi bi-eye"></i>
                </span>
            </div>

            <input type="submit" name="btnregistrar" value="Registrarse" class="btn btn-success w-100">
        </form>
        <a href="login.php" class="btn btn-outline-secondary w-100 mt-2 d-flex align-items-center justify-content-center gap-2">
            <i class="bi bi-arrow-left-circle"></i> Volver al Login
        </a>
    </div>

    <script>
        function togglePassword(inputId, el) {
            const input = document.getElementById(inputId);
            const icon = el.querySelector('i');
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("bi-eye");
                icon.classList.add("bi-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("bi-eye-slash");
                icon.classList.add("bi-eye");
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
