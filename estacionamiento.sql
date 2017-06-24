-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-06-2017 a las 01:17:38
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `estacionamiento`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cochera`
--

CREATE TABLE `cochera` (
  `idCochera` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `idEstado` int(11) NOT NULL,
  `idTipo` int(11) NOT NULL,
  `piso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cochera`
--

INSERT INTO `cochera` (`idCochera`, `numero`, `idEstado`, `idTipo`, `piso`) VALUES
(1, 1, 1, 2, 1),
(2, 2, 2, 2, 1),
(3, 3, 1, 2, 1),
(4, 4, 1, 1, 1),
(5, 5, 1, 1, 2),
(6, 6, 1, 1, 2),
(7, 7, 1, 1, 2),
(8, 8, 2, 1, 2),
(9, 9, 1, 1, 3),
(10, 10, 1, 1, 3),
(11, 11, 1, 1, 3),
(12, 12, 1, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadocochera`
--

CREATE TABLE `estadocochera` (
  `idEstado` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estadocochera`
--

INSERT INTO `estadocochera` (`idEstado`, `descripcion`) VALUES
(1, 'libre'),
(2, 'ocupada'),
(3, 'inhabilitada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fichaje`
--

CREATE TABLE `fichaje` (
  `idFichaje` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fechaLogin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fichaje`
--

INSERT INTO `fichaje` (`idFichaje`, `idUsuario`, `fechaLogin`) VALUES
(2, 2, '2017-06-10 11:33:53'),
(3, 1, '2017-06-10 11:35:00'),
(4, 7, '2017-06-10 11:35:28'),
(5, 7, '2017-06-10 11:37:06'),
(6, 1, '2017-06-10 11:40:31'),
(7, 7, '2017-06-10 11:40:53'),
(8, 2, '2017-06-10 11:41:15'),
(9, 8, '2017-06-10 11:41:29'),
(10, 9, '2017-06-10 11:41:44'),
(11, 2, '2017-06-10 11:42:02'),
(12, 2, '2017-06-10 15:31:22'),
(13, 2, '2017-06-15 23:27:33'),
(14, 2, '2017-06-17 15:00:40'),
(15, 2, '2017-06-17 15:03:23'),
(16, 2, '2017-06-17 15:14:32'),
(17, 8, '2017-06-17 15:19:27'),
(18, 2, '2017-06-17 23:47:19'),
(19, 7, '2017-06-18 00:39:19'),
(20, 7, '2017-06-19 19:51:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operaciones`
--

CREATE TABLE `operaciones` (
  `idOperacion` int(11) NOT NULL,
  `idCochera` int(11) NOT NULL,
  `idVehiculo` varchar(7) NOT NULL,
  `costo` float NOT NULL,
  `ingreso` datetime NOT NULL,
  `egreso` datetime DEFAULT NULL,
  `idEmpleadoIngreso` int(11) NOT NULL,
  `idEmpleadoEgreso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `operaciones`
--

INSERT INTO `operaciones` (`idOperacion`, `idCochera`, `idVehiculo`, `costo`, `ingreso`, `egreso`, `idEmpleadoIngreso`, `idEmpleadoEgreso`) VALUES
(3, 2, '17', 0, '2017-06-08 00:46:43', NULL, 1, NULL),
(4, 6, '18', 850, '2017-06-12 23:34:53', '2017-06-17 20:11:10', 2, 2),
(5, 11, '19', 10, '2017-06-17 15:14:53', '2017-06-17 20:19:32', 2, 8),
(6, 8, '20', 0, '2017-06-18 00:28:35', NULL, 2, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idRol`, `descripcion`) VALUES
(1, 'administrador'),
(2, 'empleado'),
(3, 'superAdmin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipocochera`
--

CREATE TABLE `tipocochera` (
  `idTipo` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `precioHora` float NOT NULL,
  `precioMediaEstadia` float NOT NULL,
  `precioEstadia` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipocochera`
--

INSERT INTO `tipocochera` (`idTipo`, `descripcion`, `precioHora`, `precioMediaEstadia`, `precioEstadia`) VALUES
(1, 'comun', 10, 90, 170),
(2, 'reservada', 10, 90, 170);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turno`
--

CREATE TABLE `turno` (
  `idTurno` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `ingreso` time NOT NULL,
  `egreso` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `turno`
--

INSERT INTO `turno` (`idTurno`, `descripcion`, `ingreso`, `egreso`) VALUES
(1, 'mañana', '05:00:00', '13:00:00'),
(2, 'tarde', '13:00:00', '21:00:00'),
(3, 'noche', '21:00:00', '05:00:00'),
(4, 'admin', '00:00:00', '00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `idRol` int(11) NOT NULL,
  `idTurno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombre`, `correo`, `password`, `idRol`, `idTurno`) VALUES
(1, 'Administrador', 'admin@parkhere.com', 'Admin123', 3, 4),
(2, 'Empleado mañana', 'turnomaniana@parkhere.com', 'Empleado123', 2, 1),
(7, 'el patron', 'elpatron@parkhere.com', 'elPatron123', 1, 4),
(8, 'Empleado tarde', 'turnotarde@parkhere.com', 'Empleado123', 2, 2),
(9, 'Empleado noche', 'turnonoche@parkhere.com', 'Empleado123', 2, 3),
(10, 'alberto', 'alberto@cormillot.com', 'cuestiondepeso', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `idVehiculo` int(11) NOT NULL,
  `patente` varchar(7) NOT NULL,
  `marca` varchar(100) NOT NULL,
  `color` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`idVehiculo`, `patente`, `marca`, `color`) VALUES
(17, 'XYZ987', 'VW', 'gris'),
(18, 'bnt973', 'chevrolet', 'ambar'),
(19, 'JFH857', 'Ford', 'Verde'),
(20, 'AFJ123', 'Scania', 'Blanco');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cochera`
--
ALTER TABLE `cochera`
  ADD PRIMARY KEY (`idCochera`);

--
-- Indices de la tabla `estadocochera`
--
ALTER TABLE `estadocochera`
  ADD PRIMARY KEY (`idEstado`);

--
-- Indices de la tabla `fichaje`
--
ALTER TABLE `fichaje`
  ADD PRIMARY KEY (`idFichaje`);

--
-- Indices de la tabla `operaciones`
--
ALTER TABLE `operaciones`
  ADD PRIMARY KEY (`idOperacion`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `tipocochera`
--
ALTER TABLE `tipocochera`
  ADD PRIMARY KEY (`idTipo`);

--
-- Indices de la tabla `turno`
--
ALTER TABLE `turno`
  ADD PRIMARY KEY (`idTurno`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Indices de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`idVehiculo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cochera`
--
ALTER TABLE `cochera`
  MODIFY `idCochera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `estadocochera`
--
ALTER TABLE `estadocochera`
  MODIFY `idEstado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `fichaje`
--
ALTER TABLE `fichaje`
  MODIFY `idFichaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `operaciones`
--
ALTER TABLE `operaciones`
  MODIFY `idOperacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tipocochera`
--
ALTER TABLE `tipocochera`
  MODIFY `idTipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `turno`
--
ALTER TABLE `turno`
  MODIFY `idTurno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  MODIFY `idVehiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
