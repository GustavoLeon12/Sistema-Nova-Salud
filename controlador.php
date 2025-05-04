<?php
if (!empty($_POST["btningresar"])) {
    if (empty($_POST["usuario"]) || empty($_POST["contraseña"])) {
        echo '<div id="errorMsg" class="alert alert-danger" role="alert">LOS CAMPOS ESTÁN VACÍOS</div>';
    } else {
        $usuario = $_POST["usuario"];
        $clave = $_POST["contraseña"];

        // Consulta segura con sentencia preparada
        $stmt = $conexion->prepare("SELECT * FROM login WHERE usuario = ? AND contraseña = ?");
        $stmt->bind_param("ss", $usuario, $clave); // "ss" indica dos strings
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            
            header("Location: Sistema/index.php");
            exit();
        } else {
            echo '<div id="errorMsg" class="alert alert-danger" role="alert">ACCESO DENEGADO</div>';
        }

        $stmt->close();
    }
}
?>
