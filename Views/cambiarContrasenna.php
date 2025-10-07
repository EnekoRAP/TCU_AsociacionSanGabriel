<?php
session_start();
require_once("../Config/dbconnection.php");

$mensaje = "";
$alerta = "";

$correo = $_SESSION['correoTemporal'] ?? null;

if (!$correo) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nueva = trim($_POST["nueva"] ?? '');
    $confirmar = trim($_POST["confirmar"] ?? '');

    if (empty($nueva) || empty($confirmar)) {
        $mensaje = "Debe completar todos los campos.";
        $alerta = "danger";
    } elseif ($nueva !== $confirmar) {
        $mensaje = "Las contraseñas no coinciden.";
        $alerta = "danger";
    } else {
        try {
            $cn = abrirConexion();

            $stmt = $cn->prepare("UPDATE tbl_usuarios SET contrasenna = ? WHERE correo = ?");
            $stmt->bind_param("ss", $nueva, $correo);
            $stmt->execute();

            $mensaje = "Contraseña actualizada correctamente. Redirigiendo al inicio de sesión...";
            $alerta = "success";

            unset($_SESSION['correoTemporal']);

            echo "<meta http-equiv='refresh' content='3;url=login.php'>";

        } catch (Exception $e) {
            $mensaje = "Error al cambiar la contraseña: " . $e->getMessage();
            $alerta = "danger";
        } finally {
            cerrarConexion($cn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TCU_AsociacionSanGabriel</title>

    <link href="../Assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../Assets/css/customStyles/loginStyle.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<body>

    <div class="login-container">
        <img src="../Assets/img/logo.png" alt="SANGABRIEL Logo">
        <div class="form-title">Cambiar Contraseña</div>
        
        <?php if ($mensaje): ?>
            <div class="alert alert-<?= $alerta ?>"><?= htmlspecialchars($mensaje) ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="mb-3 text-start">
                <label for="nueva" class="form-label">Nueva contraseña</label>
                <input type="password" class="form-control" name="nueva" id="nueva" required>
            </div>
            
            <div class="mb-3 text-start">
                <label for="confirmar" class="form-label">Confirmar nueva contraseña</label>
                <input type="password" class="form-control" name="confirmar" id="confirmar" required>
            </div>
            
            <button type="submit" class="btn btn-login w-100">Actualizar contraseña</button>
            <div class="mt-4 small-text">
                <a href="login.php" class="mt-5 text-center under">Volver al inicio de sesión</a>
            </div>
        </form>
    </div>

</body>

</html>
