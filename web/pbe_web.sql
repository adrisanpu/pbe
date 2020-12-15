-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Temps de generació: 15-12-2020 a les 12:25:54
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
  `uid` varchar(16) NOT NULL,
  `subject` varchar(10) NOT NULL,
  `name` varchar(40) NOT NULL,
  `mark` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Bolcament de dades per a la taula `marks`
--

INSERT INTO `marks` (`uid`, `subject`, `name`, `mark`) VALUES
('95F15CAB', 'RP', 'Examen Parcial', 10),
('95F15CAB', 'DSBM', 'Examen Final', 8),
('95F15CAB', 'PSAVC', 'Entregable', 6),
('95F15CAB', 'PBE', 'Examen Parcial', 4),
('95F15CAB', 'TD', 'Tasca 2', 2),
('A94756C1', 'RP', 'Examen Final', 10),
('A94756C1', 'DSBM', 'Examen Parcial', 8),
('A94756C1', 'PSAVC', 'Tasca 3', 6),
('A94756C1', 'TD', 'Examen Final', 5),
('A94756C1', 'PBE', 'Entregable', 3),
('373780B5', 'RP', 'Examen Parcial', 9),
('373780B5', 'DSBM', 'Tasca 1', 8),
('373780B5', 'LAB RP', 'Memòria 2', 6),
('373780B5', 'LAB PBE', 'Estudi Previ 3', 7),
('373780B5', 'PSAVC', 'Examen Final', 4),
('890C769C', 'TD', 'Examen Parcial', 10),
('890C769C', 'PSAVC', 'Examen Final', 8),
('890C769C', 'DSBM', 'Tasca 2', 7),
('890C769C', 'LAB RP', 'Memòria 3', 6),
('890C769C', 'LAB DSBM', 'Memòria 1', 3),
('4A14F63F', 'DSBM', 'Examen Parcial', 9),
('4A14F63F', 'LAB PBE', 'Estudi Previ 4', 8),
('4A14F63F', 'LAB DSBM', 'Memòria 4', 6),
('4A14F63F', 'TD', 'Examen Final', 5),
('4A14F63F', 'PSAVC', 'Entregable', 4);

-- --------------------------------------------------------

--
-- Estructura de la taula `students`
--

CREATE TABLE `students` (
  `uid` varchar(10) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Bolcament de dades per a la taula `students`
--

INSERT INTO `students` (`uid`, `nom`, `username`, `password`) VALUES
('373780B5', 'Joan Plana Sala', NULL, NULL),
('4A14F63F', 'Adulfo Páez Chipont', NULL, NULL),
('890C769C', 'Alejandro Silva Pavón', NULL, NULL),
('95F15CAB', 'Francesc Xavier Canals Reynés', NULL, NULL),
('A94756C1', 'Adria Sanchez Puig', 'adrisanpu', 'pbe2020');

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
('A94756C1', '2020-11-19', 'RP', 'Examen Parcial'),
('A94756C1', '2020-11-21', 'PBE', 'Entregable'),
('A94756C1', '2020-11-25', 'PSAVC', 'Tasca 2'),
('A94756C1', '2020-11-28', 'DSBM', 'Examen Parcial'),
('95F15CAB', '2020-11-30', 'LAB DSBM', 'Memòria 3'),
('95F15CAB', '2020-12-02', 'TD', 'Examen Parcial'),
('95F15CAB', '2020-12-05', 'LAB PBE', 'Critical Design Report'),
('95F15CAB', '2021-01-08', 'PSAVC', 'Examen Final'),
('95F15CAB', '2021-01-13', 'TD', 'Examen Final'),
('95F15CAB', '2021-01-17', 'DSBM', 'Examen Final'),
('890C769C', '2020-11-19', 'RP', 'Examen Parcial'),
('890C769C', '2020-11-21', 'PBE', 'Entregable'),
('890C769C', '2020-11-25', 'PSAVC', 'Tasca 2'),
('890C769C', '2020-11-28', 'DSBM', 'Examen Parcial'),
('890C769C', '2020-11-30', 'LAB DSBM', 'Memòria 3'),
('4A14F63F', '2020-12-02', 'TD', 'Examen Parcial'),
('4A14F63F', '2020-12-05', 'LAB PBE', 'Critical Design Report'),
('4A14F63F', '2021-01-08', 'PSAVC', 'Examen Final'),
('4A14F63F', '2021-01-13', 'TD', 'Examen Final'),
('4A14F63F', '2021-01-17', 'DSBM', 'Examen Final'),
('373780B5', '2020-11-30', 'LAB DSBM', 'Memòria 3'),
('373780B5', '2020-12-02', 'TD', 'Examen Parcial'),
('373780B5', '2020-12-05', 'LAB PBE', 'Critical Design Report'),
('373780B5', '2021-01-08', 'PSAVC', 'Examen Final'),
('373780B5', '2021-01-13', 'TD', 'Examen Final'),
('373780B5', '2021-01-17', 'DSBM', 'Examen Final');

-- --------------------------------------------------------

--
-- Estructura de la taula `timetables`
--

CREATE TABLE `timetables` (
  `uid` varchar(16) NOT NULL,
  `day` varchar(3) NOT NULL,
  `hour` time NOT NULL,
  `subject` varchar(10) NOT NULL,
  `room` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Bolcament de dades per a la taula `timetables`
--

INSERT INTO `timetables` (`uid`, `day`, `hour`, `subject`, `room`) VALUES
('95F15CAB', 'Mon', '08:00:00', 'LAB RP', 'D3006'),
('95F15CAB', 'Mon', '10:00:00', 'TD', 'A2002'),
('95F15CAB', 'Mon', '13:00:00', 'DSBM', 'A2002'),
('95F15CAB', 'Tue', '08:00:00', 'LAB DSBM', 'C5S101A'),
('95F15CAB', 'Tue', '10:00:00', 'PSAVC', 'A2002'),
('95F15CAB', 'Tue', '11:00:00', 'LAB PBE', 'A4101'),
('95F15CAB', 'Wed', '08:00:00', 'PBE', 'A2002'),
('95F15CAB', 'Wed', '10:00:00', 'RP', 'A2002'),
('95F15CAB', 'Wed', '12:00:00', 'PSAVC', 'A2002'),
('95F15CAB', 'Thu', '10:00:00', 'DSBM', 'A2002'),
('95F15CAB', 'Thu', '12:00:00', 'TD', 'A2002'),
('95F15CAB', 'Fri', '10:00:00', 'PSAVC', 'A2002'),
('95F15CAB', 'Fri', '12:00:00', 'RP', 'A2002'),
('890C769C', 'Mon', '08:00:00', 'RP', 'A4101'),
('890C769C', 'Mon', '10:00:00', 'PSAVC', 'A4101'),
('890C769C', 'Mon', '12:00:00', 'LAB RP', 'D3006'),
('890C769C', 'Tue', '08:00:00', 'TD', 'A4101'),
('890C769C', 'Tue', '11:00:00', 'LAB PBE', 'A4101'),
('890C769C', 'Wed', '08:00:00', 'PBE', 'A4001'),
('890C769C', 'Wed', '10:00:00', 'DSBM', 'A4101'),
('890C769C', 'Wed', '12:00:00', 'LAB DSBM', 'C5S101A'),
('890C769C', 'Thu', '08:00:00', 'PSAVC', 'A4001'),
('890C769C', 'Thu', '10:00:00', 'RP', 'A4101'),
('890C769C', 'Fri', '08:00:00', 'TD', 'A4101'),
('890C769C', 'Fri', '10:00:00', 'PSAVC', 'A4101'),
('890C769C', 'Fri', '11:00:00', 'DSBM', 'A4101'),
('4A14F63F', 'Mon', '08:00:00', 'RP', 'A4101'),
('4A14F63F', 'Mon', '10:00:00', 'PSAVC', 'A4101'),
('4A14F63F', 'Mon', '12:00:00', 'LAB RP', 'D3006'),
('4A14F63F', 'Tue', '08:00:00', 'TD', 'A4101'),
('4A14F63F', 'Tue', '11:00:00', 'LAB PBE', 'A4101'),
('4A14F63F', 'Wed', '08:00:00', 'PBE', 'A4001'),
('4A14F63F', 'Wed', '10:00:00', 'DSBM', 'A4101'),
('4A14F63F', 'Wed', '12:00:00', 'LAB DSBM', 'C5S101A'),
('4A14F63F', 'Thu', '08:00:00', 'PSAVC', 'A4001'),
('4A14F63F', 'Thu', '10:00:00', 'RP', 'A4101'),
('4A14F63F', 'Fri', '08:00:00', 'TD', 'A4101'),
('4A14F63F', 'Fri', '10:00:00', 'PSAVC', 'A4101'),
('4A14F63F', 'Fri', '11:00:00', 'DSBM', 'A4101'),
('A94756C1', 'Mon', '08:00:00', 'LAB RP', 'D3006'),
('A94756C1', 'Mon', '10:00:00', 'TD', 'A2002'),
('A94756C1', 'Mon', '13:00:00', 'DSBM', 'A2002'),
('A94756C1', 'Tue', '08:00:00', 'LAB DSBM', 'C5S101A'),
('A94756C1', 'Tue', '10:00:00', 'PSAVC', 'A2002'),
('A94756C1', 'Tue', '11:00:00', 'LAB PBE', 'A4101'),
('A94756C1', 'Wed', '08:00:00', 'PBE', 'A2002'),
('A94756C1', 'Wed', '10:00:00', 'RP', 'A2002'),
('A94756C1', 'Wed', '12:00:00', 'PSAVC', 'A2002'),
('A94756C1', 'Thu', '10:00:00', 'DSBM', 'A2002'),
('A94756C1', 'Thu', '12:00:00', 'TD', 'A2002'),
('A94756C1', 'Fri', '10:00:00', 'PSAVC', 'A2002'),
('A94756C1', 'Fri', '12:00:00', 'RP', 'A2002'),
('373780B5', 'Mon', '08:00:00', 'LAB RP', 'D3006'),
('373780B5', 'Mon', '10:00:00', 'TD', 'A4101'),
('373780B5', 'Mon', '13:00:00', 'DSBM', 'A4101'),
('373780B5', 'Tue', '08:00:00', 'LAB DSBM', 'C5S101A'),
('373780B5', 'Tue', '10:00:00', 'PSAVC', 'A4101'),
('373780B5', 'Tue', '11:00:00', 'LAB PBE', 'A4101'),
('373780B5', 'Wed', '08:00:00', 'PBE', 'A4001'),
('373780B5', 'Wed', '10:00:00', 'RP', 'A4101'),
('373780B5', 'Wed', '12:00:00', 'PSAVC', 'A4101'),
('373780B5', 'Thu', '10:00:00', 'DSBM', 'A4101'),
('373780B5', 'Thu', '12:00:00', 'TD', 'A4101'),
('373780B5', 'Fri', '10:00:00', 'PSAVC', 'A4101'),
('373780B5', 'Fri', '12:00:00', 'RP', 'A4101');

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
