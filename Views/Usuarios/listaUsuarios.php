<?php
require_once("../../Config/dbconnection.php");
$cn = abrirConexion();

$query = "SELECT u.id_usuario, u.identificacion, u.nombre, u.apellidos, u.correo, r.nombre_rol, u.estado, u.fecha_registro
          FROM tbl_usuarios u
          JOIN tbl_roles r ON u.id_rol = r.id_rol
          ORDER BY u.id_usuario DESC";

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
    <link href="../../Assets/css/customStyles/listaUsuariosStyle.css" rel="stylesheet">
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
            <h2 class="fw-bold text-center mb-3">Lista de Usuarios</h2>
            
            <div class="mb-3 text-end">
                <a href="../Usuarios/crearUsuario.php" class="btn btn-success">+ Agregar Usuario</a>
            </div>
            
            <div class="table-responsive">
                <table id="tablaUsuarios" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Identificación</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Correo</th>
                            <th>Fecha de Registro</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($resultado && $resultado->num_rows): ?>
                            <?php while ($u = $resultado->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($u['identificacion']) ?></td>
                                    <td><?= htmlspecialchars($u["nombre"]) ?></td>
                                    <td><?= htmlspecialchars($u["apellidos"]) ?></td>
                                    <td><?= htmlspecialchars($u["correo"]) ?></td>
                                    <td><?= htmlspecialchars($u["nombre_rol"]) ?></td>
                                    <td><?= $u["estado"] ? 'Activo' : 'Inactivo' ?></td>
                                    <td><?= date("d/m/y", strtotime($u["fecha_registro"])) ?></td>
                                    <td>
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a href="editarUsuario.php?id=<?= $u['id_usuario'] ?>" class="btn btn-primary btn-sm">Editar</a>
                                            <a href="eliminarUsuario.php?id=<?= $u['id_usuario'] ?>" class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Seguro que deseas eliminar este usuario?')">Eliminar</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="8" class="text-center">No hay usuarios registrados</td></tr>
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
            $('#tablaUsuarios').DataTable({
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
