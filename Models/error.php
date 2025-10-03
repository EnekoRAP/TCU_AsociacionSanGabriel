<?php

function registrarError($mensaje, $nivel = "ERROR", $modulo = null, $usuario = null) {
    date_default_timezone_set("America/Costa_Rica");

    $fecha = date("Y-m-d");
    $hora = date("H:i:s");

    if ($modulo === null) {
        $modulo = basename($_SERVER['PHP_SELF']);
    }

    if ($usuario === null) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $usuario = $_SESSION['nombreUsuario'] ?? $_SESSION['nombre'] ?? "Invitado";
    }

    $cadena = "[$fecha $hora] [$nivel] $mensaje | Módulo: $modulo | Usuario: $usuario" . PHP_EOL;

    $ruta = __DIR__ . "/../Logs/errorLog.txt";
    file_put_contents($ruta, $cadena, FILE_APPEND);
}

?>