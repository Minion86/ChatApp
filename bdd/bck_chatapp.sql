/*
SQLyog Community v13.1.5  (64 bit)
MySQL - 10.4.11-MariaDB : Database - chatapp
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`chatapp` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `chatapp`;

/*Table structure for table `kt_chats` */

DROP TABLE IF EXISTS `kt_chats`;

CREATE TABLE `kt_chats` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `sender` varchar(50) DEFAULT NULL,
  `date_sent` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `option` int(11) DEFAULT NULL,
  `concluded` tinyint(1) DEFAULT 0,
  `transaction_type` varchar(20) DEFAULT NULL,
  `amount` float DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `kt_chats_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `kt_users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=utf8mb4;

/*Data for the table `kt_chats` */

insert  into `kt_chats`(`id`,`id_user`,`message`,`sender`,`date_sent`,`option`,`concluded`,`transaction_type`,`amount`) values 
(1,8,'hello','user','2020-05-21 09:56:32',0,0,NULL,0),
(2,8,'greetings user, how can I help you','chatbot','2020-05-21 10:19:28',NULL,0,NULL,0),
(3,8,'hello','user','2020-05-21 10:19:41',0,0,NULL,0),
(4,8,'hi','user','2020-05-21 17:20:52',NULL,0,NULL,0),
(5,8,'Sorry, not a valid answer, please try again','chatbot','2020-05-21 17:20:52',0,1,NULL,0),
(6,8,'hello','user','2020-05-21 17:21:25',NULL,0,NULL,0),
(7,8,'Sorry, not a valid answer, please try again','chatbot','2020-05-21 17:21:25',0,1,NULL,0),
(8,8,'hello','user','2020-05-21 17:25:25',NULL,0,NULL,0),
(9,8,'Sorry, not a valid answer, please try again','chatbot','2020-05-21 17:25:25',0,1,NULL,0),
(10,8,'hello','user','2020-05-21 17:59:18',0,0,NULL,0),
(11,8,'Greetings Nelson how can we help you? We offer these services, please type in 1 To deposit money into your account,  2 To withdraw money from your account , 3 To show current account balance ','chatbot','2020-05-21 17:59:18',0,0,NULL,0),
(12,8,'hello','user','2020-05-21 17:59:32',NULL,0,NULL,0),
(13,8,'Sorry, not a valid answer, please try again','chatbot','2020-05-21 17:59:32',0,1,NULL,0),
(14,8,'hello','user','2020-05-21 17:59:40',0,0,NULL,0),
(15,8,'Greetings Nelson how can we help you? We offer these services, please type in 1 To deposit money into your account,  2 To withdraw money from your account , 3 To show current account balance ','chatbot','2020-05-21 17:59:40',0,0,NULL,0),
(16,8,'hi','user','2020-05-21 18:16:11',NULL,0,NULL,0),
(17,8,'Sorry, not a valid answer, please try again','chatbot','2020-05-21 18:16:11',0,1,NULL,0),
(18,8,'hi','user','2020-05-21 18:17:49',0,0,NULL,0),
(19,8,'Greetings Nelson how can we help you? We offer these services, please type in 1 To deposit money into your account,  2 To withdraw money from your account , 3 To show current account balance ','chatbot','2020-05-21 18:17:49',0,0,NULL,0),
(20,8,'hello','user','2020-05-21 18:18:43',NULL,0,NULL,0),
(21,8,'Sorry, not a valid answer, please try again','chatbot','2020-05-21 18:18:43',0,1,NULL,0),
(22,8,'hi','user','2020-05-21 18:18:50',0,0,NULL,0),
(23,8,'Greetings Nelson how can we help you? We offer these services, please type in 1 To deposit money into your account,  2 To withdraw money from your account , 3 To show current account balance ','chatbot','2020-05-21 18:18:50',0,0,NULL,0),
(24,8,'hi','user','2020-05-21 18:23:52',NULL,0,NULL,0),
(25,8,'Sorry, not a valid answer, please try again','chatbot','2020-05-21 18:23:52',0,1,NULL,0),
(26,8,'asdasdasd','user','2020-05-21 18:27:37',0,0,NULL,0),
(27,8,'Greetings Nelson how can we help you? We offer these services, please type in 1 To deposit money into your account,  2 To withdraw money from your account , 3 To show current account balance ','chatbot','2020-05-21 18:27:37',0,0,NULL,0),
(28,12,'Greetings user how can we help you? We offer these services, please type in 1 To deposit money into your account,  2 To withdraw money from your account , 3 To show current account balance ','chatbot','2020-05-21 20:08:34',0,0,NULL,0),
(29,12,'1','user','2020-05-21 21:02:35',NULL,0,NULL,0),
(30,12,'Please enter quantity','chatbot','2020-05-21 21:02:35',1,0,NULL,0),
(31,12,'34.6','user','2020-05-21 21:02:44',NULL,0,NULL,0),
(32,12,'Please enter currency from one from the following list <select class=\'currency\'></select>','chatbot','2020-05-21 21:02:44',2,0,NULL,0),
(33,12,'XDR','user','2020-05-21 21:03:33',NULL,0,NULL,0),
(34,12,'Please enter currency','chatbot','2020-05-21 21:03:33',3,1,NULL,0),
(35,12,'hello','user','2020-05-22 00:00:06',0,0,NULL,0),
(36,12,'Greetings Nelson Patricio how can we help you? We offer these services, please type in 1 To deposit money into your account,  2 To withdraw money from your account , 3 To show current account balance ','chatbot','2020-05-22 00:00:06',0,0,NULL,0),
(37,12,'1','user','2020-05-22 00:00:19',NULL,0,NULL,0),
(38,12,'Please enter quantity','chatbot','2020-05-22 00:00:19',1,0,'deposit',0),
(39,12,'25.6','user','2020-05-22 00:00:27',NULL,0,NULL,0),
(40,12,'Please enter currency from one from the following list <select class=\'currency\'></select>','chatbot','2020-05-22 00:00:27',2,0,'deposit',25.6),
(51,12,'GBP','user','2020-05-22 00:49:57',NULL,0,NULL,0),
(52,12,'Amount20.93748676186 USD inserted on your account, thanks for using our app','chatbot','2020-05-22 00:49:58',3,1,NULL,25.6),
(53,12,'hello','user','2020-05-22 00:53:29',0,0,NULL,0),
(54,12,'Greetings Nelson Patricio how can we help you? We offer these services, please type in 1 To deposit money into your account,  2 To withdraw money from your account , 3 To show current account balance ','chatbot','2020-05-22 00:53:29',0,0,NULL,0),
(55,12,'2','user','2020-05-22 00:53:43',NULL,0,NULL,0),
(56,12,'Please enter quantity','chatbot','2020-05-22 00:53:43',1,0,'withdraw',0),
(73,12,'a','user','2020-05-22 01:22:32',NULL,0,NULL,0),
(74,12,'Please enter a correct number to make the withdraw, transaction aborted','chatbot','2020-05-22 01:22:32',0,1,NULL,0),
(75,12,'hello','user','2020-05-22 01:22:39',0,0,NULL,0),
(76,12,'Greetings Nelson Patricio how can we help you? We offer these services, please type in 1 To deposit money into your account,  2 To withdraw money from your account , 3 To show current account balance ','chatbot','2020-05-22 01:22:39',0,0,NULL,0),
(77,12,'2','user','2020-05-22 01:22:44',NULL,0,NULL,0),
(78,12,'Please enter amount','chatbot','2020-05-22 01:22:44',1,0,'withdraw',0),
(79,12,'20.5','user','2020-05-22 01:22:50',NULL,0,NULL,0),
(80,12,'Please enter currency from one from the following list <select class=\'currency\'></select>','chatbot','2020-05-22 01:22:50',2,0,'withdraw',20.5),
(81,12,'GTRD','user','2020-05-22 01:22:57',NULL,0,NULL,0),
(82,12,'Currency GTRD not found in service, transaction aborted','chatbot','2020-05-22 01:22:58',3,1,NULL,20.5),
(83,12,'hello','user','2020-05-22 01:23:06',0,0,NULL,0),
(84,12,'Greetings Nelson Patricio how can we help you? We offer these services, please type in 1 To deposit money into your account,  2 To withdraw money from your account , 3 To show current account balance ','chatbot','2020-05-22 01:23:06',0,0,NULL,0),
(85,12,'2','user','2020-05-22 01:23:10',NULL,0,NULL,0),
(86,12,'Please enter amount','chatbot','2020-05-22 01:23:10',1,0,'withdraw',0),
(87,12,'20','user','2020-05-22 01:27:09',NULL,0,NULL,0),
(88,12,'Please enter currency from one from the following list <select class=\'currency\'></select>','chatbot','2020-05-22 01:27:09',2,0,'withdraw',20),
(89,12,'USD','user','2020-05-22 01:27:15',NULL,0,NULL,0),
(90,12,'Amount 20 USD withdrew from your account, thanks for using our app','chatbot','2020-05-22 01:27:16',3,1,NULL,20),
(91,12,'hello','user','2020-05-22 01:28:19',0,0,NULL,0),
(92,12,'Greetings Nelson Patricio how can we help you? We offer these services, please type in 1 To deposit money into your account,  2 To withdraw money from your account , 3 To show current account balance ','chatbot','2020-05-22 01:28:19',0,0,NULL,0),
(93,12,'1','user','2020-05-22 01:28:23',NULL,0,NULL,0),
(94,12,'Please enter amount','chatbot','2020-05-22 01:28:23',1,0,'deposit',0),
(95,12,'45','user','2020-05-22 01:28:29',NULL,0,NULL,0),
(96,12,'Please enter currency from one from the following list <select class=\'currency\'></select>','chatbot','2020-05-22 01:28:29',2,0,'deposit',45),
(97,12,'USD','user','2020-05-22 01:28:34',NULL,0,NULL,0),
(98,12,'Amount 45 USD inserted on your account, thanks for using our app','chatbot','2020-05-22 01:28:35',3,1,NULL,45),
(99,12,'hello','user','2020-05-22 01:30:38',0,0,NULL,0),
(100,12,'Greetings Nelson Patricio how can we help you? We offer these services, please type in 1 To deposit money into your account,  2 To withdraw money from your account , 3 To show current account balance ','chatbot','2020-05-22 01:30:38',0,0,NULL,0),
(101,12,'1','user','2020-05-22 01:30:41',NULL,0,NULL,0),
(102,12,'Please enter amount','chatbot','2020-05-22 01:30:42',1,0,'deposit',0),
(103,12,'30','user','2020-05-22 01:30:45',NULL,0,NULL,0),
(104,12,'Please enter currency from one from the following list <select class=\'currency\'></select>','chatbot','2020-05-22 01:30:45',2,0,'deposit',30),
(105,12,'USD','user','2020-05-22 01:30:49',NULL,0,NULL,0),
(106,12,'Amount 30 USD inserted on your account, thanks for using our app','chatbot','2020-05-22 01:30:50',3,1,NULL,30),
(107,12,'hello','user','2020-05-22 01:31:02',0,0,NULL,0),
(108,12,'Greetings Nelson Patricio how can we help you? We offer these services, please type in 1 To deposit money into your account,  2 To withdraw money from your account , 3 To show current account balance ','chatbot','2020-05-22 01:31:02',0,0,NULL,0),
(109,12,'2','user','2020-05-22 01:31:08',NULL,0,NULL,0),
(110,12,'Please enter amount','chatbot','2020-05-22 01:31:08',1,0,'withdraw',0),
(111,12,'15','user','2020-05-22 01:31:12',NULL,0,NULL,0),
(112,12,'Please enter currency from one from the following list <select class=\'currency\'></select>','chatbot','2020-05-22 01:31:12',2,0,'withdraw',15),
(113,12,'EUR','user','2020-05-22 01:31:39',NULL,0,NULL,0),
(114,12,'Amount 13.698142257947 USD withdrew from your account, thanks for using our app','chatbot','2020-05-22 01:31:40',3,1,NULL,15),
(115,12,'hi','user','2020-05-22 01:31:55',0,0,NULL,0),
(116,12,'Greetings Nelson Patricio how can we help you? We offer these services, please type in 1 To deposit money into your account,  2 To withdraw money from your account , 3 To show current account balance ','chatbot','2020-05-22 01:31:55',0,0,NULL,0),
(117,12,'3','user','2020-05-22 01:32:00',NULL,0,NULL,0),
(118,12,'Dear Nelson Patricio your balance to date is: 16.3019 USD','chatbot','2020-05-22 01:32:00',0,1,NULL,0);

/*Table structure for table `kt_users` */

DROP TABLE IF EXISTS `kt_users`;

CREATE TABLE `kt_users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `currency` varchar(10) DEFAULT NULL,
  `balance` float DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `kt_users` */

insert  into `kt_users`(`id`,`name`,`email`,`password`,`currency`,`balance`) values 
(8,'Nelson','admin@hotmail.com','e10adc3949ba59abbe56e057f20f883e','USD',0),
(12,'Nelson Patricio','nelson_martinez86@hotmail.com','e10adc3949ba59abbe56e057f20f883e','USD',16.3019);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
