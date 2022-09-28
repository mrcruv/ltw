-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 29, 2022 alle 21:03
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

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`username`, `password`, `piva`, `cf`, `sito_web`, `pec`)
VALUES ('ente1', '$2y$10$qWivSsC2/jEmSZ7GTU5IuOAcbBYQfPfFSFgpi/sBe4Hie9gOomDES', '00000000001', 'AAAANT00A00A001A',
        'https://www.ente1.it', 'ente1@pec.it'),
       ('ente2', '$2y$10$/IXLsYqvS80k0UD0DxyXsuvhWXkebYdqm3XBS/rZquieJrA/cC5Fe', '00000000002', 'AAAANT00A00A002A',
        'http://www.ente2.it', 'ente2@pec.it'),
       ('ente3', '$2y$10$ayIIySBCUdEOks2CuE6GveWASou8.wJakC6/ipHLLspdjQ7xUCs2m', '00000000003', 'AAAANT00A00A003A',
        'http://www.ente3.it', 'ente3@pec.it'),
       ('ente4', '$2y$10$28qELMutGBR8HikP4xvbc.wvChBpg4X7IQck3owTlyCBEm11alHvy', '00000000004', 'AAAANT00A00A004A',
        NULL, 'ente4@pec.it'),
       ('ente5', '$2y$10$noqDyhCKgcXPUu/uPsLt2OcVqpRiEIhRr36TXBwIQ./k9C8piEjWW', '00000000005', 'AAAANT00A00A005A',
        'http://www.ente5.it', 'ente5@pec.it'),
       ('esperto1', '$2y$10$V.H092BazNw9aV29wSkZ8eGUIjibKWsHfyoWtbiECh.3inJnji5QO', '10000000001', 'AASPRT00A00A001A',
        'http://www.esperto1.it', 'esperto1@pec.it'),
       ('esperto2', '$2y$10$BAvs6gUfdecTN5PVV/SrwOB1gWr2P1y3ShOT/LosrT/2b5J./NnRa', '10000000002', 'AASPRT00A00A002A',
        NULL, 'esperto2@pec.it'),
       ('esperto3', '$2y$10$imcrzBua0PH0gg8LlDbMee4VlOPjAVCJn1Rj/5A.sZh8AlAebvHS6', '10000000003', 'AASPRT00A00A003A',
        'http://www.esperto3.it', 'esperto3@pec.it'),
       ('esperto4', '$2y$10$1B0q9rG04g9PtRHKq91tVuoAl4zUr2kLJZSdfV2IGMRLhiIBrojf2', '10000000004', 'AASPRT00A00A004A',
        'http://www.esperto4.it', 'esperto4@pec.it'),
       ('esperto5', '$2y$10$rDa2umYteu9mhhkk/HSTh.MrKOBymiczVZeeEMWPvYkRAcWE.7b7e', '10000000005', 'AASPRT00A00A005A',
        'http://www.esperto5.it', 'esperto5@pec.it'),
       ('esperto6', '$2y$10$Hf5pQdMnDXiBZcEMHxK07.SJTOwwg9A4o9gPeZDawZFGJ4HXcgoXK', '10000000006', 'AASPRT00A00A006A',
        'http://www.esperto6.it', 'esperto6@pec.it'),
       ('esperto7', '$2y$10$E6.T6AjiJ0ryqdRUisV2IO7XftmHXuzQrAM4bolu405Qpm43cDsPO', '10000000007', 'AASPRT00A00A007A',
        'http://www.esperto7.it', 'esperto7@pec.it');

--
-- Dump dei dati per la tabella `enti`
--

INSERT INTO `enti` (`username`, `denominazione`, `tipo`)
VALUES ('ente1', 'Ente1', 'privato'),
       ('ente2', 'Ente2', 'pubblico'),
       ('ente3', 'Ente3', 'privato'),
       ('ente4', 'Ente4', 'privato'),
       ('ente5', 'Ente5', 'privato');

--
-- Dump dei dati per la tabella `processi`
--

INSERT INTO `processi` (`nome`, `ente`, `tipologia`, `descrizione`)
VALUES ('processo1', 'ente1', 'informatico', 'processo informatico'),
       ('processo10', 'ente1', 'aziendale', 'processo aziendale'),
       ('processo2', 'ente2', 'aziendale', 'processo aziendale'),
       ('processo3', 'ente2', 'economico', 'processo economico'),
       ('processo4', 'ente2', 'giuridico', 'processo giuridico'),
       ('processo5', 'ente1', 'aziendale', 'processo aziendale'),
       ('processo6', 'ente1', 'informatico', 'processo informatico'),
       ('processo7', 'ente4', 'industriale', 'processo industriale'),
       ('processo8', 'ente4', 'formativo', 'processo formativo'),
       ('processo9', 'ente5', 'commerciale', 'processo commerciale');

--
-- Dump dei dati per la tabella `esperti`
--

INSERT INTO `esperti` (`username`, `nome`, `cognome`, `citta_nascita`, `data_nascita`)
VALUES ('esperto1', 'Esperto', 'Uno', 'Roma', '1995-02-11'),
       ('esperto2', 'Esperto', 'Due', 'Milano', '1991-05-14'),
       ('esperto3', 'Esperto', 'Tre', 'Torino', '2000-09-19'),
       ('esperto4', 'Esperto', 'Quattro', 'Bari', '1986-07-25'),
       ('esperto5', 'Esperto', 'Cinque', 'Palermo', '1994-07-21'),
       ('esperto6', 'Esperto', 'Sei', 'Firenze', '1994-02-02'),
       ('esperto7', 'Esperto', 'Sette', 'Frosinone', '2001-02-11');

--
-- Dump dei dati per la tabella `competenze_esperti`
--

INSERT INTO `competenze_esperti` (`esperto`, `competenza`, `settore`, `descrizione`)
VALUES ('esperto1', 'Linux', 'informatico', NULL),
       ('esperto3', 'Office', 'informatico', 'elaborazione testi, fogli di calcolo, presentazioni'),
       ('esperto4', 'MySQL', 'informatico', NULL),
       ('esperto5', 'Business model plan', 'economico', NULL);

--
-- Dump dei dati per la tabella `assegnazioni`
--

INSERT INTO `assegnazioni` (`processo`, `ente`, `esperto`, `data_richiesta`, `data_assegnazione`, `data_rifiuto`)
VALUES ('processo1', 'ente1', 'esperto1', '2022-05-29', NULL, NULL),
       ('processo1', 'ente1', 'esperto2', '2022-05-20', NULL, NULL),
       ('processo1', 'ente1', 'esperto3', '2022-05-16', '2022-05-21', NULL),
       ('processo1', 'ente1', 'esperto4', '2022-05-16', '2022-05-25', NULL),
       ('processo10', 'ente1', 'esperto3', '2022-05-28', NULL, NULL),
       ('processo10', 'ente1', 'esperto4', '2022-05-25', NULL, NULL),
       ('processo2', 'ente2', 'esperto4', '2022-05-16', NULL, '2022-05-23'),
       ('processo3', 'ente2', 'esperto4', '2022-05-16', '2022-05-23', NULL),
       ('processo3', 'ente2', 'esperto6', '2022-05-26', NULL, NULL),
       ('processo4', 'ente2', 'esperto4', '2022-05-16', NULL, '2022-05-28'),
       ('processo5', 'ente1', 'esperto4', '2022-05-22', NULL, '2022-05-23'),
       ('processo5', 'ente1', 'esperto7', '2022-05-23', NULL, NULL),
       ('processo6', 'ente1', 'esperto4', '2022-05-25', '2022-05-25', NULL),
       ('processo6', 'ente1', 'esperto5', '2022-05-28', NULL, NULL),
       ('processo7', 'ente4', 'esperto3', '2022-05-26', NULL, NULL),
       ('processo7', 'ente4', 'esperto6', '2022-05-26', NULL, NULL),
       ('processo8', 'ente4', 'esperto7', '2022-05-26', '2022-05-26', NULL);

--
-- Dump dei dati per la tabella `titoli_esperti`
--

INSERT INTO `titoli_esperti` (`esperto`, `titolo`, `data_conseguimento`, `note`, `voto`)
VALUES ('esperto1', 'laurea in ingegneria informatica e automatica', '2022-05-03',
        'tesi sulle applicazioni del reinforcement learning in ambito finanziario', 102),
       ('esperto1', 'laurea in ingegneria meccanica', '2022-05-03', 'tesi sulle applicazioni della meccanica', 100),
       ('esperto2', 'laurea in economia e commercio', '2022-05-03', 'tesi sulla break-even analysis', 110),
       ('esperto3', 'diploma di liceo scientifico', '2021-11-19', 'indirizzo sportivo', 88),
       ('esperto4', 'laurea in ingegneria chimica', '2022-05-05', '', 100),
       ('esperto6', 'dottorato di ricerca in filosofia', '2021-02-26',
        'tesi di dottorato pubblicata su rivista accademica', 110),
       ('esperto6', 'laurea in lettere e filosofia', '2016-01-26', 'tesi sul naturalismo', 110),
       ('esperto6', 'laurea in lettere moderne', '2018-08-26',
        'tesi sul ruolo della semiotica nella letteratura di tardo 1900', 110);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
