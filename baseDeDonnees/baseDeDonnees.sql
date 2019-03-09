-- mysqldump-php https://github.com/ifsnop/mysqldump-php
--
-- Host: localhost	Database: mogi6927_fdo
-- ------------------------------------------------------
-- Server version 	10.3.13-MariaDB
-- Date: Sat, 09 Mar 2019 16:27:58 +0100

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `mailbox`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mailbox` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `club` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mailbox`
--

LOCK TABLES `mailbox` WRITE;
/*!40000 ALTER TABLE `mailbox` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `mailbox` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `mailbox` with 0 row(s)
--

--
-- Table structure for table `dancer`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dancer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `club_id` int(11) NOT NULL,
  `name_dancer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name_dancer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_birth_dancer` date NOT NULL,
  `email_dancer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_authorized` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B11CC8A961190A32` (`club_id`),
  CONSTRAINT `FK_B11CC8A961190A32` FOREIGN KEY (`club_id`) REFERENCES `club` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=170 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dancer`
--

LOCK TABLES `dancer` WRITE;
/*!40000 ALTER TABLE `dancer` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `dancer` VALUES (19,6,'DUMONT','SONIA','2002-02-11','slsdansecompagnie71260bord@orange.fr',1),(20,6,'AUGIER','LOANE','2006-06-09','slsdansecompagnie71260bord@orange.fr',1),(21,6,'LACHAUX','ESTELLE','2005-06-28','slsdansecompagnie71260bord@orange.fr',1),(22,6,'DE AMORIM','FLAVIE','2003-05-27','slsdansecompagnie71260bord@orange.fr',1),(23,6,'PROST','OCEANE','2001-05-02','slsdansecompagnie71260bord@orange.fr',1),(24,6,'MOREL','MAUD','2000-05-27','slsdansecompagnie71260bord@orange.fr',1),(25,6,'MIMOUNI','LOUBNA','2002-03-02','slsdansecompagnie71260bord@orange.fr',1),(26,6,'RENOUD-LYAT','ZOE','2003-07-24','slsdansecompagnie71260bord@orange.fr',1),(28,6,'CRUEL','MANOAH','2004-06-25','slsdansecompagnie71260bord@orange.fr',1),(29,6,'DEVEVEY','GABIN','2005-07-16','slsdansecompagnie71260bord@orange.fr',1),(30,6,'JANIN','TIPHAINE','2009-02-14','slsdansecompagnie71260bord@orange.fr',1),(31,6,'AYNIE','ALIZEE','2009-03-04','slsdansecompagnie71260bord@orange.fr',1),(32,6,'GELIN','MAELLE','2006-03-06','slsdansecompagnie71260bord@orange.fr',1),(33,6,'BULLIAT','LUDIVINE','2006-10-23','slsdansecompagnie71260bord@orange.fr',1),(34,6,'LEGRAND','CORALIE','2001-01-26','slsdansecompagnie71260bord@orange.fr',1),(35,6,'LACORNE','JULINE','2006-04-30','slsdansecompagnie71260bord@orange.fr',1),(36,6,'PROST','ALICIA','2005-08-21','slsdansecompagnie71260bord@orange.fr',1),(59,10,'BAMBALI','Gwladys','2004-05-11',NULL,1),(60,10,'BOUKBIZA','Syrine','2005-10-28',NULL,1),(61,10,'ROTHIVAL','Célia','2003-07-06',NULL,1),(62,10,'TORRES','Giuliana','2001-10-27',NULL,1),(63,10,'JEAN','Capucyne','2003-11-18',NULL,1),(64,10,'TARIF','Meiggue','2001-01-10',NULL,1),(65,10,'MAJRI','Hana','2005-09-02',NULL,1),(66,10,'GABET','Camille','2002-04-30',NULL,1),(67,10,'MURGIER','Manon','2003-12-27',NULL,1),(68,10,'BOURGEON','Lou','2003-08-06',NULL,1),(69,10,'ANAYA','Ambre','2005-08-01',NULL,1),(70,10,'VITALI','Charline','2005-08-10',NULL,1),(71,10,'DONATI','Inna','2012-02-09',NULL,1),(72,10,'MOUREY','Jessy','2011-11-19',NULL,1),(73,10,'DUBREUIL','Valentine','2011-05-05',NULL,1),(76,7,'HERNANDEZ','Héloise','1997-07-09',NULL,1),(85,7,'ABASQ','Katell','2002-06-23',NULL,1),(86,7,'AMSELLEM-GUTH','Mathys','2006-10-05',NULL,1),(87,7,'BAUR','Appoline','1996-08-19',NULL,1),(88,7,'CAILLE','Amarante','2005-06-10',NULL,1),(89,7,'CAMOZZI','Chanel','2007-07-25',NULL,1),(90,7,'CARTIER','Giulia','2009-08-30',NULL,1),(91,7,'CHALOT','Ségolène','1976-10-26',NULL,1),(92,7,'CLAVEY','Léa','1996-05-28',NULL,1),(93,7,'CRISCUOLO','Justine','1991-01-15',NULL,1),(94,7,'DA SILVA DRANDAO','Camille','1994-01-18',NULL,1),(95,7,'DAVEAU','Emma','2001-09-27',NULL,1),(96,7,'DAVEAU','Sarah','2005-01-20',NULL,1),(97,7,'DEMMER','Melia','2010-07-03',NULL,1),(98,7,'EILER','Alexandre','2003-04-08',NULL,1),(99,7,'EILER','Mathilde','2004-03-28',NULL,1),(101,7,'EL OMARI','Mäati','1984-10-15',NULL,1),(102,7,'EL OMARI','Mehdi','1985-09-19',NULL,1),(104,7,'EL OMARI','Malik','1988-03-13',NULL,1),(105,7,'ENAY','Antoine','2006-05-22',NULL,1),(106,7,'ERNY','Erwan','2007-06-02',NULL,1),(107,7,'ESTAVOYER','Elise','2001-12-17',NULL,1),(108,7,'FAVE','Marine','1993-07-06',NULL,1),(109,7,'FHLON','Anaëlle','2005-08-15',NULL,1),(110,7,'FOLLETETE','Hélène','2001-04-05',NULL,1),(111,7,'FUHRMANN','Lisa','2002-08-05',NULL,1),(112,7,'GAAG','Julie','2002-05-21',NULL,1),(113,7,'GAAG','Mélanie','1996-05-13',NULL,1),(114,7,'GALLAGHER','Suzanne','2005-02-22',NULL,1),(115,7,'GRIMSINGER','Justin','2002-10-25',NULL,1),(116,7,'GRIMSINGER','Noëlle','2000-09-20',NULL,1),(117,7,'GRISIER','Cyril','1975-12-06',NULL,1),(118,7,'GRISIER','Murielle','1980-10-02',NULL,1),(119,7,'GUILBAUD','Laurent','1971-02-24',NULL,1),(120,7,'HEITZ','Coline','2005-07-21',NULL,1),(121,7,'IBRAHIM','Nasma','2005-04-20',NULL,1),(122,7,'JACQUEMIN','Emilie','1976-06-02',NULL,1),(123,7,'LANGENFELD','Louise','2007-09-21',NULL,1),(124,7,'LELIEVRE','Naomy','2009-05-22',NULL,1),(125,7,'LUBRANO-LAVADERA','Séléna','2005-06-06',NULL,1),(126,7,'LUCAS','Célia','2007-10-19',NULL,1),(127,7,'LUPFER','Solène','2002-12-06',NULL,1),(128,7,'MARCZAK','Rose','2008-10-28',NULL,1),(129,7,'MARGUIER','Kaola','2002-07-24',NULL,1),(130,7,'MENART','Lisa','2007-03-30',NULL,1),(131,7,'MEZZAROBBA','Loïc','1999-11-25',NULL,1),(132,7,'NUSSBAUM','Ian-Arthur','2005-09-29',NULL,1),(133,7,'PAIS PAIVA','Aléxia','2006-02-02',NULL,1),(134,7,'PAIS PAIVA','Iara','2003-10-04',NULL,1),(135,7,'PATTAROZZI','Juline','2004-03-28',NULL,1),(136,7,'PETIT','Mayli','2008-03-09',NULL,1),(137,7,'PICOT','Ambre','2004-05-25',NULL,1),(138,7,'PILI','Eliott','2004-04-29',NULL,1),(139,7,'PIRALLI','Chloé','2009-09-26',NULL,1),(140,7,'POLIDORO','Inès','2001-08-27',NULL,1),(141,7,'PROVOST','Mattéo','2004-02-26',NULL,1),(142,7,'PUTEGNAT','Méline','2006-06-02',NULL,1),(143,7,'PUTEGNAT','Maella','2009-05-24',NULL,1),(144,7,'PY','Chloé','2011-01-31',NULL,1),(145,7,'PY','Eléonore','2001-03-13',NULL,1),(146,7,'PY','Sarah','2007-12-10',NULL,1),(147,7,'RADIX','Sophie','1987-07-13',NULL,1),(148,7,'RAYMOND','Kylie','2010-06-28',NULL,1),(149,7,'RICHARD','Cloé','2011-01-25',NULL,1),(150,7,'ROTH','Célia','2005-03-23',NULL,1),(151,7,'SIMON','Amèlie','2006-03-15',NULL,1),(152,7,'SIRUFO','Léna','2007-06-09',NULL,1),(153,7,'SPRINGARD','Blandine','2002-01-14',NULL,1),(154,7,'TREMBLAY','Auréa','2006-06-30',NULL,1),(155,7,'TREPAGNE','Lola','2006-07-25',NULL,1),(156,7,'VALENTIN','Camille','2003-10-23',NULL,1),(157,7,'WIDMER','Noélys','2008-08-26',NULL,1),(158,7,'ZIMMER','Camille','1988-04-03',NULL,1),(159,7,'ZOUAI','Louane','2004-05-08',NULL,1),(160,7,'ZYCH','Kilian','2004-09-14',NULL,1),(164,4,'xwdv xcbvd','v db db','1999-03-01',NULL,1),(165,4,'oui','oui','1998-03-01',NULL,1),(166,4,'non','non','1999-03-16',NULL,1),(167,4,'nor','nor','1997-03-16',NULL,1),(168,4,'test','trgcf','1999-02-02',NULL,1),(169,4,'ugbhv n','hug','1999-03-11',NULL,1);
/*!40000 ALTER TABLE `dancer` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `dancer` with 113 row(s)
--

--
-- Table structure for table `competition_team`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `competition_team` (
  `competition_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  PRIMARY KEY (`competition_id`,`team_id`),
  KEY `IDX_CAA3380D7B39D312` (`competition_id`),
  KEY `IDX_CAA3380D296CD8AE` (`team_id`),
  CONSTRAINT `FK_CAA3380D296CD8AE` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_CAA3380D7B39D312` FOREIGN KEY (`competition_id`) REFERENCES `competition` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `competition_team`
--

LOCK TABLES `competition_team` WRITE;
/*!40000 ALTER TABLE `competition_team` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `competition_team` VALUES (2,88),(2,89),(2,90),(2,91),(2,92),(2,93),(2,94),(2,95),(2,96),(2,97),(2,98),(2,99),(2,100),(2,101),(2,107),(2,108),(2,109),(2,110),(2,111),(2,112),(10,107),(10,108),(10,109),(10,110),(10,111),(10,112),(10,113),(10,114),(10,115),(10,116),(10,117),(10,118);
/*!40000 ALTER TABLE `competition_team` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `competition_team` with 32 row(s)
--

--
-- Table structure for table `club`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `club` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville_club` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_postal_club` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_club` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_club_owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_club` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `reset_password_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_B8EE387227D818F7` (`email_club`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `club`
--

LOCK TABLES `club` WRITE;
/*!40000 ALTER TABLE `club` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `club` VALUES (4,'Test Développeurs','test','90000','0652671234','test','$2y$13$Ub0PfcQjhIm4nLGebiIC2uPRJ9ofxCTomaRjfXDY98a67rfhvx96q','test@gmail.com','\"ROLE_ADMIN\"',NULL),(6,'SLS DANSE COMPAGNIE','SENOZAN','71260','0672624806','AUGIER Nathalie et Philippe','$2y$13$cEhwwNRIbr/DXdZvvxMHt.07K6.IjBm6VNvMTdBFmW8OAyaK5Sv8G','slsdansecompagnie71260bord@orange.fr','\"ROLE_USER\"',NULL),(7,'SHUFFLE DANCE SHOW','Belfort','90000','0685206074','Claudine WEBER','$2y$13$92gfpRWum9ZeJNKMfDphuOEHjcS1ZEGRziHfRYORzLO297mr122yi','danseweber@orange.fr','\"ROLE_ADMIN\"',NULL),(10,'Rillieux Danse Club','Rillieux-la-Pape','69140','0478970644','Alain LOPEZ','$2y$13$xvZzgX6IsrD7BXCA5nLJAuHW1pEJ.EJau01XREAyDkqfausxczNhK','lopez@numericable.com','\"ROLE_USER\"',NULL);
/*!40000 ALTER TABLE `club` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `club` with 4 row(s)
--

--
-- Table structure for table `team`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `club_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `is_present` tinyint(1) NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C4E0A61F61190A32` (`club_id`),
  KEY `IDX_C4E0A61F12469DE2` (`category_id`),
  CONSTRAINT `FK_C4E0A61F12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `FK_C4E0A61F61190A32` FOREIGN KEY (`club_id`) REFERENCES `club` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team`
--

LOCK TABLES `team` WRITE;
/*!40000 ALTER TABLE `team` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `team` VALUES (68,10,2,1,'duo'),(69,10,2,1,'solo'),(70,10,2,1,'solo'),(71,10,3,1,'solo'),(72,10,3,1,'solo'),(73,10,3,1,'duo'),(74,10,2,1,'duo'),(75,10,3,1,'smallGroup'),(76,10,2,1,'solo'),(77,10,2,1,'solo'),(78,10,3,1,'solo'),(79,10,2,1,'duo'),(80,10,2,1,'solo'),(81,10,2,1,'solo'),(82,10,3,1,'solo'),(83,10,2,1,'duo'),(84,10,3,1,'duo'),(85,10,2,1,'duo'),(86,10,1,1,'solo'),(87,10,1,1,'duo'),(88,7,3,1,'duo'),(89,7,3,1,'duo'),(90,7,3,1,'solo'),(91,7,3,1,'solo'),(92,7,3,1,'solo'),(93,7,2,1,'solo'),(94,7,2,1,'solo'),(95,7,2,1,'solo'),(96,7,1,1,'solo'),(97,7,2,1,'duo'),(98,7,2,1,'duo'),(99,7,3,1,'solo'),(100,7,2,1,'duo'),(101,7,1,1,'duo'),(107,4,3,1,'solo'),(108,4,3,1,'solo'),(109,4,3,1,'solo'),(110,4,3,1,'solo'),(111,4,3,1,'solo'),(112,4,3,1,'solo'),(113,4,3,1,'solo'),(114,4,3,1,'solo'),(115,4,3,1,'solo'),(116,4,3,1,'solo'),(117,4,3,1,'solo'),(118,4,3,1,'solo');
/*!40000 ALTER TABLE `team` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `team` with 46 row(s)
--

--
-- Table structure for table `category`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `category` VALUES (1,'Enfant'),(2,'Junior'),(3,'Adulte');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `category` with 3 row(s)
--

--
-- Table structure for table `team_dance`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team_dance` (
  `team_id` int(11) NOT NULL,
  `dance_id` int(11) NOT NULL,
  PRIMARY KEY (`team_id`,`dance_id`),
  KEY `IDX_DF4DB42F296CD8AE` (`team_id`),
  KEY `IDX_DF4DB42F65D64EDD` (`dance_id`),
  CONSTRAINT `FK_DF4DB42F296CD8AE` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_DF4DB42F65D64EDD` FOREIGN KEY (`dance_id`) REFERENCES `dance` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team_dance`
--

LOCK TABLES `team_dance` WRITE;
/*!40000 ALTER TABLE `team_dance` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `team_dance` VALUES (68,1),(69,1),(70,1),(71,1),(72,1),(73,1),(74,1),(75,1),(76,2),(77,2),(78,2),(79,2),(80,5),(81,5),(82,5),(83,5),(84,5),(85,5),(86,5),(87,11),(88,11),(89,11),(90,5),(91,2),(92,2),(93,10),(94,5),(95,5),(96,5),(97,5),(98,5),(99,5),(100,2),(101,5),(107,2),(108,2),(109,2),(110,2),(111,2),(112,2),(113,1),(114,1),(115,1),(116,1),(117,1),(118,1);
/*!40000 ALTER TABLE `team_dance` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `team_dance` with 46 row(s)
--

--
-- Table structure for table `team_dancer`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team_dancer` (
  `team_id` int(11) NOT NULL,
  `dancer_id` int(11) NOT NULL,
  PRIMARY KEY (`team_id`,`dancer_id`),
  KEY `IDX_C7078F70296CD8AE` (`team_id`),
  KEY `IDX_C7078F70A7CAA267` (`dancer_id`),
  CONSTRAINT `FK_C7078F70296CD8AE` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_C7078F70A7CAA267` FOREIGN KEY (`dancer_id`) REFERENCES `dancer` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team_dancer`
--

LOCK TABLES `team_dancer` WRITE;
/*!40000 ALTER TABLE `team_dancer` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `team_dancer` VALUES (68,60),(68,61),(69,59),(70,60),(71,61),(72,62),(73,63),(73,64),(74,65),(74,66),(75,59),(75,60),(75,61),(75,62),(75,63),(75,64),(75,65),(75,67),(76,59),(77,60),(78,62),(79,60),(79,62),(80,59),(81,60),(82,62),(83,60),(83,61),(84,67),(84,68),(85,69),(85,70),(86,71),(87,72),(87,73),(88,91),(88,119),(89,117),(89,118),(90,76),(91,87),(92,101),(93,105),(94,89),(95,146),(96,128),(97,137),(97,159),(98,89),(98,155),(99,93),(100,138),(100,160),(101,128),(101,144),(107,164),(108,165),(109,166),(110,167),(111,169),(112,168),(113,164),(114,165),(115,166),(116,167),(117,168),(118,169);
/*!40000 ALTER TABLE `team_dancer` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `team_dancer` with 67 row(s)
--

--
-- Table structure for table `row_team`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `row_team` (
  `row_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  PRIMARY KEY (`row_id`,`team_id`),
  KEY `IDX_BF6969E883A269F2` (`row_id`),
  KEY `IDX_BF6969E8296CD8AE` (`team_id`),
  CONSTRAINT `FK_BF6969E8296CD8AE` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_BF6969E883A269F2` FOREIGN KEY (`row_id`) REFERENCES `row` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `row_team`
--

LOCK TABLES `row_team` WRITE;
/*!40000 ALTER TABLE `row_team` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `row_team` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `row_team` with 0 row(s)
--

--
-- Table structure for table `reglement`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reglement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pdf_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reglement`
--

LOCK TABLES `reglement` WRITE;
/*!40000 ALTER TABLE `reglement` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `reglement` VALUES (1,'27debb26d64b2e1756e9d522cc5ecedb.pdf','Manuel d\'utilisation du site');
/*!40000 ALTER TABLE `reglement` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `reglement` with 1 row(s)
--

--
-- Table structure for table `judge`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `judge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_judge` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name_judge` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `judge`
--

LOCK TABLES `judge` WRITE;
/*!40000 ALTER TABLE `judge` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `judge` VALUES (1,'AUGIER','Nathalie'),(2,'BLAIN','Oliviier'),(3,'DIDIER','Justine'),(4,'FADE','Sabrina'),(5,'KAROUI','Jimmy'),(6,'LOPEZ','Alain'),(7,'LOPEZ','Magalie'),(8,'MARCHAL','Didier'),(9,'MONNOT','Muriel'),(10,'MONNOT','Gilles'),(12,'PERREZ','François'),(13,'SCHNEIDER','Manuella'),(14,'WEBER','Claudine'),(15,'AUTRE','1'),(16,'AUTRE','2');
/*!40000 ALTER TABLE `judge` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `judge` with 15 row(s)
--

--
-- Table structure for table `row`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `row` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dance_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `num_tour` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `formation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `piste` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_done` tinyint(1) DEFAULT NULL,
  `passage_simul` int(11) DEFAULT NULL,
  `nb_judge` int(11) DEFAULT NULL,
  `competition_id` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `nb_choosen` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8430F6DB65D64EDD` (`dance_id`),
  KEY `IDX_8430F6DB12469DE2` (`category_id`),
  KEY `IDX_8430F6DB7B39D312` (`competition_id`),
  CONSTRAINT `FK_8430F6DB12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `FK_8430F6DB65D64EDD` FOREIGN KEY (`dance_id`) REFERENCES `dance` (`id`),
  CONSTRAINT `FK_8430F6DB7B39D312` FOREIGN KEY (`competition_id`) REFERENCES `competition` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `row`
--

LOCK TABLES `row` WRITE;
/*!40000 ALTER TABLE `row` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `row` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `row` with 0 row(s)
--

--
-- Table structure for table `competition_dance`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `competition_dance` (
  `competition_id` int(11) NOT NULL,
  `dance_id` int(11) NOT NULL,
  PRIMARY KEY (`competition_id`,`dance_id`),
  KEY `IDX_EBFCCFB97B39D312` (`competition_id`),
  KEY `IDX_EBFCCFB965D64EDD` (`dance_id`),
  CONSTRAINT `FK_EBFCCFB965D64EDD` FOREIGN KEY (`dance_id`) REFERENCES `dance` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_EBFCCFB97B39D312` FOREIGN KEY (`competition_id`) REFERENCES `competition` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `competition_dance`
--

LOCK TABLES `competition_dance` WRITE;
/*!40000 ALTER TABLE `competition_dance` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `competition_dance` VALUES (2,1),(2,2),(2,3),(2,4),(2,5),(2,6),(2,7),(2,8),(2,9),(2,10),(2,11),(6,1),(6,2),(6,3),(6,4),(6,5),(6,6),(6,7),(6,8),(6,9),(6,10),(6,11),(6,13),(7,1),(7,2),(7,3),(7,4),(7,5),(7,6),(7,7),(7,8),(7,9),(7,10),(7,11),(7,13),(8,1),(8,2),(8,3),(8,4),(8,5),(8,6),(8,7),(8,8),(8,9),(8,11),(8,13),(9,1),(9,2),(9,3),(9,4),(9,5),(9,6),(9,7),(9,8),(9,9),(9,10),(9,11),(9,13),(10,1),(10,2);
/*!40000 ALTER TABLE `competition_dance` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `competition_dance` with 60 row(s)
--

--
-- Table structure for table `ticket`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `etat` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_97A0ADA3F675F31B` (`author_id`),
  CONSTRAINT `FK_97A0ADA3F675F31B` FOREIGN KEY (`author_id`) REFERENCES `club` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket`
--

LOCK TABLES `ticket` WRITE;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `ticket` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `ticket` with 0 row(s)
--

--
-- Table structure for table `competition_judge`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `competition_judge` (
  `competition_id` int(11) NOT NULL,
  `judge_id` int(11) NOT NULL,
  PRIMARY KEY (`competition_id`,`judge_id`),
  KEY `IDX_E24CF1C27B39D312` (`competition_id`),
  KEY `IDX_E24CF1C2B7D66194` (`judge_id`),
  CONSTRAINT `FK_E24CF1C27B39D312` FOREIGN KEY (`competition_id`) REFERENCES `competition` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_E24CF1C2B7D66194` FOREIGN KEY (`judge_id`) REFERENCES `judge` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `competition_judge`
--

LOCK TABLES `competition_judge` WRITE;
/*!40000 ALTER TABLE `competition_judge` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `competition_judge` VALUES (2,1),(2,2),(2,3),(2,4),(2,5),(2,6),(2,7),(2,8),(2,9),(2,10),(2,12),(2,13),(2,14),(10,1),(10,2),(10,3);
/*!40000 ALTER TABLE `competition_judge` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `competition_judge` with 16 row(s)
--

--
-- Table structure for table `migration_versions`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration_versions`
--

LOCK TABLES `migration_versions` WRITE;
/*!40000 ALTER TABLE `migration_versions` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `migration_versions` VALUES ('20190131124742','2019-02-07 09:45:54'),('20190207094252','2019-02-07 09:48:37'),('20190207100021','2019-02-07 10:00:58'),('20190207100220','2019-02-07 10:02:35');
/*!40000 ALTER TABLE `migration_versions` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `migration_versions` with 4 row(s)
--

--
-- Table structure for table `dance`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_dance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dance`
--

LOCK TABLES `dance` WRITE;
/*!40000 ALTER TABLE `dance` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `dance` VALUES (1,'disco'),(2,'hip hop'),(3,'popping'),(4,'break dance'),(5,'dance show'),(6,'salsa'),(7,'show caraibe'),(8,'swing'),(9,'tango argentino'),(10,'claquettes'),(11,'rock pietine'),(13,'rock saute');
/*!40000 ALTER TABLE `dance` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `dance` with 12 row(s)
--

--
-- Table structure for table `competition`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `competition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `club_organizer_id` int(11) DEFAULT NULL,
  `date_competition` date NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` decimal(5,0) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_max_team` decimal(4,0) NOT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B50A2CB1FDD8E52A` (`club_organizer_id`),
  CONSTRAINT `FK_B50A2CB1FDD8E52A` FOREIGN KEY (`club_organizer_id`) REFERENCES `club` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `competition`
--

LOCK TABLES `competition` WRITE;
/*!40000 ALTER TABLE `competition` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `competition` VALUES (2,4,'2019-03-30','SENNECEY LE GRAND','GYMNASE NIEPCE (derrière la piscine) Rue des Muriers',71640,'COUPE DE BOURGOGNE',1000,'SELECTIF'),(6,6,'2019-04-06','VIRE','VIRE',71,'SELECTIF FDO',1000,'selectif'),(7,4,'2019-04-20','HADOL','hadol',88999,'coupe des vosges',1000,'20/04/2019'),(8,4,'2019-05-18','ANNEMASSE','Halle des sports',74999,'COUPE DES ALPES',1000,'Coupes des Alpes'),(9,7,'2019-06-01','BELFORT','Gymnase LE PHARE',90000,'COUPE DE FRANCE FDO',1000,'COUPE DE FRANCE FDO'),(10,4,'2019-03-29','Test','test',68000,'Compétition Test',34,'Test');
/*!40000 ALTER TABLE `competition` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `competition` with 6 row(s)
--

--
-- Table structure for table `resultat`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resultat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` int(11) DEFAULT NULL,
  `note` decimal(10,2) DEFAULT NULL,
  `nb_gardes` decimal(10,0) DEFAULT NULL,
  `row_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E7DB5DE2296CD8AE` (`team_id`),
  KEY `IDX_E7DB5DE283A269F2` (`row_id`),
  CONSTRAINT `FK_E7DB5DE2296CD8AE` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`),
  CONSTRAINT `FK_E7DB5DE283A269F2` FOREIGN KEY (`row_id`) REFERENCES `row` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resultat`
--

LOCK TABLES `resultat` WRITE;
/*!40000 ALTER TABLE `resultat` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `resultat` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `resultat` with 0 row(s)
--

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on: Sat, 09 Mar 2019 16:27:58 +0100
