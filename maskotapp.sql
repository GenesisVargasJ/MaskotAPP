-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-06-2015 a las 23:13:11
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `maskotapp`
--

CREATE DATABASE `maskotapp`;

USE `maskotapp`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascota`
--

CREATE TABLE IF NOT EXISTS `mascota` (
  `id_mascota` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_tipomascota` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `raza` varchar(50) NOT NULL,
  `edad` int(11) NOT NULL,
  `detalles` varchar(500) NOT NULL,
  `imagen` varchar(500) NOT NULL,
  `latitud` varchar(200) NOT NULL,
  `longitud` varchar(200) NOT NULL,
  PRIMARY KEY (`id_mascota`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_tipomascota` (`id_tipomascota`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=72 ;

--
-- Volcado de datos para la tabla `mascota`
--

INSERT INTO `mascota` (`id_mascota`, `id_usuario`, `id_tipomascota`, `nombre`, `raza`, `edad`, `detalles`, `imagen`, `latitud`, `longitud`) VALUES
(61, 1, 1, 'alex morgan', 'perra rica', 3, 'esta buena', 'soffy.jpg', '11.0112927', '-74.8043141'),
(65, 1, 2, 'mishu3', 'zorra', 2, 'no tien nada', 'mishu.jpg', '10.9771637', '-74.8288397'),
(71, 1, 1, 'juan perez', 'zorra', 3, 'dsagdfshs', '42c05fc4-150a-4362-b355-ccb4d971bf33.png', '11.0023202', '-74.80054969999998');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipomascota`
--

CREATE TABLE IF NOT EXISTS `tipomascota` (
  `id_tipomascota` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id_tipomascota`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `tipomascota`
--

INSERT INTO `tipomascota` (`id_tipomascota`, `nombre`) VALUES
(1, 'Perro'),
(2, 'Gato'),
(3, 'Cerdo'),
(4, 'Lobo'),
(5, 'Hormiga'),
(6, 'Leon'),
(7, 'Tigre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `usuario`, `contrasena`, `nombre`, `telefono`) VALUES
(1, 'admin2', '123', 'administrador del sistema', '3209875438'),
(6, 'gene', '123', 'genesis vargas', '23965344'),
(7, 'root', '123', 'root perez', '45236537'),
(8, 'root23', '123', 'juan perez', '3245687'),
(9, 'root24', '123', 'juan perez', '3245687');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD CONSTRAINT `mascota_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mascota_ibfk_2` FOREIGN KEY (`id_tipomascota`) REFERENCES `tipomascota` (`id_tipomascota`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
