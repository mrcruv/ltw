-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 29, 2022 alle 21:02
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

CREATE TABLE IF NOT EXISTS `competenze_esperti`
(
    `esperto`     varchar(30)  NOT NULL,
    `competenza`  varchar(255) NOT NULL,
    `settore`     varchar(255) NOT NULL,
    `descrizione` text DEFAULT NULL,
    PRIMARY KEY (`esperto`, `competenza`, `settore`) USING BTREE,
    KEY `esperto` (`esperto`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `assegnazioni`
--

CREATE TABLE IF NOT EXISTS `assegnazioni`
(
    `processo`          varchar(255) NOT NULL,
    `ente`              varchar(30)  NOT NULL,
    `esperto`           varchar(30)  NOT NULL,
    `data_richiesta`    date         NOT NULL DEFAULT current_timestamp(),
    `data_assegnazione` date                  DEFAULT NULL,
    `data_rifiuto`      date                  DEFAULT NULL,
    PRIMARY KEY (`processo`, `ente`, `esperto`),
    KEY `esperto` (`esperto`),
    KEY `processo` (`processo`, `ente`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `enti`
--

CREATE TABLE IF NOT EXISTS `enti`
(
    `username`      varchar(30)                 NOT NULL,
    `denominazione` varchar(50)                 NOT NULL,
    `tipo`          enum ('pubblico','privato') NOT NULL,
    PRIMARY KEY (`username`),
    UNIQUE KEY `denominazione` (`denominazione`),
    KEY `username` (`username`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `esperti`
--

CREATE TABLE IF NOT EXISTS `esperti`
(
    `username`      varchar(30)  NOT NULL,
    `nome`          varchar(255) NOT NULL,
    `cognome`       varchar(255) NOT NULL,
    `citta_nascita` varchar(255) NOT NULL,
    `data_nascita`  date         NOT NULL,
    PRIMARY KEY (`username`),
    KEY `username` (`username`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `processi`
--

CREATE TABLE IF NOT EXISTS `processi`
(
    `nome`             varchar(255) NOT NULL,
    `ente`             varchar(30)  NOT NULL,
    `tipologia`        varchar(255) NOT NULL,
    `descrizione`      text         NOT NULL,
    PRIMARY KEY (`nome`, `ente`),
    KEY `ente` (`ente`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `titoli_esperti`
--

CREATE TABLE IF NOT EXISTS `titoli_esperti`
(
    `esperto`            varchar(30)  NOT NULL,
    `titolo`             varchar(255) NOT NULL,
    `data_conseguimento` date        DEFAULT NULL,
    `note`               text        DEFAULT NULL,
    `voto`               smallint(6) DEFAULT NULL,
    PRIMARY KEY (`esperto`, `titolo`),
    KEY `esperto` (`esperto`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE IF NOT EXISTS `utenti`
(
    `username` varchar(30)  NOT NULL,
    `password` varchar(60)  NOT NULL,
    `piva`     char(11)     NOT NULL,
    `cf`       varchar(16)  NOT NULL,
    `sito_web` varchar(255) DEFAULT NULL,
    `pec`      varchar(255) NOT NULL,
    PRIMARY KEY (`username`),
    UNIQUE KEY `piva` (`piva`),
    UNIQUE KEY `cf` (`cf`),
    UNIQUE KEY `pec` (`pec`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `competenze_esperti`
--
ALTER TABLE `competenze_esperti`
    ADD CONSTRAINT `competenze_esperti_ibfk_1` FOREIGN KEY (`esperto`) REFERENCES `esperti` (`username`);

--
-- Limiti per la tabella `assegnazioni`
--
ALTER TABLE `assegnazioni`
    ADD CONSTRAINT `assegnazioni_ibfk_1` FOREIGN KEY (`processo`, `ente`) REFERENCES `processi` (`nome`, `ente`),
    ADD CONSTRAINT `assegnazioni_ibfk_2` FOREIGN KEY (`esperto`) REFERENCES `esperti` (`username`);

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
