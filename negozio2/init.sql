-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Creato il: Gen 25, 2019 alle 09:16
-- Versione del server: 10.0.17-MariaDB
-- Versione PHP: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `negozio`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `clienti`
--

CREATE TABLE `clienti` (
  `idCliente` int(11) NOT NULL,
  `cognome` varchar(20) NOT NULL,
  `nome` varchar(20) DEFAULT NULL,
  `indirizzo` varchar(50) DEFAULT NULL,
  `citta` varchar(20) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `clienti`
--

INSERT INTO `clienti` (`idCliente`, `cognome`, `nome`, `indirizzo`, `citta`, `telefono`) VALUES
(1, 'Rosso', 'Mario', 'Via delle Ginestre, 3', 'Porcia', '3422536455'),
(2, 'Verdacci', 'Mariella', 'Via del Platano, 5', 'Porcia', NULL),
(3, 'Gardi', 'Alice', 'Via dei Papaveri, 7', 'Pordenone', '3335273877');

-- --------------------------------------------------------

--
-- Struttura della tabella `modelli`
--

CREATE TABLE `modelli` (
  `idMod` int(11) NOT NULL,
  `desMod` char(10) DEFAULT NULL,
  `tipoLegno` char(10) DEFAULT NULL,
  `colore` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `modelli`
--

INSERT INTO `modelli` (`idMod`, `desMod`, `tipoLegno`, `colore`) VALUES
(1, 'des1', 'faggio', 'bianco'),
(2, 'mod2', 'acero', 'rosso'),
(3, 'mod3', 'acero', 'verde'),
(4, 'mod4', 'acero', 'blu'),
(5, 'mod5', 'noce', 'bianco'),
(6, 'mod6', 'noce', 'nero');

-- --------------------------------------------------------

--
-- Struttura della tabella `vendite`
--

CREATE TABLE `vendite` (
  `idVendita` int(11) NOT NULL,
  `cliente` int(11) DEFAULT NULL,
  `dataVendita` date DEFAULT NULL,
  `modello` int(11) DEFAULT NULL,
  `prezzo` decimal(7,2) DEFAULT NULL,
  `agente` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `vendite`
--

INSERT INTO `vendite` (`idVendita`, `cliente`, `dataVendita`, `modello`, `prezzo`, `agente`) VALUES
(1, 1, '2011-10-01', 1, '500.00', 'Maria'),
(3, 1, '2011-10-01', 1, '500.00', 'Maria'),
(4, 2, '2019-01-25', 2, '20.00', 'Bianchi'),
(5, 2, '2019-01-25', 3, '30.00', 'Verdacci'),
(6, 3, '2019-01-25', 4, '40.00', 'Bianchi'),
(7, 3, '2019-01-25', 5, '50.00', 'Bianchi');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `clienti`
--
ALTER TABLE `clienti`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indici per le tabelle `modelli`
--
ALTER TABLE `modelli`
  ADD PRIMARY KEY (`idMod`);

--
-- Indici per le tabelle `vendite`
--
ALTER TABLE `vendite`
  ADD PRIMARY KEY (`idVendita`),
  ADD KEY `cliente` (`cliente`),
  ADD KEY `modello` (`modello`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `clienti`
--
ALTER TABLE `clienti`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT per la tabella `modelli`
--
ALTER TABLE `modelli`
  MODIFY `idMod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT per la tabella `vendite`
--
ALTER TABLE `vendite`
  MODIFY `idVendita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `vendite`
--
ALTER TABLE `vendite`
  ADD CONSTRAINT `vendite_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `clienti` (`idCliente`),
  ADD CONSTRAINT `vendite_ibfk_2` FOREIGN KEY (`modello`) REFERENCES `modelli` (`idMod`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
