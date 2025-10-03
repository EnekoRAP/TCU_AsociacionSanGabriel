CREATE DATABASE bd_sangabriel;

USE bd_sangabriel;

CREATE TABLE tbl_roles (
    id_rol INT AUTO_INCREMENT PRIMARY KEY,
    nombre_rol VARCHAR(50) NOT NULL
);

CREATE TABLE tbl_usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    identificacion VARCHAR(15) UNIQUE NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    correo VARCHAR(100) UNIQUE NOT NULL,
    contrasenna VARCHAR(255) NOT NULL,
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP,
    id_rol INT,
    estado BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (id_rol) REFERENCES tbl_roles(id_rol)
);

CREATE TABLE tbl_grupos (
    id_grupo INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(10) NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    descripcion TEXT,
    nivel VARCHAR(50),
    fecha_inicio DATE,
    fecha_fin DATE,
    estado BOOLEAN DEFAULT TRUE
);

CREATE TABLE tbl_programas (
    id_programa INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    descripcion TEXT,
    tipo VARCHAR(50),
    estado BOOLEAN DEFAULT TRUE
);

CREATE TABLE tbl_beneficiarios (
    id_beneficiario INT AUTO_INCREMENT PRIMARY KEY,
    identificacion VARCHAR(15) NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    edad INT NOT NULL,
    alergias VARCHAR(100),
    medicamentos VARCHAR(100),
    fecha_ingreso DATE NOT NULL,
    encargado VARCHAR(100) NOT NULL,
    contacto VARCHAR(50) NOT NULL,
    pago DECIMAL(10,2),
    id_programa INT,
    id_grupo INT,
    FOREIGN KEY (id_programa) REFERENCES tbl_programas(id_programa),
    FOREIGN KEY (id_grupo) REFERENCES tbl_grupos(id_grupo)
);

CREATE TABLE tbl_auditoria (
    id_error INT AUTO_INCREMENT PRIMARY KEY,
    accion VARCHAR(100),
    origen VARCHAR(250),
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    mensaje TEXT,
    id_usuario INT,
    FOREIGN KEY (id_usuario) REFERENCES tbl_usuarios(id_usuario)
);

INSERT INTO tbl_roles (nombre_rol) VALUES
('Master'),
('Admin');

INSERT INTO tbl_usuarios (identificacion, nombre, apellidos, correo, contrasenna, fecha_registro, id_rol) VALUES
('208600279', 'Cristopher', 'Rodríguez Fernández', 'crodriguez@gmail.com', 'Cris1204', '2025-09-19', 1);

INSERT INTO tbl_grupos (codigo, nombre, descripcion, nivel, fecha_inicio, fecha_fin) VALUES
('G001', 'Oruguitas', 'Niños de 1 año en adelante.', 'Pre-materno', '2025-01-05', '2025-11-29');

INSERT INTO tbl_programas (nombre, descripcion, tipo) VALUES
('PANI', 'Institución autónoma que protege y garantiza los derechos de la niñez y adolescencia en Costa Rica.', 'Público');

INSERT INTO tbl_beneficiarios (identificacion, nombre, apellidos, fecha_nacimiento, edad, alergias, medicamentos, fecha_ingreso, encargado, contacto, pago, id_programa, id_grupo) VALUES
('403000564', 'Santiago', 'Hidalgo Molina', '2012-12-20', 13, 'Asma', 'Bomba de Salbutamol', '2023-05-08', 'Katherine Molina Sánchez', '8612-1617', 40000.00, 1, 1);