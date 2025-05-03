<?php
include("conexion_bd.php");

if (!empty($_POST["btnregistrar"])) {
    $usuario = $_POST["usuario"];
    $clave = $_POST["contraseña"];
    $confirmar = $_POST["confirmar"];

    if (empty($usuario) || empty($clave) || empty($confirmar)) {
        echo '<script>alert("Todos los campos son obligatorios."); window.history.back();</script>';
        exit();
    }

    if ($clave !== $confirmar) {
        echo '<script>alert("Las contraseñas no coinciden."); window.history.back();</script>';
        exit();
    }

    // Verificar si ya existe ese correo
    $verificar = $conexion->query("SELECT * FROM login WHERE usuario = '$usuario'");
    if ($verificar->num_rows > 0) {
        echo '<script>alert("El usuario ya está registrado."); window.history.back();</script>';
        exit();
    }

    // Insertar nuevo usuario
    $sql = "INSERT INTO login (usuario, contraseña) VALUES ('$usuario', '$clave')";
    if ($conexion->query($sql)) {
        echo '<script>alert("Registro exitoso. Ahora puedes iniciar sesión."); window.location="Sistema/index.php";</script>';
    } else {
        echo '<script>alert("Error al registrar. Intenta nuevamente."); window.history.back();</script>';
    }
}
?>
