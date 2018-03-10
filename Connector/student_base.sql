/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.1.26-MariaDB : Database - student_base
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`student_base` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `student_base`;

/*Table structure for table `files` */

DROP TABLE IF EXISTS `files`;

CREATE TABLE `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `type` varchar(50) NOT NULL,
  `size` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_student` (`id_student`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

/*Data for the table `files` */

insert  into `files`(`id`,`name`,`type`,`size`,`id_student`) values (16,'Jovana-Đurić-CV.doc','application/msword',39936,56),(19,'Andjela_Babic_47_14.docx','application/vnd.openxmlformats-officedocument.word',12713,43),(20,'Marija_Kovacevic_13_14.docx','application/vnd.openxmlformats-officedocument.word',103612,65),(21,'Sanja_Karagaca_162_14.docx','application/vnd.openxmlformats-officedocument.word',29397,67),(25,'Seminarski.docx','application/vnd.openxmlformats-officedocument.word',0,68);

/*Table structure for table `student` */

DROP TABLE IF EXISTS `student`;

CREATE TABLE `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `student_id` varchar(10) NOT NULL,
  `year` int(11) NOT NULL,
  `assignment_status` varchar(20) NOT NULL,
  `grade` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=utf8;

/*Data for the table `student` */

insert  into `student`(`id`,`name`,`surname`,`student_id`,`year`,`assignment_status`,`grade`) values (36,'Andjela','Babic','47/14',4,'Unsubmited',8),(40,'Filip','Babic','2/11',6,'Unsubmited',8),(41,'Aleksandra','Dragojevic','18/14',4,'Unsubmited',6),(42,'Marko','Petrovic','12/13',4,'Unsubmited',5),(43,'Andjela','Babic','47/14',4,'Unsubmited',10),(44,'Nikola','Nemanjic','48/14',3,'Unsubmited',10),(45,'Nikola','Nemanjic','79/11',4,'Unsubmitted',NULL),(55,'Jovana','Djuric','119/14',4,'Unsubmited',9),(56,'Nevena','Djuric','165/14',2,'Unsubmitted',8),(57,'Nena','tanaskovic','166/14',2,'Unsubmitted',NULL),(60,'Lazar','Lazic','199/3',2,'Unsubmitted',9),(65,'Marija','Kovacevic','13/14',3,'Unsubmitted',9),(66,'Nevena','Djuric','12/12',4,'Unsubmitted',6),(67,'Sanja','Karaga','162/14',4,'Unsubmitted',7),(68,'Andrijana','Bugarin','14/14',1,'Unsubmitted',5),(144,'Dragana','Arsenijevic','1/11',3,'Unsubmited',0),(148,'Dragan','Arsenijevic','1/12',4,'Unsubmited',0);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

/*Data for the table `user` */

insert  into `user`(`id`,`name`,`surname`,`email`,`password`) values (1,'Andjela','Babic','andjelasbabic@gmail.com','lala'),(2,'Andjela','Babic','neka@gmail.com','neka'),(3,'Andjela','Babic','nekanova@gmail.com','11'),(4,'hej','njf@gmail.com','njf@gmail.com','ee'),(5,'Andjela','Babic','hej@gmail.com','ka'),(6,'Nikola','Markovic','kk@gmail.com','aa'),(7,'Nikola','fwnodf','SHIDFF@GMAIL.com','a'),(8,'Dragan','Đorić','djoric@gmail.com','djoric'),(9,'Saša','Janković','sasa@gmail.com','sasa'),(10,'Aleksandar','Đoković','aleksandar@gmail.com','aleksandar'),(11,'Nenad','Aničić','nenad@gmail.com','nenad'),(12,'Slađana','Benković','sladjana@gmail.com','sladjana'),(13,'Siniša','Vlajić','sinisa@gmail.com','sinisa'),(14,'Dragana','Kragulj','dragana@gmail.com','dragana'),(15,'Milan','Martić','milan@gmail.com','milan'),(16,'Ranko','Orlić','ranko@gmail.com','ranko'),(17,'Nataša','Petrović','natasa@gmail.com','natasa'),(18,'Zoran','Marjanović','zoran@gmail.com','zoran'),(19,'Olivera','Mihić','olivera@gmail.com','olivera'),(20,'Gordana','Jakić','gordana@gmail.com','gordana');

/*Table structure for table `user_student` */

DROP TABLE IF EXISTS `user_student`;

CREATE TABLE `user_student` (
  `id_user_student` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id_user_student`),
  KEY `st_id` (`id`),
  CONSTRAINT `st_id` FOREIGN KEY (`id`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Data for the table `user_student` */

insert  into `user_student`(`id_user_student`,`id`,`password`,`email`) values (3,36,'la','hejho@gmail.com'),(4,42,'ku','neki@gmail.com'),(6,55,'jovana','jovana@gmail.com'),(9,65,'maja12.','marija.kovacevic@gmail.com'),(10,66,'neci12345','nevena@gmail.com'),(11,67,'sanja1.','sanja.karagaca@gmail.com'),(12,68,'anci78','bugarin.andrijana@gmail.com'),(13,60,'lazica99','laza.lazic@gmail.com'),(14,56,'nevena55.','nevena.djuric@gmail.com'),(15,57,'tane789','nevena.tanaskovic@gmail.com'),(19,40,'filip789456','filip.babic@gmail.com');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
