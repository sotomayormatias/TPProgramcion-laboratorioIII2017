-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-05-2017 a las 05:23:01
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
  `nroCochera` int(11) NOT NULL,
  `idEstado` int(11) NOT NULL,
  `idTipo` int(11) NOT NULL,
  `piso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cochera`
--

INSERT INTO `cochera` (`nroCochera`, `idEstado`, `idTipo`, `piso`) VALUES
(1, 1, 2, 1),
(2, 1, 2, 1),
(3, 1, 2, 1),
(4, 1, 1, 1),
(5, 1, 1, 2),
(6, 1, 1, 2),
(7, 1, 1, 2),
(8, 1, 1, 2),
(9, 1, 1, 3),
(10, 1, 1, 3),
(11, 1, 1, 3),
(12, 1, 1, 3);

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
-- Estructura de tabla para la tabla `operaciones`
--

CREATE TABLE `operaciones` (
  `idOperacion` int(11) NOT NULL,
  `idCochera` int(11) NOT NULL,
  `patenteVehiculo` varchar(7) NOT NULL,
  `costo` float NOT NULL,
  `ingreso` datetime NOT NULL,
  `egreso` datetime NOT NULL,
  `idEmpleadoIngreso` int(11) NOT NULL,
  `idEmpleadoEgreso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(3, 'noche', '21:00:00', '05:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `password` varchar(10) NOT NULL,
  `idRol` int(11) NOT NULL,
  `idTurno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `patente` varchar(7) NOT NULL,
  `marca` int(11) NOT NULL,
  `color` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cochera`
--
ALTER TABLE `cochera`
  ADD PRIMARY KEY (`nroCochera`);

--
-- Indices de la tabla `estadocochera`
--
ALTER TABLE `estadocochera`
  ADD PRIMARY KEY (`idEstado`);

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
  ADD PRIMARY KEY (`patente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estadocochera`
--
ALTER TABLE `estadocochera`
  MODIFY `idEstado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `operaciones`
--
ALTER TABLE `operaciones`
  MODIFY `idOperacion` int(11) NOT NULL AUTO_INCREMENT;
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
  MODIFY `idTurno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
