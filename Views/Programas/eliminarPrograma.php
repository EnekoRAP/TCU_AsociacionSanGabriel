<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("../../Config/dbconnection.php");
$cn = abrirConexion();

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    exit("ID Inválido");
}

$query = "DELETE FROM tbl_programas WHERE id_programa = ?";
$stmt = $cn->prepare($query);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    cerrarConexion($cn);
    echo '<script>
            alert("El programa se eliminó correctamente.");
            window.location.href = "listaProgramas.php";
          </script>';
    exit;
} else {
    $error = $stmt->error;
    cerrarConexion($cn);
    exit("Error al emliminar: $error");
}
?>
