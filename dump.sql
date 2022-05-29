-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 10-05-2022 a las 14:48:11
-- Versión del servidor: 5.7.30
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `curso_blog`
--
CREATE DATABASE IF NOT EXISTS `curso_blog` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `curso_blog`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`) VALUES
(1, 'Categoria 1'),
(3, 'Categoria 2'),
(4, 'Categoria 3'),
(5, 'Categoria 4'),
(6, 'Categoria 5'),
(7, 'Categoria 6'),
(8, 'Categoria 7'),
(9, 'Categoria 8'),
(10, 'Categoria 9'),
(11, 'Categoria 10'),
(12, 'Categoria 11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220505074859', '2022-05-05 09:54:56', 265),
('DoctrineMigrations\\Version20220505075933', '2022-05-05 10:00:05', 295),
('DoctrineMigrations\\Version20220505101335', '2022-05-05 12:13:42', 172),
('DoctrineMigrations\\Version20220505102029', '2022-05-05 14:16:12', 553),
('DoctrineMigrations\\Version20220509134230', '2022-05-09 15:43:16', 145),
('DoctrineMigrations\\Version20220510102136', '2022-05-10 12:21:48', 220);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia`
--

CREATE TABLE `noticia` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8mb4_unicode_ci,
  `autor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `fecha_pub` datetime NOT NULL,
  `ruta_imagen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `noticia`
--

INSERT INTO `noticia` (`id`, `titulo`, `descripcion`, `autor`, `categoria_id`, `fecha_pub`, `ruta_imagen`) VALUES
(1, 'Noticia 1 Mod', 'asdf asd fasdfasdf asdf\r\nasdfasdf\r\nasdfasdf\r\nasdfasdfasdfasdfasdfasdf', 'Toni', 1, '2022-05-09 15:43:16', NULL),
(2, 'Noticia 2', 'asdf asd fasdfasdf asdf', 'Toni', 3, '2022-05-09 15:43:16', 'uploads/5/tesla-62791babd840d.png'),
(3, 'Noticia 3', 'asdf asd fasdfasdf asdf', 'Toni', 1, '2022-05-09 15:43:16', NULL),
(4, 'Noticia 4', 'asdf asd fasdfasdf asdf', 'Toni', 1, '2022-05-09 15:43:16', NULL),
(5, 'Noticia 5', 'asdf asd fasdfasdf asdf', 'Toni', 1, '2022-05-09 15:43:16', NULL),
(6, 'Noticia 6', 'asdf asd fasdfasdf asdf', 'Toni', 1, '2022-05-09 15:43:16', NULL),
(7, 'Noticia 7', 'asdf asd fasdfasdf asdf', 'Toni', 1, '2022-05-09 15:43:16', NULL),
(8, 'Noticia 8', 'asdf asd fasdfasdf asdf', 'Toni', NULL, '2022-05-09 15:43:16', NULL),
(9, 'Noticia 9', 'asdf asd fasdfasdf asdf', 'Toni', NULL, '2022-05-09 15:43:16', NULL),
(10, 'Noticia 10', 'asdf asd fasdfasdf asdf', 'Toni', NULL, '2022-05-09 15:43:16', NULL),
(12, 'Noticia 11', 'eeeeee', 'Toni', 5, '2022-05-09 15:43:16', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `roles`, `password`, `email`) VALUES
(1, 'admin', '[\"ROLE_ADMIN\"]', '$2y$13$4GACWxHjfrcMy9Msvbdg.eLRTqOH3cXyP1bmHIaOBkA0LuSdEniZa', 'asdf@asdf.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_31205F963397707A` (`categoria_id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `noticia`
--
ALTER TABLE `noticia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD CONSTRAINT `FK_31205F963397707A` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`);
