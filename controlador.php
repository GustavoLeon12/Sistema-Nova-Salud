<?php
if (!empty($_POST["btningresar"])) {
    if (empty($_POST["usuario"]) || empty($_POST["contraseña"])) {
        echo '<div id="errorMsg" class="alert alert-danger" role="alert">LOS CAMPOS ESTÁN VACÍOS</div>';
    } else {
        $usuario = $_POST["usuario"];
        $clave = $_POST["contraseña"];

        // IMPORTANTE: esta tabla debe llamarse "login" y tener campos "usuario" y "clave"
        $sql = $conexion->query("SELECT * FROM login WHERE usuario = '$usuario' AND contraseña = '$clave'");

        if ($datos = $sql->fetch_object()) {
            header("Location: Sistema/index.php");
            exit(); // importante para evitar seguir procesando
        } else {
            echo '<div id="errorMsg" class="alert alert-danger" role="alert">ACCESO DENEGADO</div>';
        }
    }
}
?>
