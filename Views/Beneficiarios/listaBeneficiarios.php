<?php 
require_once("../../Config/dbconnection.php");
$cn = abrirConexion();

$query = "SELECT b.id_beneficiario, b.identificacion, b.nombre, b.apellidos, b.fecha_nacimiento, b.edad, b.alergias, b.medicamentos, b.fecha_ingreso, b.encargado, b.contacto, b.pago, p.nombre AS nombre_programa, g.nombre AS nombre_grupo
          FROM tbl_beneficiarios b
          LEFT JOIN tbl_programas p ON b.id_programa = p.id_programa
          LEFT JOIN tbl_grupos g ON b.id_grupo = g.id_grupo
          ORDER BY b.id_beneficiario DESC";

$resultado = $cn->query($query);
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
    <link href="../../Assets/css/customStyles/listaBeneficiariosStyle.css" rel="stylesheet">
    <link href="../../Assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<body>

    <nav>
        <?php include '../Layout/Navbars/navbar2.php' ?>
    </nav>

    <main>
        <div class="card p-4 shadow-lg mb-5">
            <img src="../../Assets/img/logo.png" alt="SANGABRIEL Logo" class="logo">
            <h2 class="fw-bold text-center mb-3">Lista de Beneficiarios</h2>
            
            <div class="mb-3 text-end">
                <a href="agregarBeneficiario.php" class="btn btn-success">+ Agregar Beneficiario</a>
            </div>
            
            <div class="table-responsive">
                <table id="tablaBeneficiarios" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Identificación</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Fecha Nacimiento</th>
                            <th>Edad</th>
                            <th>Alergias</th>
                            <th>Medicamentos</th>
                            <th>Fecha Ingreso</th>
                            <th>Encargado</th>
                            <th>Contacto</th>
                            <th>Pago</th>
                            <th>Programa</th>
                            <th>Grupo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($resultado && $resultado->num_rows): ?>
                            <?php while ($u = $resultado->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($u["identificacion"]) ?></td>
                                    <td><?= htmlspecialchars($u["nombre"]) ?></td>
                                    <td><?= htmlspecialchars($u["apellidos"]) ?></td>
                                    <td><?= htmlspecialchars($u["fecha_nacimiento"]) ?></td>
                                    <td><?= htmlspecialchars($u["edad"]) ?></td>
                                    <td><?= htmlspecialchars($u["alergias"]) ?></td>
                                    <td><?= htmlspecialchars($u["medicamentos"]) ?></td>
                                    <td><?= htmlspecialchars($u["fecha_ingreso"]) ?></td>
                                    <td><?= htmlspecialchars($u["encargado"]) ?></td>
                                    <td><?= htmlspecialchars($u["contacto"]) ?></td>
                                    <td>₡<?= number_format($u["pago"], 2) ?></td>
                                    <td><?= htmlspecialchars($u["nombre_programa"]) ?></td>
                                    <td><?= htmlspecialchars($u["nombre_grupo"]) ?></td>
                                    <td>
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a href="editarBeneficiario.php?id=<?= $u['id_beneficiario'] ?>" class="btn btn-primary btn-sm">Editar</a>
                                            <a href="eliminarBeneficiario.php?id=<?= $u['id_beneficiario'] ?>" class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Seguro que deseas eliminar este beneficiario?')">Eliminar</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="14" class="text-center">No hay beneficiarios registrados</td></tr>
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
            $('#tablaBeneficiarios').DataTable({
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
