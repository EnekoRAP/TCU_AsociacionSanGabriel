<?php
ini_set("display errors", 1);
error_reporting(E_ALL);

require_once("../Config/dbconnection.php");
$cn = abrirConexion();

$resultado = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $codigo = $_POST["codigo"];
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $nivel = $_POST["nivel"];
    $fechaInicio = $_POST["fechaInicio"];
    $fechaFin = $_POST["fechaFin"];
    $estado = isset($_POST["estado"]) ? 1 : 0;
}

try {
    $query = "INSERT INTO tbl_grupos
              (codigo, nombre, descripcion, nivel, fecha_inicio, fecha_fin, estado)
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $cn->prepare($query);
    $stmt->bind_param("ssssssi", $codigo, $nombre, $descripcion, $nivel, $fechaInicio, $fechaFin, $estado);
    $stmt->execute();
    $stmt->close();
        header('Location: ../Views/Grupos/listaGrupos.php?ok=1');
        exit;
} catch (Throwable $e) {
    header('Location: ../Views/Grupos/agregarGrupo.php?error=1');
    exit;
}
?>
