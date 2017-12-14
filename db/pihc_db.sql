-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-12-2017 a las 19:50:12
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pihc_db`
--
CREATE DATABASE IF NOT EXISTS `pihc_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `pihc_db`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `id` int(9) NOT NULL,
  `ci` int(9) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comentario` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELACIONES PARA LA TABLA `alumno`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hora`
--

CREATE TABLE `hora` (
  `id` int(9) NOT NULL,
  `dia` char(2) COLLATE utf8_unicode_ci NOT NULL COMMENT 'lu, ma, mi, ju, vi, sa, do',
  `hora` tinyint(2) NOT NULL COMMENT 'formato 24h'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELACIONES PARA LA TABLA `hora`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE `materia` (
  `id` int(9) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELACIONES PARA LA TABLA `materia`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `id` int(9) NOT NULL,
  `ci` int(9) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELACIONES PARA LA TABLA `profesor`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_horario_seccion`
--

CREATE TABLE `rel_horario_seccion` (
  `seccion_nrc` int(9) NOT NULL,
  `hora_id` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELACIONES PARA LA TABLA `rel_horario_seccion`:
--   `hora_id`
--       `hora` -> `id`
--   `seccion_nrc`
--       `seccion` -> `nrc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_seccion_alumno`
--

CREATE TABLE `rel_seccion_alumno` (
  `seccion_nrc` int(9) NOT NULL,
  `alumno_id` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELACIONES PARA LA TABLA `rel_seccion_alumno`:
--   `alumno_id`
--       `alumno` -> `id`
--   `seccion_nrc`
--       `seccion` -> `nrc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

CREATE TABLE `seccion` (
  `nrc` int(9) NOT NULL,
  `cupos` int(9) NOT NULL,
  `materia_id` int(9) NOT NULL,
  `profesor_id` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELACIONES PARA LA TABLA `seccion`:
--   `materia_id`
--       `materia` -> `id`
--   `profesor_id`
--       `profesor` -> `id`
--

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ci` (`ci`);

--
-- Indices de la tabla `hora`
--
ALTER TABLE `hora`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ci` (`ci`);

--
-- Indices de la tabla `rel_horario_seccion`
--
ALTER TABLE `rel_horario_seccion`
  ADD PRIMARY KEY (`seccion_nrc`,`hora_id`),
  ADD KEY `hora_id` (`hora_id`);

--
-- Indices de la tabla `rel_seccion_alumno`
--
ALTER TABLE `rel_seccion_alumno`
  ADD PRIMARY KEY (`alumno_id`,`seccion_nrc`),
  ADD KEY `seccion_nrc` (`seccion_nrc`);

--
-- Indices de la tabla `seccion`
--
ALTER TABLE `seccion`
  ADD PRIMARY KEY (`nrc`),
  ADD KEY `materia_id` (`materia_id`),
  ADD KEY `profesor_id` (`profesor_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `hora`
--
ALTER TABLE `hora`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `materia`
--
ALTER TABLE `materia`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `profesor`
--
ALTER TABLE `profesor`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `rel_horario_seccion`
--
ALTER TABLE `rel_horario_seccion`
  ADD CONSTRAINT `rel_horario_seccion_ibfk_1` FOREIGN KEY (`hora_id`) REFERENCES `hora` (`id`),
  ADD CONSTRAINT `rel_horario_seccion_ibfk_2` FOREIGN KEY (`seccion_nrc`) REFERENCES `seccion` (`nrc`);

--
-- Filtros para la tabla `rel_seccion_alumno`
--
ALTER TABLE `rel_seccion_alumno`
  ADD CONSTRAINT `rel_seccion_alumno_ibfk_1` FOREIGN KEY (`alumno_id`) REFERENCES `alumno` (`id`),
  ADD CONSTRAINT `rel_seccion_alumno_ibfk_2` FOREIGN KEY (`seccion_nrc`) REFERENCES `seccion` (`nrc`);

--
-- Filtros para la tabla `seccion`
--
ALTER TABLE `seccion`
  ADD CONSTRAINT `seccion_ibfk_1` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`),
  ADD CONSTRAINT `seccion_ibfk_2` FOREIGN KEY (`profesor_id`) REFERENCES `profesor` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
