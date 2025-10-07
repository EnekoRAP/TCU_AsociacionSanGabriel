<?php
require_once("../../Config/dbconnection.php");
$cn = abrirConexion();

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0)
    exit("ID inválido");

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identificacion = trim($_POST['identificacion']);
    $nombre = trim($_POST['nombre']);
    $apellidos = trim($_POST['apellidos']);
    $correo = trim($_POST['correo']);
    $id_rol = (int) $_POST['id_rol'];
    $estado = isset($_POST['estado']) ? 1 : 0;

    if ($identificacion === "" || $nombre === "" || $apellidos === "" || $correo === "" || $id_rol <= 0) {
        $error = "Todos los campos son obligatorios. ";
    } else {
        $query = "UPDATE tbl_usuarios SET identificacion = ?, nombre = ?, apellidos = ?, correo = ?, id_rol = ?, estado = ? WHERE id_usuario = ?";
        $stmt = $cn->prepare($query);
        $stmt->bind_param("ssssiii", $identificacion, $nombre, $apellidos, $correo, $id_rol, $estado, $id);

        if ($stmt->execute()) {
            cerrarConexion($cn);
            echo '<script>
                    alert("Usuario actualizado correctamente.");
                    window.location.href = "listaUsuarios.php";
                  </script>';
            exit;
        } else {
            $error = "Error al actualizar: " . $stmt->error;
        }
    }
}

$stmt = $cn->prepare("SELECT * FROM tbl_usuarios WHERE id_usuario = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
$usuario = $res->fetch_assoc();
if (!$usuario)
    exit("Usuarios no encontrado. ");

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
    <link href="../../Assets/css/customStyles/editarUsuarioStyle.css" rel="stylesheet">
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
                <i class="fas fa-user-edit me-2"></i>Editar Usuario
            </h3>
            
            <?php if ($error): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">Identificación</label>
                    <input type="text" name="identificacion" class="form-control" 
                        value="<?= htmlspecialchars($usuario['identificacion']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" 
                        value="<?= htmlspecialchars($usuario['nombre']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Apellidos</label>
                    <input type="text" name="apellidos" class="form-control" 
                        value="<?= htmlspecialchars($usuario['apellidos']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Correo</label>
                    <input type="email" name="correo" class="form-control" 
                        value="<?= htmlspecialchars($usuario['correo']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Rol</label>
                    <select name="id_rol" class="form-select" required>
                        <?php while ($r = $roles->fetch_assoc()): ?>
                            <option value="<?= $r['id_rol'] ?>" <?= $usuario['id_rol'] == $r['id_rol'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($r['nombre_rol']) ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-check form-switch mb-4">
                    <input class="form-check-input" type="checkbox" name="estado" id="estado" <?= $usuario['estado'] ? 'checked' : '' ?>>
                    <label class="form-check-label" for="estado">Activo</label>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="fa-solid fa-save me-1"></i> Guardar
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
