-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-03-2025 a las 14:26:28
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de datos: `cursos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

CREATE TABLE `clases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `ponderacion` tinyint(1) UNSIGNED NOT NULL CHECK (`ponderacion` between 1 and 5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clases`
--

INSERT INTO `clases` (`id`, `nombre`, `ponderacion`) VALUES
(1, 'Vocabulario sobre Trabajo en Inglés', 5),
(2, 'Conversaciones de Trabajo en Inglés', 5),
(3, 'Gramática Básica en Inglés', 4),
(4, 'Pronunciación en Inglés Americano', 3),
(5, 'Frases Comunes en Entrevistas de Trabajos', 2),
(6, 'Inglés para Negocios', 4),
(7, 'Expresiones Idiomáticas en Inglés', 3),
(8, 'Comprensión Auditiva: Noticias en Inglés', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examenes`
--

CREATE TABLE `examenes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipo` tinyint(1) UNSIGNED NOT NULL CHECK (`tipo` between 1 and 3)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `examenes`
--

INSERT INTO `examenes` (`id`, `nombre`, `tipo`) VALUES
(1, 'Trabajos y ocupaciones en Inglés', 1),
(2, 'Examen de Gramática Básica', 2),
(3, 'Examen de Vocabulario de Viajes', 3),
(4, 'Test de Entrevistas en Inglés', 1),
(5, 'Prueba de Pronunciación en Inglés', 2),
(6, 'Simulación de Conversación de Negocios', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clases`
--
ALTER TABLE `clases`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `clases` ADD FULLTEXT KEY `clases_nombre` (`nombre`);

--
-- Indices de la tabla `examenes`
--
ALTER TABLE `examenes`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `examenes` ADD FULLTEXT KEY `examenes_nombre` (`nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clases`
--
ALTER TABLE `clases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `examenes`
--
ALTER TABLE `examenes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;
