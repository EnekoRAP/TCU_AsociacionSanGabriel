<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TCU_AsociacionSanGabriel</title>

    <link href="../../Assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../Assets/css/customStyles/agregarProgramaStyle.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<body>
    
    <nav class="navbar navbar-expand-lg navbar-light px-4">
        <a class="navbar-brand" href="../Home/home.html">
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
    
    <main class="shadow p-4">
        <div class="container py-4">
            <div class="text-center mb-4">
                <h1 class="fw-bold">Gestión de Grupos</h1>
                <p class="lead">Agregá, editá o eliminá los programas disponibles de la asociación</p>
            </div>

            <div class="card p-4 shadow-lg mb-5">
                <form id="formGrupo" method="POST" action="">
                    <input type="hidden" id="id_grupo" name="id_grupo" />
                    
                    <img src="../../Assets/img/logo.png" alt="SANGABRIEL Logo" class="logo">
                    
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                    </div>
                    
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="estado" id="estado" value="1">
                        <label class="form-check-label" for="estado">Grupo Activo</label>
                    </div>
                    
                    <button type="submit" class="btn btn-success w-100">Guardar Programa</button>
                </form>
            </div>
        </div>
    </main>

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
        let programas = JSON.parse(localStorage.getItem('programas')) || [];
        
        function renderProgramas() {
            const tbody = document.getElementById(tablaProgramas);
            tbody.innerHTML = '';
            programas.array.forEach((p, i) => {
                const row = `
                    <tr>
                        <td>${p.Nombre}</td>
                        <td>${p.Descripcion}</td>
                        <td>${p.Estado ? 'Sí' : 'No'}</td>
                        <td>
                            <button onclick="editarPrograma(${i})">Editar</button>
                            <button onclick="borrarPrograma(${i})">Eliminar</button>
                        </td>
                    </tr>
                `;
                tbody.innerHTML += row;
            });
        }
        
        document.getElementById('formPrograma').addEventListener('submit', e => {
            e.preventDefault();
            const id = document.getElementById('ProgramaID').value;
            const programa = {
                Nombre: document.getElementById('Nombre').value,
                Descripcion: document.getElementById('Descripcion').value,
                Estado: document.getElementById('Estado').checked
            };
            
            if (id == '') {
                programas.push(programa);
            } else {
                programas[id] = programa;
            }
            localStorage.setItem('programas', JSON.stringify(programas));
            renderProgramas();
            e.target.reset();
        });
        
        function editarPrograma(index) {
            const p = programas[index];
            document.getElementById('ProgramaID').value = index;
            document.getElementById('Nombre').value = p.Nombre;
            document.getElementById('Descripcion').value = p.Descripcion;
            document.getElementById('Estado').checked = p.Estado;
        }
        
        function borrarPrograma(index) {
            programas.splice(index, 1);
            localStorage.setItem('programas', JSON.stringify(programas));
            renderProgramas();
        }
        
        renderProgramas();
    </script>

</body>

</html>
