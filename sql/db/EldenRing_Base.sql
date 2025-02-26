CREATE DATABASE IF NOT EXISTS `eldenring` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION = 'N' */;
USE `eldenring`;
-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: eldenring
-- ------------------------------------------------------
-- Server version	8.0.39

/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE = @@TIME_ZONE */;
/*!40103 SET TIME_ZONE = '+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS = @@UNIQUE_CHECKS, UNIQUE_CHECKS = 0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS = 0 */;
/*!40101 SET @OLD_SQL_MODE = @@SQL_MODE, SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES = @@SQL_NOTES, SQL_NOTES = 0 */;

--
-- Table structure for table `armi`
--

DROP TABLE IF EXISTS `armi`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `armi`
(
    `id_arma`      int                                    NOT NULL AUTO_INCREMENT,
    `nome`         text COLLATE utf8mb4_general_ci        NOT NULL,
    `descrizione`  text COLLATE utf8mb4_general_ci        NOT NULL,
    `immagine`     text COLLATE utf8mb4_general_ci        NOT NULL,
    `id_categoria` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
    `peso`         decimal(3, 1)                          NOT NULL,
    `ottenimento`  text COLLATE utf8mb4_general_ci        NOT NULL,
    PRIMARY KEY (`id_arma`),
    KEY `id_categoria` (`id_categoria`),
    CONSTRAINT `armi_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorie` (`id_categoria`) ON UPDATE CASCADE
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `armi`
--

LOCK TABLES `armi` WRITE;
/*!40000 ALTER TABLE `armi`
    DISABLE KEYS */;
/*!40000 ALTER TABLE `armi`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `armieffetti`
--

DROP TABLE IF EXISTS `armieffetti`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `armieffetti`
(
    `id_arma`      int                                    NOT NULL,
    `nome_effetto` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
    `valore`       int                                    NOT NULL,
    PRIMARY KEY (`id_arma`, `nome_effetto`),
    KEY `nome_effetto` (`nome_effetto`),
    CONSTRAINT `armieffetti_ibfk_1` FOREIGN KEY (`id_arma`) REFERENCES `armi` (`id_arma`) ON UPDATE CASCADE,
    CONSTRAINT `armieffetti_ibfk_2` FOREIGN KEY (`nome_effetto`) REFERENCES `effettistato` (`nome`) ON UPDATE CASCADE
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `armieffetti`
--

LOCK TABLES `armieffetti` WRITE;
/*!40000 ALTER TABLE `armieffetti`
    DISABLE KEYS */;
/*!40000 ALTER TABLE `armieffetti`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attributi`
--

DROP TABLE IF EXISTS `attributi`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attributi`
(
    `id_attributo` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
    `nome`         varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
    PRIMARY KEY (`id_attributo`),
    UNIQUE KEY `nome` (`nome`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attributi`
--

LOCK TABLES `attributi` WRITE;
/*!40000 ALTER TABLE `attributi`
    DISABLE KEYS */;
INSERT INTO `attributi`
VALUES ('ARC', 'Arcano'),
       ('DES', 'Destrezza'),
       ('FED', 'Fede'),
       ('FOR', 'Forza'),
       ('INT', 'Intelligenza');
/*!40000 ALTER TABLE `attributi`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorie`
(
    `id_categoria` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
    `nome`         varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
    PRIMARY KEY (`id_categoria`),
    UNIQUE KEY `nome` (`nome`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorie`
--

LOCK TABLES `categorie` WRITE;
/*!40000 ALTER TABLE `categorie`
    DISABLE KEYS */;
INSERT INTO `categorie`
VALUES ('ALB', 'Alabarda'),
       ('ARC', 'Arco'),
       ('ARC_L', 'Arco leggero'),
       ('ARC_GR', 'Arco pesante'),
       ('ARM_C', 'Arma colossale'),
       ('ART_F', 'Artigli ferino'),
       ('ART', 'Artiglo'),
       ('ASC', 'Ascia'),
       ('ASC_GR', 'Ascia pesante'),
       ('BLS', 'Balestra'),
       ('BLS_GR', 'Balista'),
       ('BST_GL', 'Bastone di scintipietra'),
       ('BTP', 'Bottiglia di profumo'),
       ('COR_COR', 'Corpo a corpo'),
       ('DRD', 'Dardo'),
       ('DRD_GR', 'Dardo pesante'),
       ('FLC', 'Falce'),
       ('FLG', 'Flagello'),
       ('FRC', 'Freccia'),
       ('FRC_GR', 'Freccia pesante'),
       ('FRS', 'Frusta'),
       ('KAT', 'Katana'),
       ('KAT_GR', 'Katana gigante'),
       ('LML', 'Lama da lancio'),
       ('LMG', 'Lama gemella'),
       ('LMR', 'Lama rovesciata'),
       ('LNC', 'Lancia'),
       ('LNC_GR', 'Lancia pesante'),
       ('MRT', 'Martello'),
       ('MRT_GR', 'Martello da guerra'),
       ('DAG', 'Pugnale'),
       ('PUG', 'Pugno'),
       ('SCD_AF', 'Scudo da affondo'),
       ('SCD_M', 'Scudo medio'),
       ('SCD_GR', 'Scudo pesante'),
       ('SCD_P', 'Scudo piccolo'),
       ('SG_S', 'Sigillo sacro'),
       ('SPD_C', 'Spada curva'),
       ('SPD', 'Spada dritta'),
       ('SPD_PF', 'Spada perforante'),
       ('SPD_PF_P', 'Spada perforante pesante'),
       ('SPD_GR', 'Spadone'),
       ('SPD_CL', 'Spadone colossale'),
       ('SPD_GR_C', 'Spadone curvo'),
       ('SPD_L', 'Spadone leggero'),
       ('TRC', 'Torcia');
/*!40000 ALTER TABLE `categorie`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `effettistato`
--

DROP TABLE IF EXISTS `effettistato`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `effettistato`
(
    `nome`                  varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
    `descrizione`           text COLLATE utf8mb4_general_ci        NOT NULL,
    `icona`                 text COLLATE utf8mb4_general_ci        NOT NULL,
    `mitigato_da`           text COLLATE utf8mb4_general_ci,
    `curato_da`             text COLLATE utf8mb4_general_ci,
    `statistica_resistente` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
    `note`                  text COLLATE utf8mb4_general_ci,
    PRIMARY KEY (`nome`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `effettistato`
--

LOCK TABLES `effettistato` WRITE;
/*!40000 ALTER TABLE `effettistato`
    DISABLE KEYS */;
INSERT INTO `effettistato`
VALUES ('Assideramento', 'Riduce la velocità e infligge danni da freddo.', '../img/EffettiStato/Assideramento.jpg',
        'Invigorating Cured Meat, Stalwart Horn Charm', 'Bestial Constitution, Thawfrost Boluses', 'Robustness', ''),
       ('Avvelenamento', 'Infligge danni nel tempo e può causare altri effetti negativi.',
        '../img/EffettiStato/Veleno.jpg', 'Antidote, Purifying Herbs', 'Healing Potions, Detoxification',
        'Constitution', ''),
       ('Follia', 'Causa perdita di punti FP e danni alla mente.', '../img/EffettiStato/Follia.jpg',
        'Clarifying Cured Meat, Clarifying Horn Charm', 'Clarifying Boluses, Lucidity', 'Focus',
        'Influenza della Fiamma Frenzata.'),
       ('Marcescenza Scarlatta', 'Causa deterioramento fisico nel tempo.',
        '../img/EffettiStato/MarcescenzaScarlatta.jpg', 'Restoration Potions, Healing Spells', 'N/A', 'Constitution',
        'Effetto permanente se non curato.'),
       ('Morbo Mortale', 'Causa la morte istantanea', '../img/EffettiStato/MorboMortale.jpg',
        'Prince of Death\'s Pustule, Prince of Death\'s Cyst', 'Rejuvenating Boluses, Order Healing, Law of Regression',
        'Vitality', 'Solo su esseri umanoidi'),
       ('Sanguinamento', 'Causa danni nel tempo.', '../img/EffettiStato/Sanguinamento.jpg',
        'Invigorating Cured Meat, Stalwart Horn Charm', 'Stanching Boluses, Bestial Constitution', 'Robustness',
        'L\'effetto si accumula nel tempo.'),
       ('Sonno', 'Mette il bersaglio a dormire.', '../img/EffettiStato/Sonno.jpg',
        'Clarifying Cured Meat, Clarifying Horn Charm', 'Stimulating Boluses, Lucidity', 'Focus',
        'Può essere interrotto da danni.');
/*!40000 ALTER TABLE `effettistato`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `scaling`
--

DROP TABLE IF EXISTS `scaling`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `scaling`
(
    `id_arma`       int                                    NOT NULL,
    `id_attributo`  varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
    `grado_scaling` enum ('A','B','C','D','E','S') COLLATE utf8mb4_general_ci DEFAULT NULL,
    `parametro`     int                                                       DEFAULT NULL,
    PRIMARY KEY (`id_arma`, `id_attributo`),
    KEY `id_attributo` (`id_attributo`),
    CONSTRAINT `scaling_ibfk_1` FOREIGN KEY (`id_arma`) REFERENCES `armi` (`id_arma`) ON UPDATE CASCADE,
    CONSTRAINT `scaling_ibfk_2` FOREIGN KEY (`id_attributo`) REFERENCES `attributi` (`id_attributo`) ON UPDATE CASCADE
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `scaling`
--

LOCK TABLES `scaling` WRITE;
/*!40000 ALTER TABLE `scaling`
    DISABLE KEYS */;
/*!40000 ALTER TABLE `scaling`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statistiche`
--

DROP TABLE IF EXISTS `statistiche`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `statistiche`
(
    `id_arma`   int                                           NOT NULL,
    `id_tipo`   varchar(50) COLLATE utf8mb4_general_ci        NOT NULL,
    `valore`    int                                           NOT NULL,
    `tipologia` enum ('ATT','DEF') COLLATE utf8mb4_general_ci NOT NULL,
    PRIMARY KEY (`id_arma`, `id_tipo`, `tipologia`),
    KEY `id_tipo` (`id_tipo`),
    CONSTRAINT `statistiche_ibfk_1` FOREIGN KEY (`id_arma`) REFERENCES `armi` (`id_arma`) ON UPDATE CASCADE,
    CONSTRAINT `statistiche_ibfk_2` FOREIGN KEY (`id_tipo`) REFERENCES `tipistatistiche` (`id_tipo`) ON UPDATE CASCADE
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statistiche`
--

LOCK TABLES `statistiche` WRITE;
/*!40000 ALTER TABLE `statistiche`
    DISABLE KEYS */;
/*!40000 ALTER TABLE `statistiche`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipistatistiche`
--

DROP TABLE IF EXISTS `tipistatistiche`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipistatistiche`
(
    `id_tipo` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
    `nome`    varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
    PRIMARY KEY (`id_tipo`),
    UNIQUE KEY `nome` (`nome`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipistatistiche`
--

LOCK TABLES `tipistatistiche` WRITE;
/*!40000 ALTER TABLE `tipistatistiche`
    DISABLE KEYS */;
INSERT INTO `tipistatistiche`
VALUES ('BST', 'Boost'),
       ('CRT', 'Critico'),
       ('FIS', 'Fisico'),
       ('FUL', 'Fulmine'),
       ('FUO', 'Fuoco'),
       ('MAG', 'Magico'),
       ('SAC', 'Sacro');
/*!40000 ALTER TABLE `tipistatistiche`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utenti`
--

DROP TABLE IF EXISTS `utenti`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `utenti`
(
    `Email`             varchar(254) COLLATE utf8mb4_general_ci NOT NULL,
    `Nickname`          varchar(20) COLLATE utf8mb4_general_ci  NOT NULL,
    `Sesso`             enum ('M','F') COLLATE utf8mb4_general_ci DEFAULT 'M',
    `Password`          text COLLATE utf8mb4_general_ci         NOT NULL,
    `ProfilePicture`    text COLLATE utf8mb4_general_ci         NOT NULL,
    `isAdmin`           tinyint(1)                                DEFAULT '0',
    `dataRegistrazione` date                                    NOT NULL,
    PRIMARY KEY (`Email`),
    UNIQUE KEY `Nickname` (`Nickname`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utenti`
--

LOCK TABLES `utenti` WRITE;
/*!40000 ALTER TABLE `utenti`
    DISABLE KEYS */;
INSERT INTO `utenti`
VALUES ('root@gmail.com', 'Root', 'M', '$2y$10$eRSkBYLENPOGi9Drx34B8.3T6IYak46Y5FJny.SZXUPz7TKmYrWvi',
        '../img/Profile.png', 1, '2025-01-26');
/*!40000 ALTER TABLE `utenti`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `viewarmi`
--

DROP TABLE IF EXISTS `viewarmi`;
/*!50001 DROP VIEW IF EXISTS `viewarmi`*/;
SET @saved_cs_client = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `viewarmi` AS
SELECT 1 AS `nome_arma`,
       1 AS `descrizione`,
       1 AS `immagine`,
       1 AS `peso`,
       1 AS `ottenimento`,
       1 AS `categoria`,
       1 AS `attacco`,
       1 AS `difesa`,
       1 AS `scaling`,
       1 AS `requisiti`,
       1 AS `effetto_passivo`
        */;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `viewarmi`
--

/*!50001 DROP VIEW IF EXISTS `viewarmi`*/;
/*!50001 SET @saved_cs_client = @@character_set_client */;
/*!50001 SET @saved_cs_results = @@character_set_results */;
/*!50001 SET @saved_col_connection = @@collation_connection */;
/*!50001 SET character_set_client = utf8mb4 */;
/*!50001 SET character_set_results = utf8mb4 */;
/*!50001 SET collation_connection = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM = UNDEFINED */ /*!50013 DEFINER =`root`@`localhost` SQL SECURITY DEFINER */ /*!50001 VIEW `viewarmi` AS
select `a`.`nome`        AS `nome_arma`,
       `a`.`descrizione` AS `descrizione`,
       `a`.`immagine`    AS `immagine`,
       `a`.`peso`        AS `peso`,
       `a`.`ottenimento` AS `ottenimento`,
       `c`.`nome`        AS `categoria`,
       group_concat(distinct concat(`t`.`nome`, ' ', ifnull(`s`.`valore`, 0)) order by
                    field(`t`.`nome`, 'Fisico', 'Magico', 'Fuoco', 'Fulmine', 'Sacro', 'Critico') ASC separator
                    ',') AS `attacco`,
       group_concat(distinct concat(`t2`.`nome`, ' ', ifnull(`d`.`valore`, 0)) order by
                    field(`t2`.`nome`, 'Fisico', 'Magico', 'Fuoco', 'Fulmine', 'Sacro', 'Critico', 'Boost') ASC
                    separator
                    ',') AS `difesa`,
       group_concat(distinct concat(`at`.`nome`, ' ', ifnull(`sc`.`grado_scaling`, '-')) order by
                    field(`at`.`nome`, 'Forza', 'Destrezza', 'Intelligenza', 'Fede', 'Arcano') ASC separator
                    ',') AS `scaling`,
       group_concat(distinct concat(`at`.`nome`, ' ', ifnull(`sc`.`parametro`, 0)) order by
                    field(`at`.`nome`, 'Forza', 'Destrezza', 'Intelligenza', 'Fede', 'Arcano') ASC separator
                    ',') AS `requisiti`,
       group_concat(distinct concat(`ef`.`icona`, '<br>', `e`.`nome_effetto`) separator
                    ',') AS `effetto_passivo`
from (((((((((`armi` `a` join `categorie` `c`
              on ((`a`.`id_categoria` = `c`.`id_categoria`))) left join `statistiche` `s`
             on (((`a`.`id_arma` = `s`.`id_arma`) and (`s`.`tipologia` = 'ATT')))) left join `tipistatistiche` `t`
            on ((`s`.`id_tipo` = `t`.`id_tipo`))) left join `statistiche` `d`
           on (((`a`.`id_arma` = `d`.`id_arma`) and (`d`.`tipologia` = 'DEF')))) left join `tipistatistiche` `t2`
          on ((`d`.`id_tipo` = `t2`.`id_tipo`))) left join `scaling` `sc`
         on ((`a`.`id_arma` = `sc`.`id_arma`))) left join `attributi` `at`
        on ((`sc`.`id_attributo` = `at`.`id_attributo`))) left join `armieffetti` `e`
       on ((`a`.`id_arma` = `e`.`id_arma`))) left join `effettistato` `ef` on ((`e`.`nome_effetto` = `ef`.`nome`)))
group by `a`.`id_arma`, `a`.`nome`, `a`.`descrizione`, `a`.`immagine`, `a`.`peso`, `a`.`ottenimento`, `c`.`nome`
        */;
/*!50001 SET character_set_client = @saved_cs_client */;
/*!50001 SET character_set_results = @saved_cs_results */;
/*!50001 SET collation_connection = @saved_col_connection */;
/*!40103 SET TIME_ZONE = @OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE = @OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS = @OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES = @OLD_SQL_NOTES */;

-- Dump completed on 2025-01-26 21:15:02
