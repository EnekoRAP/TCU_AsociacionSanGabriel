<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TCU_AsociacionSanGabriel</title>

    <link href="../../Assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../Assets/css/customStyles/editarGrupoStyle.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<body>
    
    <nav class="navbar navbar-expand-lg navbar-light px-4">
        <a class="navbar-brand" href="../Home/home.html">
            <img src="../../Assets/img/logo.png" alt="SANGABRIEL Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                
                <li class="nav-item"><a class="nav-link" href="#">Beneficiarios</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Grupos</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Programas</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Usuarios</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Soporte</a></li>

            </ul>
        </div>
    </nav>
    
    <main>
        <div class="card">
            <div class="container mt-3">
                <h3 class="text-center mb-4" style="color: #20b2aa; font-weight: 600;">
                    <i class="fas fa-pen-to-square me-2"></i>Editar Programa
                </h3>
                
                <div class="alert alert-danger">Error</div>

                <form method="POST">
                    <input type="hidden" name="id_programa" value="">

                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea name="descripcion" class="form-control" rows="4" required></textarea>
                    </div>

                    <div class="form-check form-switch mt-3">
                        <input class="form-check-input" type="checkbox" id="estado" name="estado">
                        <label class="form-check-label" for="estado">Activo</label>
                    </div>

                    <div class="mt-4 d-flex gap-2">
                        <button class="btn btn-success" type="submit">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Guardar
                        </button>
                        <a class="btn btn-secondary" href="#">
                            <i class="fa-solid fa-ban me-1"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer>
        <p><strong>Provincia:</strong> Heredia </p>
        <p><strong>Cantón:</strong> Santa Bárbara </p>
        <p><strong>Distrito:</strong> Jesús </p>
        <p><strong>Dirección:</strong> 150 metros al Sur del EBAIS de Birrí </p>
        <p><strong>Teléfono:</strong> 8455 5224 </p>
        <p><strong>Correo:</strong> arcangelgabri17@outlook.com </p>
        <span>Copyright &copy; Asociación San Gabriel Formación y Cuido de Niños 2025</span>
    </footer>

    <script src="../../Assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
