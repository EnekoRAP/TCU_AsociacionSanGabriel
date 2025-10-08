<?php
require_once("../../Config/dbconnection.php");
$cn = abrirConexion();

$identificacion = "";
$nombre = "";
$apellidos = "";
$fecha_nacimiento = "";
$edad = 0;
$alergias = "";
$medicamentos = "";
$fecha_ingreso = "";
$encargado = "";
$contacto = "";
$mensajeError = "";

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
    $programaSeleccionado = (int) $_POST['id_programa'];
    $grupoSeleccionado = (int) $_POST['id_grupo'];

    if ($identificacion === "" || $nombre === "" || $apellidos === "" || $fecha_nacimiento === "" || $edad <= 0 || $fecha_ingreso === "" || $encargado === "" || $contacto === "" || $programaSeleccionado <= 0 || $grupoSeleccionado <= 0) {
        $mensajeError = "Todos los campos son obligatorios.";
    } else {
        $query = "INSERT INTO tbl_beneficiarios 
                  (identificacion, nombre, apellidos, fecha_nacimiento, edad, alergias, medicamentos, fecha_ingreso, encargado, contacto, pago, id_programa, id_grupo)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $cn->prepare($query);
        $stmt->bind_param("ssssisssssiii", $identificacion, $nombre, $apellidos, $fecha_nacimiento, $edad, $alergias, $medicamentos, $fecha_ingreso, $encargado, $contacto, $pago, $programaSeleccionado, $grupoSeleccionado);

        if ($stmt->execute()) {
            cerrarConexion($cn);
            echo '<script>
                    alert("Beneficiario registrado correctamente.");
                    window.location.href = "listaBeneficiarios.php";
                  </script>';
        } else {
            $mensajeError = "Error al registrar: " . $stmt->error;
        }
    }
}

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
    <link href="../../Assets/css/customStyles/agregarBeneficiarioStyle.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<body>
    
    <nav>
        <?php include '../Layout/Navbars/navbar2.php' ?>
    </nav>

    <main>
        <div class="card">
            <h3 class="text-center mb-4" style="color: #20b2aa; font-weight: 600;">
                <i class="fas fa-user-plus me-2"></i>Agregar Beneficiario
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
                    <label for="fecha_nacimiento" class="form-label">Fecha Nacimiento</label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?= htmlspecialchars($fecha_nacimiento) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Edad</label>
                    <input type="number" name="edad" class="form-control" value="<?= htmlspecialchars($edad) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alergias</label>
                    <input type="text" name="alergias" class="form-control" value="<?= htmlspecialchars($alergias) ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Medicamentos</label>
                    <input type="text" name="medicamentos" class="form-control" value="<?= htmlspecialchars($medicamentos) ?>">
                </div>

                <div class="mb-3">
                    <label for="fecha_ingreso" class="form-label">Fecha Ingreso</label>
                    <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" required value="<?= htmlspecialchars($fecha_ingreso) ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Encargado</label>
                    <input type="text" name="encargado" class="form-control" value="<?= htmlspecialchars($encargado) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Contacto</label>
                    <input type="number" name="contacto" class="form-control" value="<?= htmlspecialchars($contacto) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pago</label>
                    <input type="number" name="pago" class="form-control" value="<?= htmlspecialchars($pago) ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Programa</label>
                    <select name="id_programa" class="form-select" required>
                        <option value="">
                            Seleccione un programa
                        </option>
                        <?php while ($p = $programas->fetch_assoc()): ?>
                            <option value="<?= $p['id_programa'] ?>" <?= ($programaSeleccionado ?? '') == $p['id_programa'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($p['nombre']) ?>
                        <?php endwhile; ?>
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Grupo</label>
                    <select name="id_grupo" class="form-select" required>
                        <option value="">
                            Seleccione un grupo
                        </option>
                        <?php while ($g = $grupos->fetch_assoc()): ?>
                            <option value="<?= $g['id_grupo'] ?>" <?= ($grupoSeleccionado ?? '') == $g['id_grupo'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($g['nombre']) ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="fa-solid fa-user-plus me-1"></i> Agregar
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
