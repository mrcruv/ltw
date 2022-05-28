-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 23, 2022 alle 11:46
-- Versione del server: 10.4.24-MariaDB
-- Versione PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `competenze_esperti`
--

CREATE
OR
REPLACE TABLE `competenze_esperti` (
                                      `esperto` varchar(30) NOT NULL,
                                      `competenza` varchar(255) NOT NULL,
                                      `settore` varchar(255) NOT NULL,
                                      `descrizione` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `diplomi`
--

CREATE
OR
REPLACE TABLE `diplomi` (
                           `titolo` varchar(255) NOT NULL,
                           `tipo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `disponibilita`
--

CREATE
OR
REPLACE TABLE `disponibilita` (
                                 `processo` varchar(255) NOT NULL,
                                 `ente` varchar(30) NOT NULL,
                                 `esperto` varchar(30) NOT NULL,
                                 `data_richiesta` date NOT NULL DEFAULT current_timestamp(),
                                 `data_assegnazione` date DEFAULT NULL,
                                 `data_rifiuto` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `enti`
--

CREATE
OR
REPLACE TABLE `enti` (
                        `username` varchar(30) NOT NULL,
                        `denominazione` varchar(50) NOT NULL,
                        `tipo` enum('pubblico','privato') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `enti`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `esperti`
--

CREATE
OR
REPLACE TABLE `esperti` (
                           `username` varchar(30) NOT NULL,
                           `nome` varchar(255) NOT NULL,
                           `cognome` varchar(255) NOT NULL,
                           `citta_nascita` varchar(255) NOT NULL,
                           `data_nascita` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `lauree`
--

CREATE
OR
REPLACE TABLE `lauree` (
                          `titolo` varchar(255) NOT NULL,
                          `tipo` enum('triennale','magistrale','a ciclo unico') NOT NULL,
                          `classe` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `processi`
--

CREATE
OR
REPLACE TABLE `processi` (
                            `nome` varchar(255) NOT NULL,
                            `ente` varchar(30) NOT NULL,
                            `data_conclusione` date DEFAULT NULL,
                            `tipologia` varchar(255) NOT NULL,
                            `descrizione` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `titoli_esperti`
--

CREATE
OR
REPLACE TABLE `titoli_esperti` (
                                  `esperto` varchar(30) NOT NULL,
                                  `titolo` varchar(255) NOT NULL,
                                  `data_conseguimento` date DEFAULT NULL,
                                  `note` text DEFAULT NULL,
                                  `voto` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Struttura della tabella `utenti`
--

CREATE
OR
REPLACE TABLE `utenti` (
                          `username` varchar(30) NOT NULL,
                          `password` varchar(60) NOT NULL,
                          `piva` char(11) NOT NULL,
                          `cf` varchar(16) NOT NULL,
                          `sito_web` varchar(255) DEFAULT NULL,
                          `pec` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `competenze_esperti`
--
ALTER TABLE `competenze_esperti`
    ADD PRIMARY KEY (`esperto`, `competenza`, `settore`) USING BTREE,
    ADD KEY `esperto` (`esperto`);

--
-- Indici per le tabelle `diplomi`
--
ALTER TABLE `diplomi`
    ADD PRIMARY KEY (`titolo`);

--
-- Indici per le tabelle `disponibilita`
--
ALTER TABLE `disponibilita`
    ADD PRIMARY KEY (`processo`, `ente`, `esperto`),
    ADD KEY `esperto` (`esperto`),
    ADD KEY `processo` (`processo`, `ente`);

--
-- Indici per le tabelle `enti`
--
ALTER TABLE `enti`
    ADD PRIMARY KEY (`username`),
    ADD UNIQUE KEY `denominazione` (`denominazione`),
    ADD KEY `username` (`username`);

--
-- Indici per le tabelle `esperti`
--
ALTER TABLE `esperti`
    ADD PRIMARY KEY (`username`),
    ADD KEY `username` (`username`);

--
-- Indici per le tabelle `lauree`
--
ALTER TABLE `lauree`
    ADD PRIMARY KEY (`titolo`);

--
-- Indici per le tabelle `processi`
--
ALTER TABLE `processi`
    ADD PRIMARY KEY (`nome`, `ente`),
    ADD KEY `ente` (`ente`);

--
-- Indici per le tabelle `titoli_esperti`
--
ALTER TABLE `titoli_esperti`
    ADD PRIMARY KEY (`esperto`, `titolo`),
    ADD KEY `esperto` (`esperto`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
    ADD PRIMARY KEY (`username`),
    ADD UNIQUE KEY `piva` (`piva`),
    ADD UNIQUE KEY `cf` (`cf`),
    ADD UNIQUE KEY `pec` (`pec`);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `competenze_esperti`
--
ALTER TABLE `competenze_esperti`
    ADD CONSTRAINT `competenze_esperti_ibfk_1` FOREIGN KEY (`esperto`) REFERENCES `esperti` (`username`);

--
-- Limiti per la tabella `disponibilita`
--
ALTER TABLE `disponibilita`
    ADD CONSTRAINT `disponibilita_ibfk_1` FOREIGN KEY (`processo`, `ente`) REFERENCES `processi` (`nome`, `ente`),
    ADD CONSTRAINT `disponibilita_ibfk_2` FOREIGN KEY (`esperto`) REFERENCES `esperti` (`username`);

--
-- Limiti per la tabella `enti`
--
ALTER TABLE `enti`
    ADD CONSTRAINT `enti_ibfk_1` FOREIGN KEY (`username`) REFERENCES `utenti` (`username`);

--
-- Limiti per la tabella `esperti`
--
ALTER TABLE `esperti`
    ADD CONSTRAINT `esperti_ibfk_1` FOREIGN KEY (`username`) REFERENCES `utenti` (`username`);

--
-- Limiti per la tabella `processi`
--
ALTER TABLE `processi`
    ADD CONSTRAINT `processi_ibfk_1` FOREIGN KEY (`ente`) REFERENCES `enti` (`username`);

--
-- Limiti per la tabella `titoli_esperti`
--
ALTER TABLE `titoli_esperti`
    ADD CONSTRAINT `titoli_esperti_ibfk_1` FOREIGN KEY (`esperto`) REFERENCES `esperti` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
