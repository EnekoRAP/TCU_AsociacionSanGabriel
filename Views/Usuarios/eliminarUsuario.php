<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION['id_rol']) || $_SESSION['id_rol'] != 1) {
    header("Location: ../login.php");
    exit();
}

require_once("../../Config/dbconnection.php");
$cn = abrirConexion();

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0) exit("ID inválido");

$query = "DELETE FROM tbl_usuarios WHERE id_usuario = ?";
$stmt = $cn->prepare($query);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    cerrarConexion($cn);
    echo '<script>
            alert("Usuario eliminado correctamente.");
            window.location.href = "listaUsuarios.php";
          </script>';
    exit;
} else {
    $error = $stmt->error;
    cerrarConexion($cn);
    exit("Error al eliminar ususario: $error");
}
?>
