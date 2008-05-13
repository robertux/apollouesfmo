-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.0.51a-community-nt


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema apollo
--

CREATE DATABASE IF NOT EXISTS apollo;
USE apollo;

--
-- Definition of table `alumno`
--

DROP TABLE IF EXISTS `alumno`;
CREATE TABLE `alumno` (
  `id` int(11) NOT NULL auto_increment,
  `apellidos` varchar(200) NOT NULL,
  `nombres` varchar(200) NOT NULL,
  `direccion` text NOT NULL,
  `telefono` varchar(8) default NULL,
  `fechanacimiento` date NOT NULL,
  `usuario` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_usuario_id_alumno` (`usuario`),
  CONSTRAINT `fk_usuario_id_alumno` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alumno`
--

/*!40000 ALTER TABLE `alumno` DISABLE KEYS */;
/*!40000 ALTER TABLE `alumno` ENABLE KEYS */;


--
-- Definition of table `asignacion`
--

DROP TABLE IF EXISTS `asignacion`;
CREATE TABLE `asignacion` (
  `id` int(11) NOT NULL auto_increment,
  `usuario` int(11) NOT NULL,
  `privilegio` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_usuario_id_asignacion` (`usuario`),
  KEY `fk_privilegio_id_asignacion` (`privilegio`),
  CONSTRAINT `fk_privilegio_id_asignacion` FOREIGN KEY (`privilegio`) REFERENCES `privilegio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_usuario_id_asignacion` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asignacion`
--

/*!40000 ALTER TABLE `asignacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `asignacion` ENABLE KEYS */;


--
-- Definition of table `costo`
--

DROP TABLE IF EXISTS `costo`;
CREATE TABLE `costo` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` varchar(50) NOT NULL,
  `valor` double NOT NULL,
  `postgrado` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_postgrado_id_costo` (`postgrado`),
  CONSTRAINT `fk_postgrado_id_costo` FOREIGN KEY (`postgrado`) REFERENCES `postgrado` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `costo`
--

/*!40000 ALTER TABLE `costo` DISABLE KEYS */;
/*!40000 ALTER TABLE `costo` ENABLE KEYS */;


--
-- Definition of table `curso`
--

DROP TABLE IF EXISTS `curso`;
CREATE TABLE `curso` (
  `id` int(11) NOT NULL auto_increment,
  `fechainicio` date NOT NULL,
  `postgrado` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_postgrado_id_curso` (`postgrado`),
  CONSTRAINT `fk_postgrado_id_curso` FOREIGN KEY (`postgrado`) REFERENCES `postgrado` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `curso`
--

/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;


--
-- Definition of table `docente`
--

DROP TABLE IF EXISTS `docente`;
CREATE TABLE `docente` (
  `id` int(11) NOT NULL auto_increment,
  `apellidos` varchar(200) NOT NULL,
  `nombres` varchar(200) NOT NULL,
  `gradoacademico` varchar(50) NOT NULL,
  `usuario` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_usuario_id_docente` (`usuario`),
  CONSTRAINT `fk_usuario_id_docente` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `docente`
--

/*!40000 ALTER TABLE `docente` DISABLE KEYS */;
/*!40000 ALTER TABLE `docente` ENABLE KEYS */;


--
-- Definition of table `evaluacion`
--

DROP TABLE IF EXISTS `evaluacion`;
CREATE TABLE `evaluacion` (
  `id` int(11) NOT NULL auto_increment,
  `fecha` date NOT NULL,
  `porcentaje` double NOT NULL,
  `nota` double NOT NULL,
  `modulo` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_modulo_id_evaluacion` (`modulo`),
  CONSTRAINT `fk_modulo_id_evaluacion` FOREIGN KEY (`modulo`) REFERENCES `modulo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evaluacion`
--

/*!40000 ALTER TABLE `evaluacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `evaluacion` ENABLE KEYS */;


--
-- Definition of table `horario`
--

DROP TABLE IF EXISTS `horario`;
CREATE TABLE `horario` (
  `id` int(11) NOT NULL auto_increment,
  `dia` int(11) NOT NULL,
  `horainicio` time NOT NULL,
  `horafin` time NOT NULL,
  `aula` varchar(25) NOT NULL,
  `frecuencia` varchar(25) NOT NULL,
  `modulo` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_modulo_id_horario` (`modulo`),
  CONSTRAINT `fk_modulo_id_horario` FOREIGN KEY (`modulo`) REFERENCES `modulo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `horario`
--

/*!40000 ALTER TABLE `horario` DISABLE KEYS */;
/*!40000 ALTER TABLE `horario` ENABLE KEYS */;


--
-- Definition of table `inscripcion`
--

DROP TABLE IF EXISTS `inscripcion`;
CREATE TABLE `inscripcion` (
  `id` int(11) NOT NULL auto_increment,
  `alumno` int(11) NOT NULL,
  `curso` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `notafinal` double NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_alumno_id_inscripcion` (`alumno`),
  KEY `fk_curso_id_inscripcion` (`curso`),
  CONSTRAINT `fk_alumno_id_inscripcion` FOREIGN KEY (`alumno`) REFERENCES `alumno` (`id`),
  CONSTRAINT `fk_curso_id_inscripcion` FOREIGN KEY (`curso`) REFERENCES `curso` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inscripcion`
--

/*!40000 ALTER TABLE `inscripcion` DISABLE KEYS */;
/*!40000 ALTER TABLE `inscripcion` ENABLE KEYS */;


--
-- Definition of table `materia`
--

DROP TABLE IF EXISTS `materia`;
CREATE TABLE `materia` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` varchar(50) NOT NULL,
  `uvs` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `requisitopara` text,
  `postgrado` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_postgrado_id_materia` (`postgrado`),
  CONSTRAINT `fk_postgrado_id_materia` FOREIGN KEY (`postgrado`) REFERENCES `postgrado` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materia`
--

/*!40000 ALTER TABLE `materia` DISABLE KEYS */;
/*!40000 ALTER TABLE `materia` ENABLE KEYS */;


--
-- Definition of table `modulo`
--

DROP TABLE IF EXISTS `modulo`;
CREATE TABLE `modulo` (
  `id` int(11) NOT NULL auto_increment,
  `correlativo` int(11) NOT NULL,
  `docente` int(11) NOT NULL,
  `fechainicio` date NOT NULL,
  `duracion` int(11) NOT NULL,
  `notafinal` double NOT NULL,
  `curso` int(11) NOT NULL,
  `materia` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_curso_id_modulo` (`curso`),
  KEY `fk_docente_id_modulo` (`docente`),
  KEY `fk_materia_id_modulo` (`materia`),
  CONSTRAINT `fk_curso_id_modulo` FOREIGN KEY (`curso`) REFERENCES `curso` (`id`),
  CONSTRAINT `fk_docente_id_modulo` FOREIGN KEY (`docente`) REFERENCES `docente` (`id`),
  CONSTRAINT `fk_materia_id_modulo` FOREIGN KEY (`materia`) REFERENCES `materia` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modulo`
--

/*!40000 ALTER TABLE `modulo` DISABLE KEYS */;
/*!40000 ALTER TABLE `modulo` ENABLE KEYS */;


--
-- Definition of table `novedades`
--

DROP TABLE IF EXISTS `novedades`;
CREATE TABLE `novedades` (
  `titulo` varchar(20) NOT NULL,
  `vinculo` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `novedades`
--

/*!40000 ALTER TABLE `novedades` DISABLE KEYS */;
/*!40000 ALTER TABLE `novedades` ENABLE KEYS */;


--
-- Definition of table `postgrado`
--

DROP TABLE IF EXISTS `postgrado`;
CREATE TABLE `postgrado` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` varchar(200) NOT NULL,
  `notaminima` double unsigned NOT NULL default '7',
  `totaluvs` int(10) unsigned NOT NULL default '0',
  `cumminimo` double unsigned NOT NULL default '7.5',
  `abreviatura` varchar(8) default NULL,
  `maxalum` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `postgrado`
--

/*!40000 ALTER TABLE `postgrado` DISABLE KEYS */;
INSERT INTO `postgrado` (`id`,`nombre`,`notaminima`,`totaluvs`,`cumminimo`,`abreviatura`,`maxalum`) VALUES 
 (1,'Maestría en filosofía cuántica pedagógica',7,60,7.5,'MFCP',15),
 (2,'Maestría en uranología moderna urbana',8,100,8.5,'MUMU',10);
/*!40000 ALTER TABLE `postgrado` ENABLE KEYS */;


--
-- Definition of table `privilegio`
--

DROP TABLE IF EXISTS `privilegio`;
CREATE TABLE `privilegio` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `privilegio`
--

/*!40000 ALTER TABLE `privilegio` DISABLE KEYS */;
/*!40000 ALTER TABLE `privilegio` ENABLE KEYS */;


--
-- Definition of table `requisito`
--

DROP TABLE IF EXISTS `requisito`;
CREATE TABLE `requisito` (
  `id` int(11) NOT NULL auto_increment,
  `nombre` varchar(200) NOT NULL,
  `postgrado` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_postgrado_id_requisito` (`postgrado`),
  CONSTRAINT `fk_postgrado_id_requisito` FOREIGN KEY (`postgrado`) REFERENCES `postgrado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requisito`
--

/*!40000 ALTER TABLE `requisito` DISABLE KEYS */;
/*!40000 ALTER TABLE `requisito` ENABLE KEYS */;


--
-- Definition of table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL auto_increment,
  `clave` varchar(10) default NULL,
  `nombre` varchar(15) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`,`clave`,`nombre`) VALUES 
 (1,'ninguno','ninguna');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
