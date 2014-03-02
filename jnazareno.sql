-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 02, 2014 at 01:21 PM
-- Server version: 5.5.35
-- PHP Version: 5.4.4-14+deb7u7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jnazareno`
--

-- --------------------------------------------------------

--
-- Table structure for table `bautizos`
--

CREATE TABLE IF NOT EXISTS `bautizos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `sexo` char(1) NOT NULL,
  `fecha_nacimiento` varchar(10) NOT NULL,
  `ciudad_nacimiento` varchar(30) NOT NULL,
  `estado_nacimiento` varchar(30) NOT NULL,
  `pais_nacimiento` varchar(30) NOT NULL,
  `padre` varchar(100) NOT NULL,
  `madre` varchar(100) NOT NULL,
  `libro` varchar(20) NOT NULL,
  `folio` varchar(20) NOT NULL,
  `numero` varchar(20) NOT NULL,
  `fecha` varchar(10) NOT NULL,
  `padrino` char(100) DEFAULT NULL,
  `madrina` char(100) DEFAULT NULL,
  `ministro` char(50) NOT NULL,
  `prefectura_municipio` char(20) DEFAULT NULL COMMENT 'Solo administrador puede pasar este campo por alto.\r\nUsuarios comunes deben rellenar este campo.\r\nVALIDAR A NIVEL DE PHP\r\nToda la información de la prefectura',
  `prefectura_fecha` varchar(10) DEFAULT NULL,
  `prefectura_numero` varchar(20) DEFAULT NULL,
  `prefectura_folio` varchar(20) DEFAULT NULL,
  `prefectura_libro` char(20) DEFAULT NULL,
  `nota_marginal` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `configuracion`
--

CREATE TABLE IF NOT EXISTS `configuracion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parametro` char(20) NOT NULL,
  `valor` char(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `matrimonios`
--

CREATE TABLE IF NOT EXISTS `matrimonios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres_novio` varchar(50) NOT NULL,
  `apellidos_novio` varchar(50) NOT NULL,
  `cedula_novio` varchar(11) NOT NULL,
  `fecha_nacimiento_novio` date NOT NULL,
  `estado_civil_novio` varchar(10) NOT NULL,
  `ciudad_nacimiento_novio` varchar(30) NOT NULL,
  `estado_nacimiento_novio` varchar(30) NOT NULL,
  `pais_nacimiento_novio` varchar(30) NOT NULL,
  `ciudad_actual_novio` varchar(30) NOT NULL,
  `estado_actual_novio` varchar(30) NOT NULL,
  `pais_actual_novio` varchar(30) NOT NULL,
  `padre_novio` varchar(100) NOT NULL,
  `madre_novio` varchar(100) NOT NULL,
  `telefono_novio` varchar(14) NOT NULL,
  `condicion_novio` varchar(30) NOT NULL DEFAULT 'NO',
  `nombre_testigo_novio` varchar(100) NOT NULL,
  `cedula_testigo_novio` varchar(11) NOT NULL,
  `direccion_testigo_novio` text NOT NULL,
  `estado_testigo_novio` varchar(30) NOT NULL,
  `tnovio_testigo_novio` int(11) NOT NULL,
  `tnovia_testigo_novio` int(11) NOT NULL,
  `nombres_novia` varchar(50) NOT NULL,
  `apellidos_novia` varchar(50) NOT NULL,
  `cedula_novia` varchar(11) NOT NULL,
  `fecha_nacimiento_novia` date NOT NULL,
  `estado_civil_novia` varchar(10) NOT NULL,
  `ciudad_nacimiento_novia` varchar(30) NOT NULL,
  `estado_nacimiento_novia` varchar(30) NOT NULL,
  `pais_nacimiento_novia` varchar(30) NOT NULL,
  `ciudad_actual_novia` varchar(30) NOT NULL,
  `estado_actual_novia` varchar(30) NOT NULL,
  `pais_actual_novia` varchar(30) NOT NULL,
  `padre_novia` varchar(100) NOT NULL,
  `madre_novia` varchar(100) NOT NULL,
  `telefono_novia` varchar(14) NOT NULL,
  `condicion_novia` varchar(30) NOT NULL DEFAULT 'NO',
  `nombre_testigo_novia` varchar(100) NOT NULL,
  `cedula_testigo_novia` varchar(11) NOT NULL,
  `direccion_testigo_novia` text NOT NULL,
  `estado_testigo_novia` varchar(30) NOT NULL,
  `tnovio_testigo_novia` int(11) NOT NULL,
  `tnovia_testigo_novia` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` char(20) NOT NULL,
  `password` char(40) NOT NULL,
  `rol` char(1) NOT NULL DEFAULT 'N' COMMENT 'N = Normal A = Admin',
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
