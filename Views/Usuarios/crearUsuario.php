<?php
require_once("../../Config/dbconnection.php");
$cn = abrirConexion();

$identificacion = "";
$nombre = "";
$apellidos = "";
$correo = "";
$contrasenna = "";
$estado = 1;
$mensajeError = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identificacion = trim($_POST['identificacion']);
    $nombre = trim($_POST['nombre']);
    $apellidos = trim($_POST['apellidos']);
    $correo = trim($_POST['correo']);
    $contrasenna = trim($_POST['contrasenna']);
    $rolSeleccionado = (int) $_POST['id_rol'];
    $estado = isset($_POST['estado']) ? 1 : 0;
    $fecha = date('Y-m-d H:i:s');

    if ($identificacion === "" || $nombre === "" || $apellidos === "" || $correo === "" || $contrasenna === "" || $rolSeleccionado <= 0) {
        $mensajeError = "Todos los campos son obligatorios. ";
    } else {
        $query = "INSERT INTO tbl_usuarios (identificacion, nombre, apellidos, correo, contrasenna, id_rol, estado, fecha_registro)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $cn->prepare($query);
        $stmt->bind_param("sssssiis", $identificacion, $nombre, $apellidos, $correo, $contrasenna, $rolSeleccionado, $estado, $fecha);

        if ($stmt->execute()) {
            cerrarConexion($cn);
            echo '<script>
                    alert("Usuario registrado correctamente.");
                    window.location.href = "listaUsuarios.php";
                  </script>';
            exit;
        } else {
            $mensajeError = "Error al registrar el usuario: " . $stmt->error;
        }
    }
}

$roles = $cn->query("SELECT id_rol, nombre_rol FROM tbl_roles");
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
    <link href="../../Assets/css/customStyles/crearUsuarioStyle.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<body>
    
    <nav>
        <?php include '../Layout/Navbars/navbar2.php'; ?>
    </nav>

    <main>
        <div class="card">
            <h3 class="text-center mb-4" style="color: #20b2aa; font-weight: 600;">
                <i class="fas fa-user-plus me-2"></i>Registrar Usuario
            </h3>
            
            <?php if ($mensajeError): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($mensajeError) ?></div>
            <?php endif; ?>
            
            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">Identificación</label>
                    <input type="text" name="identificacion" class="form-control" value="<?= htmlspecialchars($identificacion) ?>" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($nombre) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Apellidos</label>
                    <input type="text" name="apellidos" class="form-control" value="<?= htmlspecialchars($apellidos) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Correo</label>
                    <input type="email" name="correo" class="form-control" value="<?= htmlspecialchars($correo) ?>" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="contrasenna" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Rol</label>
                    <select name="id_rol" class="form-select" required>
                        <option value="">
                            Seleccione un rol
                        </option>
                        <?php while ($r = $roles->fetch_assoc()): ?>
                            <option value="<?= $r['id_rol'] ?>" <?= ($rolSeleccionado ?? '') == $r['id_rol'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($r['nombre_rol']) ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                
                <div class="form-check form-switch mb-4">
                    <input class="form-check-input" type="checkbox" name="estado" id="estado" <?= $estado ? 'checked' : '' ?>>
                    <label class="form-check-label" for="estado">Activo</label>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="fa-solid fa-user-plus me-1"></i> Registrar
                    </button>
                    <a href="listaUsuarios.php" class="btn btn-secondary">
                        <i class="fa-solid fa-ban me-1"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </main>

    <footer>
        <?php include '../Layout/footer.php' ?>
    </footer>

    <script src="../../Assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
