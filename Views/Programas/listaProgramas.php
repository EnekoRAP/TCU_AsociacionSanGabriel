<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TCU_AsociacionSanGabriel</title>

    <link href="../../Assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../Assets/css/customStyles/listaProgramasStyle.css" rel="stylesheet">
    <link href="../../Assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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
        <div class="card p-4 shadow-lg mb-5">
            <img src="../../Assets/img/logo.png" alt="SANGABRIEL Logo" class="d-block mx-auto mb-3" style="width: 150px;">
            <h2 class="fw-bold text-center mb-3">Lista de Programas</h2>

            <div class="mb-3 text-end">
                <a href="../Programas/agregarPrograma.php" class="btn btn-success">+ Agregar Programa</a>
            </div>

            <div class="table-responsive">
                <table id="tablaProgramas" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>PANI</td>
                            <td>Niños con ezcasos recursos</td>
                            <td>
                                <span class="">
                                    Activo
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="../Programas/editarPrograma.php" class="btn btn-primary btn-sm">Editar</a>
                                    <a href="#" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este programa?')">Eliminar</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-center">Sin grupos</td>
                        </tr>
                    </tbody>
                </table>
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

    <script src="../../Assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="../../Assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../Assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../Assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#tablaProgramas').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/2.1.8/i18n/es-ES.json', 
                },
                responsive: true,
                pageLength: 5
            });
        });
    </script>
    
</body>

</html>
