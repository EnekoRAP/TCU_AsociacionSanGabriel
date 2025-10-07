<?php
session_start();
require_once("../Config/dbconnection.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = trim($_POST["correo"] ?? '');
    $clave = trim($_POST["contrasenna"] ?? '');

    try {
        $cn = abrirConexion();

        $stmt = $cn->prepare("SELECT id_usuario, identificacion, nombre, apellidos, correo, contrasenna, estado
                              FROM tbl_usuarios
                              WHERE correo = ?");
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $usuario = $resultado->fetch_assoc();

            if ($clave === trim($usuario["contrasenna"])) {
                if ($usuario["estado"] == 1) {
                    $_SESSION["nombreUsuario"] = $usuario["nombre"];
                    $_SESSION["idUsuario"] = $usuario["id_usuario"];
                    header("Location: ../Views/home.php");
                    exit();
                } else {
                    header("Location: ../Views/login.php?error=2");
                    exit();
                }
            }
        }

        header("Location: ../Views/login.php?error=1");
        exit();

    } catch (Exception $e) {
        error_log("Error al iniciar sesión: " . $e->getMessage());
        header("Location: ../Views/login.php?error=1");
        exit();
    } finally {
        if (isset($cn)) {
            cerrarConexion($cn);
        }
    }
} else {
    header("Location: ../Views/login.php");
    exit();
}
?>
