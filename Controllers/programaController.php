<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

require_once("../Config/dbconnection.php");
$cn = abrirConexion();

$resultado = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $tipo = $_POST["tipo"];
    $estado = isset($_POST["estado"]) ? 1 : 0;
}

try {
    $query = "INSERT INTO tbl_programas
              (nombre, descripcion, tipo, estado)
              VALUES (?, ?, ?, ?)";

    $stmt = $cn->prepare($query);
    $stmt->bind_param("sssi", $nombre, $descripcion, $tipo, $estado);
    $stmt->execute();
    $stmt->close();
    header('Location: ../Views/Programas/listaProgramas.php?ok=1');
    exit;
} catch (Throwable $e) {
    header('Location: ../Views/Programas/agregarPrograma.php?error=1');
    exit;
}
?>