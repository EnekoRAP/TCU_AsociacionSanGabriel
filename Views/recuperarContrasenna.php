<?php
session_start();
require_once("../Config/dbconnection.php");
require_once("../Utilities/enviarCorreo.php");

$mensaje = "";
$alerta = "";

function generarCodigo($length = 8) {
    $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = [];
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < $length; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = trim($_POST["correo"] ?? '');

    if (empty($correo)) {
        $mensaje = "Debe ingresar su correo electrónico.";
        $alerta = "danger";
    } else {
        try {
            $cn = abrirConexion();

            $stmt = $cn->prepare("SELECT id_usuario, nombre FROM tbl_usuarios WHERE correo = ?");
            $stmt->bind_param("s", $correo);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado->num_rows === 1) {
                $usuario = $resultado->fetch_assoc();

                $nuevaClave = generarCodigo(8);

                $stmt = $cn->prepare("UPDATE tbl_usuarios SET contrasenna = ? WHERE id_usuario = ?");
                $stmt->bind_param("si", $nuevaClave, $usuario["id_usuario"]);
                $stmt->execute();

                $_SESSION['correoTemporal'] = $correo;

                $asunto = "Recuperación de Contraseña - Asociación San Gabriel";
                $contenido = "
                    <div style='font-family:Poppins,sans-serif;color:#333;'>
                        <h2 style='color:#1abc9c;'>Restablecimiento de contraseña</h2>
                        <p>Hola <strong>{$usuario['nombre']}</strong>,</p>
                        <p>Su nueva contraseña temporal es:</p>
                        <h3 style='color:#1abc9c;'>$nuevaClave</h3>
                        <p>Le recomendamos cambiarla al ingresar al sistema.</p>
                        <hr>
                        <p style='font-size:12px;'>© Asociación San Gabriel | Sistema de Gestión</p>
                    </div>
                ";

                enviarCorreo($asunto, $contenido, $correo);

                header("Location: cambiarContrasenna.php");
                exit();

            } else {
                $mensaje = "El correo ingresado no está registrado en el sistema.";
                $alerta = "danger";
            }
        } catch (Exception $e) {
            $mensaje = "Error al procesar la solicitud: " . $e->getMessage();
            $alerta = "danger";
        } finally {
            cerrarConexion($cn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    
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
        <div class="form-title">Recuperar Contraseña</div>
        
        <?php if ($mensaje): ?>
            <div class="alert alert-<?= $alerta ?>"><?= htmlspecialchars($mensaje) ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="mb-3 text-start">
                <label for="correo" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" name="correo" id="correo" placeholder="usuario@ejemplo.com" required>
            </div>
            
            <button type="submit" class="btn btn-login w-100">Enviar nueva contraseña</button>
            
            <div class="mt-4 small-text">
                <a href="login.php" class="mt-5 text-center under">Volver al inicio de sesión</a>
            </div>
        </form>
    </div>

</body>

</html>
