<?php
require_once("../../Config/dbconnection.php");
$cn = abrirConexion();

$resultado = $cn->query("SELECT id_programa, nombre, descripcion, tipo, estado
                         FROM tbl_programas
                         ORDER BY id_programa DESC");

if (!$resultado) {
    echo "Error: " - $cn->error;
}

cerrarConexion($cn);
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
    <link href="../../Assets/css/customStyles/listaProgramasStyle.css" rel="stylesheet">
    <link href="../../Assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<body>

    <nav>
        <?php include '../Layout/Navbars/navbar2.php' ?>
    </nav>

   <main>
        <div class="card p-4 shadow-lg mb-5">
            <img src="../../Assets/img/logo.png" alt="SANGABRIEL Logo" class="d-block mx-auto mb-3" style="width: 150px;">
            <h2 class="fw-bold text-center mb-3">Lista de Programas</h2>

            <div class="mb-3 text-end">
                <a href="../Programas/agregarPrograma.php" class="btn btn-success">+ Agregar Programa</a>
                <a href="exportarProgramasPDF.php" class="btn btn-danger ms-2">Descargar PDF</a>
                <a href="exportarProgramasExcel.php" class="btn btn-primary ms-2">Descargar Excel</a>
            </div>

            <div class="table-responsive">
                <table id="tablaProgramas" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Tipo</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($resultado && $resultado->num_rows): ?>
                            <?php while ($u = $resultado->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($u["nombre"]) ?></td>
                                    <td><?= htmlspecialchars($u["descripcion"]) ?></td>
                                    <td><?= htmlspecialchars($u["tipo"]) ?></td>
                                    <td>
                                        <span class="badge bg-<?= $u["estado"] ? 'success' : 'secondary' ?>">
                                            <?= $u["estado"] ? 'Activo' : 'Inactivo' ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a href="editarPrograma.php?id=<?= $u['id_programa'] ?>"
                                                class="btn btn-primary btn-sm">Editar
                                            </a>
                                            <a href="eliminarPrograma.php?id=<?= $u['id_programa'] ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Seguro que deseas eliminar este programa?')">Eliminar
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">Sin programas</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <footer>
        <?php include '../Layout/footer.php' ?>
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
