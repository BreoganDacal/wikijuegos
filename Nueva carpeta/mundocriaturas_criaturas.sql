-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: mundocriaturas
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `criaturas`
--

DROP TABLE IF EXISTS `criaturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `criaturas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tipo` (`id_tipo`),
  CONSTRAINT `criaturas_ibfk_1` FOREIGN KEY (`id_tipo`) REFERENCES `tipos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `criaturas`
--

LOCK TABLES `criaturas` WRITE;
/*!40000 ALTER TABLE `criaturas` DISABLE KEYS */;
INSERT INTO `criaturas` VALUES (1,'Fénix','Ave legendaria que renace de sus cenizas.',3),(2,'Minotauro','Criatura con cuerpo de hombre y cabeza de toro.',2),(3,'Dragón Rojo','Enorme reptil alado que escupe fuego.',1),(4,'Grifo','Criatura con cuerpo de león y cabeza y alas de águila.',2),(5,'Basilisco','Ser reptiliano capaz de petrificar con la mirada.',3),(6,'Sirena','Criatura marina con torso humano y cola de pez.',3),(7,'Quimera','Bestia con cabeza de león, cuerpo de cabra y cola de serpiente.',2),(8,'Hombre Lobo','Ser humano que se transforma en lobo bajo la luna llena.',2),(9,'Kraken','Gigantesca criatura marina que destruye barcos.',3),(10,'Yeti','Ser peludo que habita en las montañas nevadas.',2),(11,'Gárgola','Estatua viviente de piedra que protege templos.',3),(12,'Centauro','Mitad humano, mitad caballo, excelente arquero.',2),(13,'Espectro','Entidad fantasmal que deambula en la noche.',3),(14,'Hidra','Ser con múltiples cabezas que regenera las que pierde.',1),(15,'Pegaso','Caballo alado que puede volar grandes distancias.',2),(16,'Leviatán','Criatura marina gigante capaz de causar tormentas.',3),(17,'Gólem','Ser animado hecho de piedra o barro.',2),(18,'Súcubo','Criatura seductora que se alimenta de energía vital.',3),(19,'Troll','Criatura grande y fuerte con un temperamento feroz.',2),(20,'Salamandra','Ser mágico que vive en el fuego.',3),(21,'Unicornio','Caballo mágico con un cuerno en la frente.',2),(22,'Quetzalcóatl','Ser mítico con cuerpo de serpiente emplumada.',1),(23,'Nagá','Criatura mitad humana y mitad serpiente.',3);
/*!40000 ALTER TABLE `criaturas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-06 10:26:00
