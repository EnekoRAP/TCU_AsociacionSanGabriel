<?php
function abrirConexion() {
    $host = "localhost";
    $user = "root";
    $password = "KeebleMayen26";
    $db = "bd_sangabriel";

    $conn = new mysqli($host, $user, $password, $db);

    if ($conn->connect_error) {
        throw new Exception("Error de conexión a la base de datos: " . $conn->connect_error);
    }

    $conn->set_charset("utf8mb4");

    return $conn;
}

function cerrarConexion($conn) {
    if ($conn instanceof mysqli) {
        $conn->close();
    }
}
?>
