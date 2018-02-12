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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `files` */

insert  into `files`(`id`,`name`,`type`,`size`,`id_student`) values (3,'248240-blackmirror_2011_03x06hatedinthenation.turbo (1).zip','application/x-zip-compressed',27685,36),(4,'PIS_-_predavanja-skraceno.docx','application/vnd.openxmlformats-officedocument.word',288039,42);

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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

/*Data for the table `student` */

insert  into `student`(`id`,`name`,`surname`,`student_id`,`year`,`assignment_status`,`grade`) values (36,'Andjela','Babic','47/14',4,'Unsubmited',8),(40,'Filip','Babic','2/11',6,'Unsubmited',8),(41,'Aleksandra','Dragojevic','18/14',4,'Unsubmited',6),(42,'Marko','Petrovic','12/13',4,'Unsubmited',8),(43,'Andjela','Babic','47/14',4,'Unsubmited',10),(44,'Nikola','Nemanjic','48/14',3,'Unsubmited',0),(45,'Nikola','Nemanjic','79/11',4,'Unsubmitted',NULL);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `user` */

insert  into `user`(`id`,`name`,`surname`,`email`,`password`) values (1,'Andjela','Babic','andjelasbabic@gmail.com','lala'),(2,'Andjela','Babic','neka@gmail.com','neka'),(3,'Andjela','Babic','nekanova@gmail.com','11'),(4,'hej','njf@gmail.com','njf@gmail.com','ee'),(5,'Andjela','Babic','hej@gmail.com','ka'),(6,'Nikola','Markovic','kk@gmail.com','aa'),(7,'Nikola','fwnodf','SHIDFF@GMAIL.com','a');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `user_student` */

insert  into `user_student`(`id_user_student`,`id`,`password`,`email`) values (3,36,'la','hej@gmail.com'),(4,42,'ku','neki@gmail.com');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
