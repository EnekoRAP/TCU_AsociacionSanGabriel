<?php
require_once("../../Config/dbconnection.php");
$cn = abrirConexion();

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0)
    exit("ID Inválido");

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo = trim($_POST['codigo'] ?? '');
    $nombre = trim($_POST['nombre'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $nivel = trim($_POST['nivel'] ?? '');
    $fechaI = $_POST['fecha_inicio'] ?? null;
    $fechaF = $_POST['fecha_fin'] ?? null;
    $estado = isset($_POST['estado']) ? 1 : 0;

    if ($fechaI && $fechaF && $fechaI > $fechaF) {
        $error = "La fecha de inicio no puede ser mayor que la fecha de fin.";
    }

    if (!$error) {
        $query = "UPDATE tbl_grupos
                  SET codigo = ?, nombre = ?, descripcion = ?, nivel = ?, fecha_inicio = ?, fecha_fin = ?, estado = ?
                  WHERE id_grupo = ?";
        $stmt = $cn->prepare($query);
        $stmt->bind_param("ssssssii", $codigo, $nombre, $descripcion, $nivel, $fechaI, $fechaF, $estado, $id);

        if ($stmt->execute()) {
            echo '<script>
                    alert("El grupo se actualizó correctamente.");
                    window.location.href = "listaGrupos.php";
                  </script>';
            exit;
        } else {
            $error = "Error al actualizar: " . $stmt->error;
        }
    }
}

$stmt = $cn->prepare("SELECT id_grupo, codigo, nombre, descripcion, nivel, fecha_inicio, fecha_fin, estado
                      FROM tbl_grupos WHERE id_grupo = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
$grupo = $res->fetch_assoc();
if (!$grupo)
    exit("Grupo no encontrado.");

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
    <link href="../../Assets/css/customStyles/editarGrupoStyle.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<body>
    
    <nav>
        <?php include '../Layout/Navbars/navbar2.php' ?>
    </nav>
    
    <main>
        <div class="card">
            <div class="container mt-3">
                <h3 class="text-center mb-4" style="color: #20b2aa; font-weight: 600;">
                    <i class="fas fa-pen-to-square me-2"></i>Editar Grupo
                </h3>
                
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <form method="POST">
                    <input type="hidden" name="id_grupo" value="<?= (int) $grupo['id_grupo'] ?>">
                    
                    <div class="mb-3">
                        <label class="form-label">Código</label>
                        <input type="text" name="codigo" class="form-control" value="<?= htmlspecialchars($grupo['codigo']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($grupo['nombre']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea name="descripcion" class="form-control" rows="4"
                            required><?= htmlspecialchars($grupo['descripcion']) ?></textarea>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Nivel</label>
                            <select name="nivel" class="form-select" required>
                                <option value="">Seleccione nivel</option>
                                <option value="Pre-materno" <?= $grupo['nivel'] == 'Pre-materno' ? 'selected' : '' ?>>
                                    Pre-materno
                                </option>
                                <option value="Materno" <?= $grupo['nivel'] == 'Materno' ? 'selected' : '' ?>>
                                    Materno
                                </option>
                                <option value="Kinder" <?= $grupo['nivel'] == 'Kinder' ? 'selected' : '' ?>>
                                    Kinder
                                </option>
                                <option value="Primaria" <?= $grupo['nivel'] == 'Primaria' ? 'selected' : '' ?>>
                                    Primaria
                                </option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Fecha de Ingreso</label>
                            <input type="date" name="fecha_inicio" class="form-control"
                                value="<?= htmlspecialchars($grupo['fecha_inicio']) ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Fecha de Salida</label>
                            <input type="date" name="fecha_fin" class="form-control"
                                value="<?= htmlspecialchars($grupo['fecha_fin']) ?>">
                        </div>
                    </div>

                    <div class="form-check form-switch mt-3">
                        <input class="form-check-input" type="checkbox" id="estado" name="estado" <?= $grupo['estado'] ? 'checked' : '' ?>>
                        <label class="form-check-label" for="estado">Activo</label>
                    </div>

                    <div class="mt-4 d-flex gap-2">
                        <button class="btn btn-success" type="submit">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Guardar
                        </button>
                        <a class="btn btn-secondary" href="listaGrupos.php">
                            <i class="fa-solid fa-ban me-1"></i> Cancelar
                        </a>
                    </div>
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
