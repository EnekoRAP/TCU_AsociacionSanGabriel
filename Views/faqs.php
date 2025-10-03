<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TCU_AsociacionSanGabriel</title>

    <link href="../Assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../Assets/css/customStyles/faqsStyle.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<body>
    
    <nav>
        <?php include 'Layout/Navbars/navbar4.php' ?>
    </nav>
    
    <section class="page-header container">
        <h1>Preguntas <span class="brand-accent">Frecuentes</span></h1>
        <p>Resolvemos dudas sobre el uso del sistema: autenticación, gestión de usuarios, beneficiarios, programas, reportes y más.</p>
    </section>
    
    <div class="faq-search px-3">
        <input id="searchFaq" type="text" class="form-control form-control-lg"
        placeholder="Buscar preguntas (ej. usuarios, beneficiarios, reportes)…">
    </div>
    
    <div class="container">
        <div class="accordion" id="faqs"></div>
    </div>

    <footer>
        <?php include 'Layout/footer.php' ?>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        const faqs = [
            ["fas fa-user-lock text-primary", "¿Cómo inicio sesión en el sistema?", "Debés ingresar tu correo electrónico y contraseña registrados. Si tus credenciales son correctas y tu usuario está activo, podrás acceder."],
            ["fas fa-ban text-danger", "¿Qué hago si no puedo ingresar?", "Puede ser por credenciales inválidas o porque tu usuario está inactivo. Contactá al administrador o master para verificar tu estado."],
            ["fas fa-users-cog text-info", "¿Quién puede crear y gestionar usuarios?", "Solo los usuarios con rol 'master' pueden crear, editar o eliminar usuarios. Los administradores no tienen acceso a esta función."],
            ["fas fa-user-shield text-warning", "¿Qué diferencia hay entre un rol master y un rol administrador?", "El rol master tiene acceso completo, incluyendo gestión de usuarios y roles. El rol administrador gestiona beneficiarios, programas, grupos y reportes, pero no usuarios."],
            ["fas fa-id-card text-secondary", "¿Cómo registro un nuevo beneficiario?", "Completá el formulario con datos personales, médicos y administrativos. Recordá que la cédula debe ser única y validada por el sistema."],
            ["fas fa-calendar-check text-success", "¿La edad del beneficiario se calcula automáticamente?", "Sí. El sistema calcula la edad con base en la fecha de nacimiento registrada, evitando errores manuales."],
            ["fas fa-layer-group text-primary", "¿Cómo funcionan los programas y grupos?", "Primero se registra un programa. Luego se crean grupos vinculados a ese programa, donde se asignan los beneficiarios."],
            ["fas fa-file-alt text-info", "¿Cómo genero un reporte de beneficiarios?", "Podés generar reportes filtrando por programa, grupo o rango de fechas de ingreso. Los resultados se muestran en pantalla."],
            ["fas fa-download text-success", "¿En qué formatos puedo exportar los reportes?", "Los reportes pueden exportarse en PDF o Excel para impresión, archivo o envío."],
            ["fas fa-exclamation-triangle text-danger", "¿El sistema registra los errores?", "Sí. Todo error de operación inválida queda registrado con usuario, fecha y detalle para efectos de auditoría."],
            ["fas fa-search text-warning", "¿Se pueden consultar los errores registrados?", "Los usuarios con rol master pueden consultar errores filtrando por usuario o fecha. Esto permite identificar patrones y corregir fallos."]
        ]; 

        const container = document.getElementById("faqs");
        faqs.forEach((faq, i) => {
            const item = document.createElement("div");
            item.className = "accordion-item";
            item.innerHTML = `
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq${i}">
                        <i class="${faq[0]} me-2"></i> ${faq[1]}
                    </button>
                </h2>
                <div id="faq${i}" class="accordion-collapse collapse" data-bs-parent="#faqs">
                    <div class="accordion-body">
                    ${faq[2]}
                    </div>
                </div>
            `;
            container.appendChild(item);
        });
        
        document.getElementById("searchFaq").addEventListener("input", function () {
            const term = this.value.toLowerCase();
            document.querySelectorAll(".accordion-item").forEach(item => {
                const text = item.innerText.toLowerCase();
                item.style.display = text.includes(term) ? "" : "none";
            });
        });
    </script>

</body>

</html>
