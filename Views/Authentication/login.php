<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TCU_AsociacionSanGabriel</title>

    <link href="../../Assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../Assets/css/customStyles/loginStyle.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<body>

    <div class="login-container">
        <img src="../../Assets/img/logo.png" alt="SANGABRIEL Logo">
        <div class="form-title">Iniciar Sesión</div>

        <div class="alert alert-danger">Usuario o clave inválida</div>

        <form action="#" method="POST">
            <input type="hidden" name="action" value="login">

            <div class="mb-3 text-start">
        <label for="correo" class="form-label">Correo electrónico</label>
        <input type="email" class="form-control" name="correo" id="correo" placeholder="usuario@ejemplo.com" required>
      </div>

      <div class="mb-3 text-start">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" class="form-control" name="password" id="password" required>
      </div>

      <button type="submit" class="btn btn-login w-100">Ingresar</button>
        </form>
    </div>

</body>

</html>