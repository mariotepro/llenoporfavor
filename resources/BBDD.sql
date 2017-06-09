-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 31-08-2015 a las 15:21:18
-- Versión del servidor: 5.5.42-cll
-- Versión de PHP: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `llenopor_main`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expenses`
--

CREATE TABLE IF NOT EXISTS `expenses` (
  `id_exp` int(11) NOT NULL AUTO_INCREMENT,
  `id_veh` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `km` double DEFAULT NULL,
  `description` varchar(140) DEFAULT NULL,
  `fuel_km` double DEFAULT NULL,
  `fuel_quantity` double DEFAULT NULL,
  `fuel_cb_consumption` double DEFAULT NULL,
  `fuel_cb_speed` int(3) DEFAULT NULL,
  `price` double DEFAULT NULL,
  PRIMARY KEY (`id_exp`),
  KEY `id_veh` (`id_veh`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `expenses`
--

INSERT INTO `expenses` (`id_exp`, `id_veh`, `type`, `date`, `km`, `description`, `fuel_km`, `fuel_quantity`, `fuel_cb_consumption`, `fuel_cb_speed`, `price`) VALUES
(3, 10, 'fueling', '2015-08-07', 130421, 'Le he echado gasoil.', 990.2, 50.23, 6.6, 70, 70.42),
(4, 10, 'fueling', '2015-08-12', 131023, 'Le he echado gasoil.', 602.3, 35.42, 6.6, 70, 42.42),
(5, 10, 'Mantenimiento', '2015-08-13', 132003, 'Cambio de aceite y filtros', NULL, NULL, NULL, NULL, 210),
(6, 10, 'fueling', '2015-08-22', 140000, 'NULL', 910, 51.07, 7.1, 70, 72.03),
(9, 10, 'fueling', '1990-07-27', 113123, '''quesloquesellevahora''', 912, 70.12, 6.6, 70, 70.12),
(10, 10, 'Mantenimiento', '1990-07-27', 113123, 'tengountractoramarillo', NULL, NULL, NULL, NULL, 70.12),
(11, 11, 'fueling', '2015-08-13', 123423, '''Probando''', 912, 12, 6.6, 70, 70),
(12, 10, 'fueling', '2015-08-01', 134132, '''Esto funciona bien''', 912, 70.15, 6.7, 70, 12.12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `models`
--

CREATE TABLE IF NOT EXISTS `models` (
  `id_model` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer` varchar(20) NOT NULL,
  `model` varchar(20) NOT NULL,
  `year` int(4) NOT NULL,
  `fuel` varchar(8) NOT NULL,
  `engine` int(4) NOT NULL,
  `hp` int(3) NOT NULL,
  `door` int(1) NOT NULL,
  PRIMARY KEY (`id_model`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `models`
--

INSERT INTO `models` (`id_model`, `manufacturer`, `model`, `year`, `fuel`, `engine`, `hp`, `door`) VALUES
(1, 'Volkswagen', 'Golf', 2011, 'Diesel', 1600, 105, 5),
(2, 'Renault', 'Megane II', 2008, 'Diesel', 1600, 85, 5),
(4, 'Renault', 'Megane', 1999, 'Gasolina', 1900, 68, 5),
(5, 'Jaguar', 'XE', 2015, 'Diesel', 2000, 180, 4),
(6, 'Cadillac', 'Escalade', 2009, 'Gasolina', 6800, 140, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `pass` varchar(32) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `bdate` date DEFAULT NULL,
  `country` varchar(2) DEFAULT NULL,
  `photo` varchar(140) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `username`, `pass`, `mail`, `bdate`, `country`, `photo`) VALUES
(7, 'mariotepro', '6f8f57715090da2632453988d9a1501b', 'mariobastardo@gmail.com', '1990-07-27', 'PT', 'media/mario.jpg'),
(8, 'm', '6f8f57715090da2632453988d9a1501b', 'mariobastardo@gmail.com', '1990-07-27', 'UK', 'media/mario.jpg'),
(14, 'mariote', '6f8f57715090da2632453988d9a1501b', 'mariobastardo@gmail.com', '2015-08-10', 'ES', NULL),
(15, 'mario', '6f8f57715090da2632453988d9a1501b', 'mariobastardo@gmail.com', '2015-08-07', 'ES', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehicles`
--

CREATE TABLE IF NOT EXISTS `vehicles` (
  `id_veh` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_model` int(11) NOT NULL,
  `color` varchar(20) DEFAULT NULL,
  `description` varchar(140) DEFAULT NULL,
  `photo` varchar(140) DEFAULT NULL,
  PRIMARY KEY (`id_veh`),
  KEY `id_user` (`id_user`),
  KEY `id_model` (`id_model`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `vehicles`
--

INSERT INTO `vehicles` (`id_veh`, `id_user`, `id_model`, `color`, `description`, `photo`) VALUES
(1, 7, 1, 'Blanco', 'Es mi coche.', 'media/golf.jpg'),
(2, 7, 1, 'VERDE FOSFORITO', 'ÉSTE COCHE ES UNA PUTISIIIIIMA MIERDA', 'media/golf.jpg'),
(10, 8, 1, 'Azul', NULL, 'media/B5c9EJDCMAA0mdE.jpg'),
(11, 8, 4, 'Blanco', 'Maravilloso', 'media/251391_192858437431454_130225577028074_559275_2984079_n-1.jpg');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_ibfk_1` FOREIGN KEY (`id_veh`) REFERENCES `vehicles` (`id_veh`);

--
-- Filtros para la tabla `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `vehicles_ibfk_2` FOREIGN KEY (`id_model`) REFERENCES `models` (`id_model`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
