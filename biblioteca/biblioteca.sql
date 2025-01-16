-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 16, 2025 alle 12:05
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biblioteca`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `autori`
--

CREATE TABLE `autori` (
  `ID_Autore` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Cognome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `autori`
--

INSERT INTO `autori` (`ID_Autore`, `Nome`, `Cognome`) VALUES
(1, 'Oscar', 'Wilde'),
(2, 'Charles', 'Baudelaire'),
(4, 'Luca', 'Camilotti'),
(5, 'Paolo', 'De Piccoli'),
(6, 'Noah', 'Santin'),
(7, 'Roberto', 'Basso'),
(8, 'Roberto', 'Bastasin'),
(9, 'Gabriel', 'Mandra'),
(10, 'Leopoldo', 'Izzo');

-- --------------------------------------------------------

--
-- Struttura della tabella `libri`
--

CREATE TABLE `libri` (
  `ID_Libro` int(11) NOT NULL,
  `Titolo` varchar(50) NOT NULL,
  `FK_ID_Autore` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `libri`
--

INSERT INTO `libri` (`ID_Libro`, `Titolo`, `FK_ID_Autore`) VALUES
(1, 'Guida al C#', 4),
(2, 'L\'Albatro', 2),
(3, 'Perdita dell\'Aureola', 2),
(4, 'Il ritratto di Dorian Gray', 1),
(5, 'Cisco ITN', 5),
(6, 'Guida a Windows Server', 7),
(7, 'Biografia Andrea Rotolo', 8),
(8, 'Come hackerare i tuoi vicini', 10),
(9, 'Come NON scegliere le componenti di un PC nel 2025', 10),
(10, 'Come investire 10k euro e perdere tutto', 6),
(11, 'Il codice di Mandra', 9);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `autori`
--
ALTER TABLE `autori`
  ADD PRIMARY KEY (`ID_Autore`);

--
-- Indici per le tabelle `libri`
--
ALTER TABLE `libri`
  ADD PRIMARY KEY (`ID_Libro`),
  ADD KEY `FK_ID_Autore` (`FK_ID_Autore`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `autori`
--
ALTER TABLE `autori`
  MODIFY `ID_Autore` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `libri`
--
ALTER TABLE `libri`
  MODIFY `ID_Libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `libri`
--
ALTER TABLE `libri`
  ADD CONSTRAINT `pippo` FOREIGN KEY (`FK_ID_Autore`) REFERENCES `autori` (`ID_Autore`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
