<?php
require_once("../../Config/dbconnection.php");
$cn = abrirConexion();

$id = isset($_GET['id']) ? (int) $_GET['id']: 0;
if ($id <= 0)
    exit("ID Inválido");

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identificacion = trim($_POST['identificacion']);
    $nombre = trim($_POST['nombre']);
    $apellidos = trim($_POST['apellidos']);
    $fecha_nacimiento = trim($_POST['fecha_nacimiento']);
    $edad = (int) $_POST['edad'];
    $alergias = trim($_POST['alergias']);
    $medicamentos = trim($_POST['medicamentos']);
    $fecha_ingreso = trim($_POST['fecha_ingreso']);
    $encargado = trim($_POST['encargado']);
    $contacto = trim($_POST['contacto']);
    $pago = (float) $_POST['pago'];
    $id_programa = (int) $_POST['id_programa'];
    $id_grupo = (int) $_POST['id_grupo'];

    if ($identificacion === "" || $nombre === "" || $apellidos === "" || $fecha_nacimiento === "" || $edad <= 0 || $fecha_ingreso === "" || $encargado === "" || $contacto === "" || $id_programa <= 0 || $id_grupo <= 0) {
        $error = "Todos los campos son obligatorios.";
    } else {
        $query = "UPDATE tbl_beneficiarios SET identificacion = ?, nombre = ?, apellidos = ?, fecha_nacimiento = ?, edad = ?, alergias = ?, medicamentos = ?, fecha_ingreso = ?, encargado = ?, contacto = ?, pago = ?, id_programa = ?, id_grupo = ? WHERE id_beneficiario = ?";
        $stmt = $cn->prepare($query);
        $stmt->bind_param("ssssisssssiiii", $identificacion, $nombre, $apellidos, $fecha_nacimiento, $edad, $alergias, $medicamentos, $fecha_ingreso, $encargado, $contacto, $pago, $id_programa, $id_grupo, $id);

        if ($stmt->execute()) {
            cerrarConexion($cn);
            echo '<script>
                    alert("Beneficiario actualizado correctamente.");
                    window.location.href = "listaBeneficiarios.php";
                  </script>';
            exit;
        } else {
            $error = "Error al actualizar: " . $stmt->error;
        }
    }
}

$stmt = $cn->prepare("SELECT * FROM tbl_beneficiarios WHERE id_beneficiario = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
$beneficiario = $res->fetch_assoc();
if (!$beneficiario)
    exit("Beneficiario no encontrado.");

$programas = $cn->query("SELECT id_programa, nombre FROM tbl_programas");
$grupos = $cn->query("SELECT id_grupo, nombre FROM tbl_grupos");
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
    <link href="../../Assets/css/customStyles/editarBeneficiarioStyle.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>

    <nav>
        <?php '../Layout/Navbars/navbar2.php' ?>
    </nav>

    <main>
        <div class="card">
            <h3 class="text-center mb-4" style="color: #20b2aa; font-weight: 600;">
                <i class="fas fa-user-edit me-2"></i>Editar Beneficiario
            </h3>
            
            <?php if ($error): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Identificación</label>
                    <input type="text" name="identificacion" class="form-control" 
                        value="<?= htmlspecialchars($beneficiario['identificacion']) ?>" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" 
                        value="<?= htmlspecialchars($beneficiario['nombre']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Apellidos</label>
                    <input type="text" name="apellidos" class="form-control" 
                        value="<?= htmlspecialchars($beneficiario['apellidos']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="fecha_nacimiento" class="form-label">Fecha Nacimiento</label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" 
                        value="<?= htmlspecialchars($beneficiario['fecha_nacimiento']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Edad</label>
                    <input type="number" name="edad" class="form-control" 
                        value="<?= htmlspecialchars($beneficiario['edad']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alergias</label>
                    <input type="text" name="alergias" class="form-control" 
                        value="<?= htmlspecialchars($beneficiario['alergias']) ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Medicamentos</label>
                    <input type="text" name="medicamentos" class="form-control" 
                        value="<?= htmlspecialchars($beneficiario['medicamentos']) ?>">
                </div>

                <div class="mb-3">
                    <label for="fecha_ingreso" class="form-label">Fecha Ingreso</label>
                    <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" 
                        value="<?= htmlspecialchars($beneficiario['fecha_ingreso']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Encargado</label>
                    <input type="text" name="encargado" class="form-control" 
                        value="<?= htmlspecialchars($beneficiario['encargado']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Contacto</label>
                    <input type="number" name="contacto" class="form-control" 
                        value="<?= htmlspecialchars($beneficiario['contacto']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pago</label>
                    <input type="number" name="pago" class="form-control" 
                        value="<?= htmlspecialchars($beneficiario['pago']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Programa</label>
                    <select name="id_programa" class="form-select" required>
                        <?php while ($p = $programas->fetch_assoc()): ?>
                            <option value="<?= $p['id_programa'] ?>" <?= $beneficiario['id_programa'] == $p['id_programa'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($p['nombre']) ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Grupo</label>
                    <select name="id_grupo" class="form-select" required>
                        <?php while ($g = $grupos->fetch_assoc()): ?>
                            <option value="<?= $g['id_grupo'] ?>" <?= $beneficiario['id_grupo'] == $g['id_grupo'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($g['nombre']) ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="fa-solid fa-save me-1"></i> Guardar
                    </button>
                    <a href="listaBeneficiarios.php" class="btn btn-secondary">
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
