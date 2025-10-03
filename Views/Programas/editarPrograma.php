<?php 
require_once("../../Config/dbconnection.php");
$cn = abrirConexion();

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0)
    exit("ID Inválido");

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $tipo = trim($_POST['tipo'] ?? '');
    $estado = isset($_POST['estado']) ? 1 : 0;

    if (!$error) {
        $query = "UPDATE tbl_programas
                  SET nombre = ?, descripcion = ?, tipo = ?, estado = ?
                  WHERE id_programa = ?";
        $stmt = $cn->prepare($query);
        $stmt->bind_param("sssii", $nombre, $descripcion, $tipo, $estado, $id);

        if ($stmt->execute()) {
            echo '<script>
                    alert("El programa se actualizó correctamente.");
                    window.location.href = "listaProgramas.php";
                  </script>';
            exit;
        } else {
            $error = "Error al actualizar: " . $stmt->error;
        }
    }
}

$stmt = $cn->prepare("SELECT id_programa, nombre, descripcion, tipo, estado
                      FROM tbl_programas WHERE id_programa = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
$programa = $res->fetch_assoc();
if (!$programa)
    exit("Porgrama no encontrado.");

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
                    <i class="fas fa-pen-to-square me-2"></i>Editar Programa
                </h3>
                
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <form method="POST">
                    <input type="hidden" name="id_programa" value="<?= (int) $programa['id_programa'] ?>">

                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" 
                        value="<?= htmlspecialchars($programa['nombre']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea name="descripcion" class="form-control" rows="4" 
                        required><?= htmlspecialchars($programa['descripcion']) ?></textarea>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Tipo</label>
                            <select name="tipo" class="form-select" required>
                                <option value="">Seleccione tipo</option>
                                <option value="Publico" <?= $programa['tipo'] == 'Publico' ? 'selected' : '' ?>>
                                    Público
                                </option>
                                <option value="Privado" <?= $programa['tipo'] == 'Privado' ? 'selected' : '' ?>>
                                    Privado
                                </option>
                                <option value="Mixto" <?= $programa['tipo'] == 'Mixto' ? 'selected' : '' ?>>
                                    Mixto
                                </option>
                                <option value="ONG" <?= $programa['tipo'] == 'ONG' ? 'selected' : '' ?>>
                                    ONG
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-check form-switch mt-3">
                        <input class="form-check-input" type="checkbox" id="estado" name="estado" <?= $programa['estado'] ? 'checked' : '' ?>>
                        <label class="form-check-label" for="estado">Activo</label>
                    </div>

                    <div class="mt-4 d-flex gap-2">
                        <button class="btn btn-success" type="submit">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Guardar
                        </button>
                        <a class="btn btn-secondary" href="listaProgramas.php">
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
