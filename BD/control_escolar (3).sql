-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-11-2024 a las 06:06:19
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `control_escolar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones`
--

CREATE TABLE `calificaciones` (
  `id` int(11) NOT NULL,
  `id_estudiante` int(11) NOT NULL,
  `id_materia` int(11) NOT NULL,
  `calificacion` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `calificaciones`
--

INSERT INTO `calificaciones` (`id`, `id_estudiante`, `id_materia`, `calificacion`) VALUES
(1, 3, 1, 9.00),
(2, 8, 1, 9.00),
(3, 8, 2, 10.00),
(4, 3, 1, 4.00),
(5, 9, 3, 9.00),
(6, 8, 6, 10.00),
(7, 8, 6, 8.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `id_profesor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`id`, `nombre`, `id_profesor`) VALUES
(1, 'Inteligencia Artificial	', 6),
(2, 'Diseño WEB', 6),
(3, 'Programación Móvil II', 6),
(6, 'Tutoria', 6),
(7, 'Tutoria2', 6),
(8, 's', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('admin','profesor','estudiante') NOT NULL,
  `carrera` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `sangre` varchar(50) NOT NULL,
  `edad` int(50) NOT NULL,
  `genero` varchar(50) NOT NULL,
  `status` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `rol`, `carrera`, `telefono`, `sangre`, `edad`, `genero`, `status`) VALUES
(2, 'Admin', 'admin@escolar.com', '$2y$10$OxD9/P9aVZbvPzVfpWt9R.VVfESaI8GVl3/Wxt1zQTAiz/E1XriSm', 'admin', '', '', '', 0, '', 0),
(3, 'Estudiante', 'estudiante@escolar.com', '$2y$10$rHm/pOQqF2jD7TXGgYwB9eTcbujCnZc0Q0BzMR0x.Jh63gtqjXVIy', 'estudiante', '', '', '', 0, '', 0),
(4, 'edgar', 'enrique@tec.com', '$2y$10$IFDM1rzJyqmDVlALChloteCwuQXUpoaYHu7QhfY1hPpH4RTTyXYxy', 'admin', '', '', '', 0, '', 0),
(5, 'edgar1', 'extranfunedgar@gmail.com', '$2y$10$n9SzGOVzmXHSB4UoA8Rej.vxcVRrwKYD62fwk7KddDW3uhheYgpTC', 'admin', '', '', '', 0, '', 0),
(6, 'Cinthia', 'cinthia@tec.com', '$2y$10$9aP3BnyAIUDGxzfPuyWdmOhetqKjNBKGZcL7op/Birf7RM2wrWGla', 'profesor', '', '', '', 0, '', 0),
(8, 'enrique', 'enrique@tecg.com', '$2y$10$ZViEXVTqngs1HtAR670YFOrKDUjWpgyJhWlj2jHKPyJLjmpOCyoxq', 'estudiante', '', '', '', 0, '', 0),
(9, 'lucero', 'lucero@tec.com', '$2y$10$59zEjz0GVtc34G.bjkiKWuA3VqUiIXBLXosehsl4tmYbgME/OBj1W', 'estudiante', 'isic', '1234556', 'O', 24, 'F', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_estudiante` (`id_estudiante`),
  ADD KEY `id_materia` (`id_materia`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_profesor` (`id_profesor`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD CONSTRAINT `calificaciones_ibfk_1` FOREIGN KEY (`id_estudiante`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `calificaciones_ibfk_2` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `materias`
--
ALTER TABLE `materias`
  ADD CONSTRAINT `materias_ibfk_1` FOREIGN KEY (`id_profesor`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
