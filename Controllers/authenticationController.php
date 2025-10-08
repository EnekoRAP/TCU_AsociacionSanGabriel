<?php
require_once '../Models/usuario.php';

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ../Views/login.php');
        exit;
    }

    $action = $_POST['action'] ?? '';
    $correo = trim($_POST['correo'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($action === 'login') {
        if ($correo !== '' && $password !== '' && Usuario::login($correo, $password)) {
            header('Location: ../Views/home.php');
            exit;
        } else {
            header('Location: ../Views/login.php?error=Usuario+o+clave+inválida');
            exit;
        }
    } else {
        header('Location: ../Views/login.php');
        exit;
    }
} catch (Exception $e) {
    header('Location: ../Views/login.php?error=Error+interno');
    exit;
}
?>
