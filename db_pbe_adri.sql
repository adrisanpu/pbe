-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Temps de generació: 31-10-2020 a les 11:30:29
-- Versió del servidor: 10.4.14-MariaDB
-- Versió de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `pbe`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `marks`
--

CREATE TABLE `marks` (
  `uid` varchar(50) NOT NULL,
  `subject` varchar(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `mark` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Bolcament de dades per a la taula `marks`
--

INSERT INTO `marks` (`uid`, `subject`, `name`, `mark`) VALUES
('0xa9,0x47,0x56,0xc1', 'AST', 'control teoria', 7.5),
('0xa9,0x47,0x56,0xc1', 'AST', 'parcial 1r tema', 5),
('0xa9,0x47,0x56,0xc1', 'AST', 'practica 1', 6),
('0xa9,0x47,0x56,0xc1', 'DSBM', 'memoria 2', 8),
('0xa9,0x47,0x56,0xc1', 'DSBM', 'estudi previ 2', 4),
('0xa9,0x47,0x56,0xc1', 'AST', 'estudi previ 1', 6),
('0xa9,0x47,0x56,0xc1', 'PBE', 'puzzle 1', 7.5),
('0xa9,0x47,0x56,0xc1', 'PBE', 'puzzle 2', 9),
('0xa9,0x47,0x56,0xc1', 'PBE', 'cdr', 10);

-- --------------------------------------------------------

--
-- Estructura de la taula `students`
--

CREATE TABLE `students` (
  `uid` varchar(50) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Bolcament de dades per a la taula `students`
--

INSERT INTO `students` (`uid`, `name`) VALUES
('0xa9,0x47,0x56,0xc1', 'Adria Sanchez Puig');

-- --------------------------------------------------------

--
-- Estructura de la taula `tasks`
--

CREATE TABLE `tasks` (
  `uid` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `subject` varchar(16) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Bolcament de dades per a la taula `tasks`
--

INSERT INTO `tasks` (`uid`, `date`, `subject`, `name`) VALUES
('0xa9,0x47,0x56,0xc1', '2020-05-13', 'AST', 'control teoria'),
('0xa9,0x47,0x56,0xc1', '2020-06-03', 'AST', 'parcial 1r tema'),
('0xa9,0x47,0x56,0xc1', '2020-06-18', 'IPAV', 'practica 1'),
('0xa9,0x47,0x56,0xc1', '2020-05-07', 'RP', 'memoria 2'),
('0xa9,0x47,0x56,0xc1', '2020-07-23', 'AST', 'estudi previ 2'),
('0xa9,0x47,0x56,0xc1', '2020-10-04', 'AST', 'estudi previ 1'),
('0xa9,0x47,0x56,0xc1', '2020-10-02', 'PBE', 'puzzle 1'),
('0xa9,0x47,0x56,0xc1', '2020-05-15', 'PBE', 'puzzle 2'),
('0xa9,0x47,0x56,0xc1', '2020-07-29', 'PBE', 'cdr');

-- --------------------------------------------------------

--
-- Estructura de la taula `timetables`
--

CREATE TABLE `timetables` (
  `uid` varchar(50) NOT NULL,
  `day` varchar(3) NOT NULL,
  `hour` time DEFAULT NULL,
  `subject` varchar(10) NOT NULL,
  `room` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Bolcament de dades per a la taula `timetables`
--

INSERT INTO `timetables` (`uid`, `day`, `hour`, `subject`, `room`) VALUES
('0xa9,0x47,0x56,0xc1', 'Mon', '08:00:00', 'LAB RP', 'D3006'),
('0xa9,0x47,0x56,0xc1', 'Mon', '13:00:00', 'DSBM', 'A2002'),
('0xa9,0x47,0x56,0xc1', 'Tue', '08:00:00', 'LAB DSBM', 'C5S101A'),
('0xa9,0x47,0x56,0xc1', 'Tue', '10:00:00', 'PSAVC', 'A2002'),
('0xa9,0x47,0x56,0xc1', 'Mon', '10:00:00', 'TD', 'A2002'),
('0xa9,0x47,0x56,0xc1', 'Tue', '11:00:00', 'LAB PBE', 'A4101'),
('0xa9,0x47,0x56,0xc1', 'Wed', '08:00:00', 'PBE', 'A2002'),
('0xa9,0x47,0x56,0xc1', 'Wed', '10:00:00', 'RP', 'A2002'),
('0xa9,0x47,0x56,0xc1', 'Wed', '12:00:00', 'PSAVC', 'A2002'),
('0xa9,0x47,0x56,0xc1', 'Thu', '10:00:00', 'DSBM', 'A2002'),
('0xa9,0x47,0x56,0xc1', 'Thu', '12:00:00', 'TD', 'A2002'),
('0xa9,0x47,0x56,0xc1', 'Fri', '10:00:00', 'PSAVC', 'A2002'),
('0xa9,0x47,0x56,0xc1', 'Fri', '12:00:00', 'RP', 'A2002');

--
-- Índexs per a les taules bolcades
--

--
-- Índexs per a la taula `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
