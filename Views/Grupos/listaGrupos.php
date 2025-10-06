<?php
require_once("../../Config/dbconnection.php");
$cn = abrirConexion();

$resultado = $cn->query("SELECT id_grupo, codigo, nombre, descripcion, nivel, fecha_inicio, fecha_fin, estado
                         FROM tbl_grupos
                         ORDER BY id_grupo DESC");

if (!$resultado) {
    echo "Error: " . $cn->error;
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
    <link href="../../Assets/css/customStyles/listaGruposStyle.css" rel="stylesheet">
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
            <h2 class="fw-bold text-center mb-3">Lista de Grupos</h2>

            <div class="mb-3 text-end">
                <a href="../Grupos/agregarGrupo.php" class="btn btn-success">+ Agregar Grupo</a>
                <a href="exportarGruposPDF.php" class="btn btn-danger ms-2">Descargar PDF</a>
                <a href="exportarGruposExcel.php" class="btn btn-primary ms-2">Descargar Excel</a>
            </div>

            <div class="table-responsive">
                <table id="tablaGrupos" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Nivel</th>
                            <th>Fecha de Ingreso</th>
                            <th>Fecha de Salida</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($resultado && $resultado->num_rows): ?>
                            <?php while ($u = $resultado->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($u["codigo"]) ?></td>
                                    <td><?= htmlspecialchars($u["nombre"]) ?></td>
                                    <td><?= htmlspecialchars($u["descripcion"]) ?></td>
                                    <td><?= htmlspecialchars($u["nivel"]) ?></td>
                                    <td><?= htmlspecialchars($u["fecha_inicio"]) ?></td>
                                    <td><?= htmlspecialchars($u["fecha_fin"]) ?></td>
                                    <td>
                                        <span class="badge bg-<?= $u["estado"] ? 'success' : 'secondary' ?>">
                                            <?= $u["estado"] ? 'Activo' : 'Inactivo' ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a href="editarGrupo.php?id=<?= $u['id_grupo'] ?>" class="btn btn-primary btn-sm">
                                                Editar
                                            </a>
                                            <a href="eliminarGrupo.php?id=<?= $u['id_grupo'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este grupo?')">
                                                Eliminar
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center">Sin Grupos</td>
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
            $('#tablaGrupos').DataTable({
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
