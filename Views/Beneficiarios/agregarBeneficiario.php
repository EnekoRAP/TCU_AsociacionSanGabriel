<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TCU_AsociacionSanGabriel</title>

    <link href="../../Assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../Assets/css/customStyles/agregarBeneficiarioStyle.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<body>
    
    <nav class="navbar navbar-expand-lg navbar-light px-4">
        <a class="navbar-brand" href="../Home/home.php">
            <img src="../../Assets/img/logo.png" alt="SANGABRIEL Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                
                <li class="nav-item"><a class="nav-link" href="../Beneficiarios/listaBeneficiarios.php">Beneficiarios</a></li>
                <li class="nav-item"><a class="nav-link" href="../Grupos/listaGrupos.php">Grupos</a></li>
                <li class="nav-item"><a class="nav-link" href="../Programas/listaProgramas.php">Programas</a></li>
                <li class="nav-item"><a class="nav-link" href="../Usuarios/listaUsuarios.php">Usuarios</a></li>
                <li class="nav-item"><a class="nav-link" href="../Extras/soporte.php">Soporte</a></li>

            </ul>
        </div>
    </nav>

    <main>
        <div class="card">
            <h3 class="text-center mb-4" style="color: #20b2aa; font-weight: 600;">
                <i class="fas fa-user-plus me-2"></i>Agregar Beneficiario
            </h3>
            
            <div class="alert alert-danger">Error</div>
            
            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">Identificación</label>
                    <input type="text" name="identificacion" class="form-control" value="" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Apellidos</label>
                    <input type="text" name="apellidos" class="form-control" value="" required>
                </div>

                <div class="mb-3">
                    <label for="fecha_nacimiento" class="form-label">Fecha Nacimiento</label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required value="">
                </div>

                <div class="mb-3">
                    <label class="form-label">Edad</label>
                    <input type="number" name="edad" class="form-control" value="" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Género</label>
                    <select name="genero" class="form-select" required>
                        <option value="">
                            Seleccione un rol
                        </option>
                        <option value="">
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alergias</label>
                    <input type="text" name="alergias" class="form-control" value="" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Medicamentos</label>
                    <input type="text" name="medicamentos" class="form-control" value="" required>
                </div>

                <div class="mb-3">
                    <label for="fecha_ingreso" class="form-label">Fecha Ingreso</label>
                    <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" required value="">
                </div>

                <div class="mb-3">
                    <label class="form-label">Encargado</label>
                    <input type="text" name="encargado" class="form-control" value="" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Contacto</label>
                    <input type="number" name="contacto" class="form-control" value="" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pago</label>
                    <input type="number" name="pago" class="form-control" value="" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Programa</label>
                    <select name="id_programa" class="form-select" required>
                        <option value="">
                            Seleccione un programa
                        </option>
                        <option value="">
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Grupo</label>
                    <select name="id_grupo" class="form-select" required>
                        <option value="">
                            Seleccione un grupo
                        </option>
                        <option value="">
                        </option>
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="fa-solid fa-user-plus me-1"></i> Editar
                    </button>
                    <a href="../Beneficiarios/listaBeneficiarios.php" class="btn btn-secondary">
                        <i class="fa-solid fa-ban me-1"></i> Cancelar
                    </a>
                </div>

            </form>
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
