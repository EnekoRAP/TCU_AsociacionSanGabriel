<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TCU_AsociacionSanGabriel</title>

    <link href="../Assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../Assets/css/customStyles/recomendaciones.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>

    <nav>
        <?php include 'Layout/Navbars/navbar4.php' ?>
    </nav>
    
    <main>
        <section class="page-header container">
            <h1>Consejos y <span class="brand-accent">Recomendaciones</span></h1>
            <p>Estos son algunos consejos y buenas prácticas para el uso del sistema de gestión de la Asociación.</p>
        </section>
        
        <div class="container">
            <div class="accordion" id="accordionRecomendaciones">
                
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#rec0">
                        <i class="fas fa-user-lock me-2 text-primary"></i> Recomendaciones de autenticación y seguridad
                    </button>
                </h2>
                <div id="rec0" class="accordion-collapse collapse" data-bs-parent="#accordionRecomendaciones">
                    <div class="accordion-body">
                        Usar credenciales seguras y no compartir la contraseña.<br>
                        Verificar el estado del usuario antes de intentar iniciar sesión.<br>
                        Roles como “master” y “administrador” tienen diferentes permisos, asegúrese de usarlos correctamente.<br>
                        Cerrar sesión al finalizar el uso.
                    </div>
                </div>
            </div>
            
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#rec1">
                        <i class="fas fa-users-cog me-2 text-danger"></i> Recomendaciones para la gestión de usuarios y roles
                    </button>
                </h2>
                <div id="rec1" class="accordion-collapse collapse" data-bs-parent="#accordionRecomendaciones">
                    <div class="accordion-body">
                        El rol “master” es el único autorizado para crear, editar o eliminar usuarios.<br>
                        Asignar siempre un rol definido a cada usuario para evitar restricciones de acceso.<br>
                        Evitar duplicar nombres de roles al crearlos.<br>
                        Validar permisos antes de asignar funciones críticas.
                    </div>
                </div>
            </div>
            
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#rec2">
                        <i class="fas fa-child me-2 text-warning"></i> Recomendaciones para la gestión de beneficiarios
                    </button>
                </h2>
                <div id="rec2" class="accordion-collapse collapse" data-bs-parent="#accordionRecomendaciones">
                    <div class="accordion-body">
                        Ingresar todos los datos requeridos del beneficiario de forma completa.<br>
                        Validar que la cédula no esté duplicada antes de registrar.<br>
                        Mantener la información médica actualizada (alergias, medicamentos).<br>
                        Consultar y filtrar datos para una búsqueda más eficiente.
                    </div>
                </div>
            </div>
            
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#rec3">
                        <i class="fas fa-layer-group me-2 text-info"></i> Recomendaciones para programas y grupos
                    </button>
                </h2>
                <div id="rec3" class="accordion-collapse collapse" data-bs-parent="#accordionRecomendaciones">
                    <div class="accordion-body">
                        Cada grupo debe estar vinculado a un programa existente.<br>
                        Antes de eliminar un programa o grupo, verificar que no tenga beneficiarios asignados.<br>
                        Revisar periódicamente la lista de beneficiarios en cada programa y grupo.<br>
                        Actualizar los cambios cuando se reasigna un beneficiario.
                    </div>
                </div>
            </div>
            
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#rec4">
                        <i class="fas fa-file-alt me-2 text-success"></i> Recomendaciones para reportes y auditoría
                    </button>
                </h2>
                <div id="rec4" class="accordion-collapse collapse" data-bs-parent="#accordionRecomendaciones">
                    <div class="accordion-body">
                        Generar reportes filtrando por programa, grupo o rango de fechas para mayor precisión.<br>
                        Exportar los reportes en PDF o Excel según la necesidad de uso.<br>
                        Revisar los registros de errores para identificar problemas y patrones.<br>
                        Consultar auditorías por usuario o fecha para un mejor control del sistema.
                    </div>
                </div>
            </div>
        
        </div>
    </div>
</main>

    <footer>
        <?php include 'Layout/footer.php' ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
