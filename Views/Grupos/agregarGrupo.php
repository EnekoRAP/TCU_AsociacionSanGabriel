<?php
$errores = isset($_GET['error']) ? explode('|', $_GET['error']) : [];
$resultado = isset($_GET['success']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TCU_AsociacionSanGabriel</title>
    
    <link href="../../Assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../Assets/css/customStyles/agregarGrupoStyle.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<body>
    
    <nav>
        <?php include '../Layout/Navbars/navbar3.php' ?>        
    </nav>
    
    <main class="shadow p-4">
        <div class="container py-4">
            <div class="text-center mb-4">
                <h1 class="fw-bold">Gestión de Grupos</h1>
                <p class="lead">Agregá, editá o eliminá los grupos disponibles de la asociación</p>
            </div>

            <div class="card p-4 shadow-lg mb-5">
                <form id="formGrupo" method="POST" action="../../Controllers/grupoController.php">
                    <input type="hidden" id="id_grupo" name="id_grupo" />
                    
                    <img src="../../Assets/img/logo.png" alt="SANGABRIEL Logo" class="logo">
                    
                    <div class="mb-3">
                        <label for="codigo" class="form-label">Código del Grupo</label>
                        <input type="text" class="form-control" id="codigo" name="codigo" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="nivel" class="form-label">Nivel</label>
                        <input type="text" class="form-control" id="nivel" name="nivel" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fecha_inicio" class="form-label">Fecha de Ingreso</label>
                            <input type="date" class="form-control" id="fecha_inicio" name="fechaInicio" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="fecha_fin" class="form-label">Fecha de Salida</label>
                            <input type="date" class="form-control" id="fecha_fin" name="fechaFin" required>
                        </div>
                    </div>
                    
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="estado" id="estado" value="1">
                        <label class="form-check-label" for="estado">Grupo Activo</label>
                    </div>
                    
                    <button type="submit" class="btn btn-success w-100">Guardar Grupo</button>
                </form>
            </div>
        </div>
    </main>

    <footer>
        <?php include '../Layout/footer.php' ?>
    </footer>

    <script src="../../Assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
