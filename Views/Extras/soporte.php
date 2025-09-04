<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TCU_AsociacionSanGabriel</title>

    <link href="../../Assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../Assets/css/customStyles/soporteStyle.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<body>
    
    <nav class="navbar navbar-expand-lg navbar-light px-4">
        <a class="navbar-brand" href="home.html">
            <img src="../../Assets/img/logo.png" alt="SANGABRIEL Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                
                <li class="nav-item"><a class="nav-link" href="#">Beneficiarios</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Grupos</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Programas</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Usuarios</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Soporte</a></li>

            </ul>
        </div>
    </nav>

    <section class="page-header container">
        <h1>Sección de <span class="brand-accent">Soporte</span></h1>
        <p>Resolvemos dudas acerca del uso de nuestra aplicación web.</p>
    </section>
    
    <div class="faq-search px-3">
        <input id="searchFaq" type="text" class="form-control form-control-lg" placeholder="Buscar preguntas (ej. cuenta, contraseña, datos)…">
    </div>
    
    <div class="container">
        <div class="accordion" id="faqs"></div>
    </div>

    <footer>
        <p><strong>Provincia:</strong> Heredia </p>
        <p><strong>Cantón:</strong> Santa Bárbara </p>
        <p><strong>Distrito:</strong> Jesús </p>
        <p><strong>Dirección:</strong> 150 metros al Sur del EBAIS de Birrí </p>
        <p><strong>Teléfono:</strong> 8455 5224 </p>
        <p><strong>Correo:</strong> arcangelgabri17@outlook.com </p>
        <span>Copyright &copy; Asociación San Gabriel Formación y Cuido de Niños 2025</span>
    </footer>
    
    <script src="../../Assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    
    <script>
        const faqs = [
            ["fas fa-user-plus text-primary", "¿Cómo creo una cuenta?", "Hacé clic en 'Registrarse', completá el formulario con tus datos y confirmá tu correo electrónico."],
            ["fas fa-right-to-bracket text-success", "¿Olvidé mi contraseña, qué hago?", "Seleccioná 'Olvidé mi contraseña' en el inicio de sesión y seguí las instrucciones para restablecerla."],
            ["fas fa-gears text-warning", "¿Cómo cambio mis datos personales?", "Entrá a tu perfil en el menú superior derecho y seleccioná 'Editar perfil'."],
            ["fas fa-lock text-danger", "¿La aplicación es segura?", "Sí, usamos cifrado SSL y autenticación segura para proteger tus datos."],
            ["fas fa-cloud-upload-alt text-info", "¿Puedo subir archivos o documentos?", "Sí, desde la sección 'Mis archivos'. Se permiten formatos PDF, JPG y PNG con un máximo de 10MB."],
            ["fas fa-bell text-secondary", "¿Cómo funcionan las notificaciones?", "Podés activar o desactivar notificaciones en la sección 'Configuración' según tus preferencias."],
            ["fas fa-mobile-screen-button text-primary", "¿La aplicación tiene versión móvil?", "Sí, podés acceder desde tu navegador móvil o descargar la app en iOS y Android."],
            ["fas fa-credit-card text-success", "¿Qué métodos de pago aceptan?", "Podés pagar con tarjeta, transferencia o PayPal. También ofrecemos facturación automática."],
            ["fas fa-bug text-danger", "¿Qué hago si encuentro un error?", "Podés reportarlo desde 'Ayuda > Reportar problema' o escribirnos al correo de soporte."],
            ["fas fa-people-arrows text-warning", "¿Puedo compartir mi cuenta?", "No está permitido. Cada usuario debe tener su propia cuenta por razones de seguridad."],
            ["fas fa-headset text-info", "¿Cómo contacto al soporte técnico?", "Escribinos al chat de la aplicación, al correo soporte@app.com o llamá al 800-123-4567."],
            ["fas fa-book-open text-secondary", "¿Hay un manual de usuario?", "Sí, disponible en la sección 'Ayuda' con guías rápidas y tutoriales en video."],
            ["fas fa-language text-primary", "¿En qué idiomas está disponible?", "Actualmente en español e inglés. Podés cambiar el idioma en 'Configuración'."],
            ["fas fa-circle-question text-success", "¿Qué hago si no encuentro mi respuesta aquí?", "Podés enviarnos tu consulta en el formulario de contacto o agendar una llamada con soporte."]
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
