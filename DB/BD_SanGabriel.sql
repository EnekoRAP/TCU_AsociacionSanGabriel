-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-10-2025 a las 22:41:56
-- Versión del servidor: 8.0.35
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_sangabriel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_auditoria`
--

CREATE TABLE `tbl_auditoria` (
  `id_error` int NOT NULL,
  `accion` varchar(100) DEFAULT NULL,
  `origen` varchar(250) DEFAULT NULL,
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP,
  `mensaje` text,
  `id_usuario` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_beneficiarios`
--

CREATE TABLE `tbl_beneficiarios` (
  `id_beneficiario` int NOT NULL,
  `identificacion` varchar(15) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `edad` int NOT NULL,
  `alergias` varchar(100) DEFAULT NULL,
  `medicamentos` varchar(100) DEFAULT NULL,
  `fecha_ingreso` date NOT NULL,
  `encargado` varchar(100) NOT NULL,
  `contacto` varchar(50) NOT NULL,
  `pago` decimal(10,2) DEFAULT NULL,
  `id_programa` int DEFAULT NULL,
  `id_grupo` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tbl_beneficiarios`
--

INSERT INTO `tbl_beneficiarios` (`id_beneficiario`, `identificacion`, `nombre`, `apellidos`, `fecha_nacimiento`, `edad`, `alergias`, `medicamentos`, `fecha_ingreso`, `encargado`, `contacto`, `pago`, `id_programa`, `id_grupo`) VALUES
(1, '403000564', 'Santiago', 'Hidalgo Molina', '2012-12-20', 13, 'Asma', 'Bomba de Salbutamol', '2023-05-08', 'Katherine Molina Sánchez', '8612-1617', 40000.00, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_grupos`
--

CREATE TABLE `tbl_grupos` (
  `id_grupo` int NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text,
  `nivel` varchar(50) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tbl_grupos`
--

INSERT INTO `tbl_grupos` (`id_grupo`, `codigo`, `nombre`, `descripcion`, `nivel`, `fecha_inicio`, `fecha_fin`, `estado`) VALUES
(1, 'G001', 'Oruguitas', 'Niños de 1 año en adelante.', 'Pre-materno', '2025-01-05', '2025-11-29', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_programas`
--

CREATE TABLE `tbl_programas` (
  `id_programa` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text,
  `tipo` varchar(50) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tbl_programas`
--

INSERT INTO `tbl_programas` (`id_programa`, `nombre`, `descripcion`, `tipo`, `estado`) VALUES
(1, 'PANI', 'Institución autónoma que protege y garantiza los derechos de la niñez y adolescencia en Costa Rica.', 'Público', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `id_rol` int NOT NULL,
  `nombre_rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tbl_roles`
--

INSERT INTO `tbl_roles` (`id_rol`, `nombre_rol`) VALUES
(1, 'Master'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuarios`
--

CREATE TABLE `tbl_usuarios` (
  `id_usuario` int NOT NULL,
  `identificacion` varchar(15) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasenna` varchar(255) NOT NULL,
  `fecha_registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_rol` int DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tbl_usuarios`
--

INSERT INTO `tbl_usuarios` (`id_usuario`, `identificacion`, `nombre`, `apellidos`, `correo`, `contrasenna`, `fecha_registro`, `id_rol`, `estado`) VALUES
(1, '208600279', 'Cristopher', 'Rodríguez Fernández', 'crodriguez@gmail.com', 'Cris1204', '2025-09-19 00:00:00', 1, 1),
(3, '647483', 'Brenda', 'Rojas Cortés', 'brojas@gmail.com', 'Bren2904', '2025-10-03 05:48:29', 2, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_auditoria`
--
ALTER TABLE `tbl_auditoria`
  ADD PRIMARY KEY (`id_error`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `tbl_beneficiarios`
--
ALTER TABLE `tbl_beneficiarios`
  ADD PRIMARY KEY (`id_beneficiario`),
  ADD KEY `id_programa` (`id_programa`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- Indices de la tabla `tbl_grupos`
--
ALTER TABLE `tbl_grupos`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indices de la tabla `tbl_programas`
--
ALTER TABLE `tbl_programas`
  ADD PRIMARY KEY (`id_programa`);

--
-- Indices de la tabla `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `identificacion` (`identificacion`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_auditoria`
--
ALTER TABLE `tbl_auditoria`
  MODIFY `id_error` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_beneficiarios`
--
ALTER TABLE `tbl_beneficiarios`
  MODIFY `id_beneficiario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tbl_grupos`
--
ALTER TABLE `tbl_grupos`
  MODIFY `id_grupo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_programas`
--
ALTER TABLE `tbl_programas`
  MODIFY `id_programa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `id_rol` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  MODIFY `id_usuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_auditoria`
--
ALTER TABLE `tbl_auditoria`
  ADD CONSTRAINT `tbl_auditoria_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuarios` (`id_usuario`);

--
-- Filtros para la tabla `tbl_beneficiarios`
--
ALTER TABLE `tbl_beneficiarios`
  ADD CONSTRAINT `tbl_beneficiarios_ibfk_1` FOREIGN KEY (`id_programa`) REFERENCES `tbl_programas` (`id_programa`),
  ADD CONSTRAINT `tbl_beneficiarios_ibfk_2` FOREIGN KEY (`id_grupo`) REFERENCES `tbl_grupos` (`id_grupo`);

--
-- Filtros para la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  ADD CONSTRAINT `tbl_usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `tbl_roles` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
