<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION['id_rol']) || $_SESSION['id_rol'] != 1 && $_SESSION['id_rol'] != 2) {
    header("Location: ../login.php");
    exit();
}

$rol = $_SESSION['id_rol'];
?>

<nav class="navbar navbar-expand-lg navbar-light px-4">
    <a class="navbar-brand" href="../home.php">
        <img src="../../Assets/img/logo.png" alt="SANGABRIEL Logo">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
            
            <?php if ($rol == 1): ?>
                <li class="nav-item"><a class="nav-link" href="../Beneficiarios/listaBeneficiarios.php">Beneficiarios</a></li>
                <li class="nav-item"><a class="nav-link" href="../Grupos/listaGrupos.php">Grupos</a></li>
                <li class="nav-item"><a class="nav-link" href="../Programas/listaProgramas.php">Programas</a></li>
                <li class="nav-item"><a class="nav-link" href="../recomendaciones.php">Recomendaciones</a></li>
                <li class="nav-item"><a class="nav-link" href="../faqs.php">Preguntas Frecuentes</a></li>
                <li class="nav-item"><a class="nav-link" href="../Usuarios/listaUsuarios.php">Usuarios</a></li>
            <?php elseif ($rol == 2): ?>
                <li class="nav-item"><a class="nav-link" href="../Beneficiarios/listaBeneficiarios.php">Beneficiarios</a></li>
                <li class="nav-item"><a class="nav-link" href="../Grupos/listaGrupos.php">Grupos</a></li>
                <li class="nav-item"><a class="nav-link" href="../Programas/listaProgramas.php">Programas</a></li>
                <li class="nav-item"><a class="nav-link" href="../recomendaciones.php">Recomendaciones</a></li>
                <li class="nav-item"><a class="nav-link" href="../faqs.php">Preguntas Frecuentes</a></li>
            <?php endif; ?>

        </ul>
    </div>
</nav>
